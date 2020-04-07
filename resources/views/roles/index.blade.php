@extends('layouts.app', ['activePage' => 'Roles', 'titlePage' => __('Manage Roles')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title mt-0">List of all Roles</h6>
          </div>
          <div class="card-body">
          	<div class="row">
		        <div class="col-12 text-left">
		          <button id="role_create_btn" class="btn btn-sm btn-link btn-outline-primary text-capitalize ml-4 mb-3" style="font-size: 13px;">Add Role</button>
		        </div>
		    </div>
            <div class="table-responsive">
              <div class="container">
               	<table id="roleDatatable" class="table table-sm mt-3 mb-3 table-striped" style="width:100%;">
               	</table>
              </div>
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
$(document).ready(function(){
    roleDatatable = $('#roleDatatable').DataTable({
        dom: '<"row"<"col-12 col-sm-6"l><"col-12 col-sm-6"f><"col-12 col-sm-12"t><"col-12 col-sm-6"i><"col-12 col-sm-6"p>>',
        lengthMenu: [[10,20,50, -1], [10,20,50, "All"]],
        buttons: [],
        columns: [
            {
                'title' : '#SL',
                'data' : 'id',
                'width' : '15%',
                'align' : 'center',
                'render' : function(data, type, row, ind){
                    var pageInfo = roleDatatable.page.info();
                    return (ind.row + 1) + pageInfo.start;
                }
            },
            {title : 'Role Name', data: "name", name: 'name', 'width':'30%'},
            {title : 'Description', data: "description", name: 'description','width':'40%'},
            {
                'title' : 'Action',
                'data' : 'id', 
                'class' : 'text-right',
                'width' : '15%', 
                'render' : function(data, type, row, ind){
                 dropdown_item = '<div class="dropdown">' +
                            '<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                '<i class="fas fa-ellipsis-v"></i>' +
                            '</a>'+
                            '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">'+
                                '<button class="btn btn-link text-darker edit_btn p-0 m-1" data-id="' + data +'"><i class="fas fa-edit text-success m-2"></i> Edit</button><br>'+
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
        ajax: {
            url: utlt.siteUrl("/role/get-data-json"),
            dataSrc: 'data'
        }
    }); 

    //when clicked add role button 
    $(document).on('click', '#role_create_btn', function(){
        window.location.replace(''+utlt.siteUrl('roles/create')+'');
    });

    $(document).on('click', '.delete_btn', function(){
        let url = 'roles/'+($(this).attr('data-id'));
        utlt.Delete(url,'#roleDatatable');
    });
});
</script>
@endpush