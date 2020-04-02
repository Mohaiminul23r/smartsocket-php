@extends('layouts.app', ['activePage' => 'Types', 'titlePage' => __('Types')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title">Add/Edit Types</h6>
          </div>
          <div class="card-body">
             @include('types.form')
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title mt-0">List of all Types</h6>
          </div>
          <div class="card-body">
            <div class="container border">
                <div class="table-responsive">
                    <table id="typeDatatable" class="table table-sm mt-3 mb-3 table-striped" style="width:100%;">
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
    typeDatatable = $('#typeDatatable').DataTable({
        dom: '<"row"<"col-12 col-sm-6"l><"col-12 col-sm-6"f><"col-12 col-sm-12"t><"col-12 col-sm-6"i><"col-12 col-sm-6"p>>',
        lengthMenu: [[10,20,50, -1], [10,20,50, "All"]],
        buttons: [],
        ajax: {
            url: 'types',
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
                    var pageInfo = typeDatatable.page.info();
                    return (ind.row + 1) + pageInfo.start;
                }
            },
            {title : 'Type Name', data: "typeName", name: 'name', 'width':'20%'},
            {title : 'Description', data: "description", name: 'description','width':'30%'},
<<<<<<< HEAD
            {title : 'Created By', data: "created_by", name: 'created_by','width':'15%'},
          
=======
            {title : 'Created By', data: "userName", name: 'created_by','width':'15%'},
>>>>>>> f84c26c48bbc45c0283dfeacdae194079f4f7680
            {
                'title' : 'Status',
                'width':'15%',
                'render' : function(data, type, row, ind){
                   $status = '<div class="togglebutton">'+
                              ' <label>'+
                                 '<input type="checkbox" onchange="utlt.updateStatus(this,\'types/updateStatus/'+row.id+'\',\'status\')" data-id="'+row.id+'" type="checkbox" '+((row.status == 1)?'checked':'')+'>'+
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
    }); 

    $(document).on('click', '.delete_btn', function(){
        let url = 'types/'+($(this).attr('data-id'));
        utlt.Delete(url,'#typeDatatable');
    });

    //reset form
    $(document).on('click', '#resetBtn', function(){
        reset_form();
    });

    //insert data for type
    $(document).on('click', '#saveBtn', function(){
        $(document).find('#typeForm .has-danger').removeClass('has-danger');
        $(document).find('#typeForm').find('.help-block').empty();
         axios.post(''+utlt.siteUrl('types')+'', $('#typeForm').serialize())
         .then(response => {
            showToast("Successfully Added. ");
            $(document).find('#typeForm').trigger("reset");
            $('#typeDatatable').DataTable().ajax.reload();            
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#typeForm [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#typeForm [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#typeForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#typeForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
    });

    //add preious data at edit type details
     $(document).on('click', '.edit_btn', function(){
         let type_id = $(this).attr('data-id');
         $('#type_id').val(type_id);
         change_button();
         axios.get(''+utlt.siteUrl('types/'+type_id+'/edit')+'')
         .then(response => {
            console.log(response);
            $('#type_name').val(response.data.name);
            $('#description').val(response.data.description);
         })
    });

     //update when button clicked
     $('#editBtn').click(function(){
         let edit_type_id = $('#type_id').val();
         axios.put(''+utlt.siteUrl('types/'+edit_type_id)+'', $('#typeForm').serialize())
         .then(response => {
            showToast("Successfully Updated !!", 'warning');
            $(document).find('#typeForm').trigger("reset");
            $('#typeDatatable').DataTable().ajax.reload();
            index();
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#typeForm [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#typeForm [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#typeForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#typeForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
     });
});

function change_button(){
   $('#saveBtn').addClass('d-none');
   $('#editBtn').removeClass('d-none');
   $('#backBtn').removeClass('d-none');
   $('#title').text('Edit type Details');
}

function index(){
   $('#saveBtn').removeClass('d-none');
   $('#editBtn').addClass('d-none');
   $('#backBtn').addClass('d-none');
   $('#title').text('Add type Details');
   reset_form();
}

function reset_form(){
   $(document).find('#typeForm').trigger("reset");
   $(document).find('#typeForm .has-danger').removeClass('has-danger');
   $(document).find('#typeForm').find('.help-block').empty();
}
</script>
@endpush