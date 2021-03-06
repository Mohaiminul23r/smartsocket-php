@extends('layouts.app', ['activePage' => 'Users', 'titlePage' => __('List of all Users')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary p-2">
                        <h5 class="card-title ">User List</h5>
                    </div>
                    <div class="card-body">
                          <div class="row">
                            <div class="col-12 text-left">
                              <button id="user_create_btn" class="btn btn-sm btn-link btn-outline-primary text-capitalize ml-4 mb-3" style="font-size: 13px;">Add New User</button>
                            </div>
                          </div>
                          @include('users.create_role_modal')
                          <div class="table-responsive">
                            <table id="userDatatable" class="table table-sm mt-3 mb-3 table-striped" style="width:100%;">
                            </table>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
var roles    = <?php echo json_encode($roles)?>;
$(document).ready(function(){
    userDatatable = $('#userDatatable').DataTable({
        dom: '<"row"<"col-12 col-sm-6"l><"col-12 col-sm-6"f><"col-12 col-sm-12"t><"col-12 col-sm-6"i><"col-12 col-sm-6"p>>',
        lengthMenu: [[10,20,50, -1], [10,20,50, "All"]],
        buttons: [],
        ajax: {
            url: 'user',
            dataSrc: function (json) {
                return json.data;
            },
            data: function (dataParam) {
                return dataParam;
            }
        },
        columns: [
            {
                'title' : '#SL',
                'data' : 'id',
                'width' : '10%',
                'align' : 'center',
                'render' : function(data, type, row, ind){
                    var pageInfo = userDatatable.page.info();
                    return (ind.row + 1) + pageInfo.start;
                }
            },
            {title : 'Name', data: "name", name: 'name', 'width':'25%'},
            {title : 'Email', data: "email", name: 'email','width':'25%'},
            {title : 'Contact No', data: "phone", name: 'phone','width':'20%'},
            {
                'title' : 'Status',
                'width':'20%',
                'render' : function(data, type, row, ind){
                   $status = '<div class="togglebutton">'+
                              ' <label>'+
                                 '<input type="checkbox" onchange="utlt.updateStatus(this,\'user/updateStatus/'+row.id+'\',\'status\')" data-id="'+row.id+'" type="checkbox" '+((row.status == 1)?'checked':'')+'>'+
                                   '<span class="toggle"></span>'+
                              ' </label>'+
                             '</div>';
                    return $status;
                }
            },
            {
                'title' : 'Action',
                'data' : 'id', 
                'class' : 'text-right',
                'width' : '10%', 
                'render' : function(data, type, row, ind){
                 dropdown_item = '<div class="dropdown">' +
                            '<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                '<i class="fas fa-ellipsis-v"></i>' +
                            '</a>'+
                            '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">'+
                                '<button class="btn btn-link text-darker assign_role p-0 m-1" data-id="' + data +'"><i class="fas fa-user-times text-success m-2"></i>Assign Role</button><br>'+
                                '<button class="btn btn-link text-darker view_btn p-0 m-1" data-id="' + data +'"><i class="fas fa-eye text-info m-2"></i> View Details</button><br>'+
                                '<button class="btn btn-link text-darker edit_btn p-0 m-1" data-id="' + data +'"><i class="fas m-2 fa-user-edit text-darker"></i> Edit User Info</button><br>'+
                                '<button class="btn btn-link text-darker delete_btn p-0 m-1" data-id="' + data +'"><i class="fas fa-trash-alt m-2 text-danger"></i> Delete</button>'+
                            '</div>'+
                        '</div>';
                    return dropdown_item;
                }
            }
        ],
        columnDefs: [
            {searchable: false, orderable:false, targets: [0,2]}
        ],
        responsive: true,
        autoWidth: false,
        serverSide: true,
        processing: true,
    }); 

    $(document).on('click', '#user_create_btn', function(){
        window.location.replace(utlt.siteUrl('user/create'));
    });

    $(document).on('click', '.delete_btn', function(){
        let url = 'user/'+($(this).attr('data-id'));
        utlt.Delete(url,'#userDatatable');
    });

    $(document).on('click', '.edit_btn', function(){
        let u_id = $(this).attr('data-id');
        window.location.replace(utlt.siteUrl('user/'+u_id+'/edit'));
    });

    $(document).on('click', '.view_btn', function(){
        let u_id = $(this).attr('data-id');
        window.location.replace(utlt.siteUrl('user/view-details/'+u_id+''));
    });

    $(document).on('click', '.assign_role', function(){
        let u_id = $(this).attr('data-id');
        $("#user_id").val(u_id);
        $('#assignRoleModal').modal('show');
        axios.get(''+utlt.siteUrl('user/get-role/'+u_id+'')+'').then(function(response){
                $.each(response.data, function(ind, val){
                    $(document).find("#assign_form input[type=checkbox][value="+val+"]").prop("checked",true);
                });
            });
        });


    $(document).on('click', '#assign_role_btn', function(){
        $('#assignRoleModal').modal('show');
        let u_id = $("#user_id").val();
        axios.post(''+utlt.siteUrl('user/assign-roles/'+u_id+'')+'', $('#assign_form').serialize())
        .then(function(response){
            showToast("Successfully Assigned !!");
            setTimeout(function(){
                $('#assignRoleModal').modal('hide');
            }, 200);  
            $(document).find('#assign_form').trigger("reset");
        });
    });

    $(document).on('click', '#modal_close_btn', function(){
        $(document).find('#assign_form').trigger("reset");
    });
});
</script>
@endpush