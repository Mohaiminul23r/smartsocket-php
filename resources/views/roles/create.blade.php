@extends('layouts.app', ['activePage' => 'Roles', 'titlePage' => __('Manage Roles')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title">Add/Edit Roles</h6>
          </div>
          <div class="card-body">
            @include('roles.form')
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

	//checkbox select for permissions
    $('input:checkbox.group-checkbox').click(function () {
        var array = [];
        var parent = $(this).closest('.group-parent');
        $(parent).find('.sub-checkbox').prop("checked", $(this).prop("checked"))
    });

    $(document).on('click', '.group-all-check-all', function() {
        if($('.group-all-check-all').is(':checked')){
            $('.group-all input[type="checkbox"]').prop('checked', true);
        }
        else{
            $('.group-all input[type="checkbox"]').prop('checked', false);
        }
    });

    $(document).on('click', '.delete_btn', function(){
        let url = 'ports/'+($(this).attr('data-id'));
        utlt.Delete(url,'#portDatatable');
    });

    //reset form
    $(document).on('click', '#resetBtn', function(){
        reset_form();
    });

    //redirect to role index
    $(document).on('click', '#cancelBtn', function(){
        window.location.replace(''+utlt.siteUrl('roles')+'');
    });

    //insert data for roles
    $(document).on('click', '#saveBtn', function(){
        $(document).find('#roleForm .has-danger').removeClass('has-danger');
        $(document).find('#roleForm').find('.help-block').empty();
         axios.post(''+utlt.siteUrl('roles')+'', $('#roleForm').serialize())
         .then(response => {
            showToast("Successfully Added !!");
            $(document).find('#roleForm').trigger("reset");
            $('#portDatatable').DataTable().ajax.reload();
            setTimeout(function(){
            	window.location.replace(''+utlt.siteUrl('roles')+'');
            }, 2000);           
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#roleForm [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#roleForm [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                        $("#roleForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#roleForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
    });

    //add preious data at edit port details
     $(document).on('click', '.edit_btn', function(){
         let port_id = $(this).attr('data-id');
         $('#port_id').val(port_id);
         change_button();
         axios.get(''+utlt.siteUrl('ports/'+port_id+'/edit')+'')
         .then(response => {
            $('#port_name').val(response.data.name);
            $('#description').val(response.data.description);
         })
    });

     //update when button clicked
     $('#editBtn').click(function(){
         let edit_port_id = $('#port_id').val();
         axios.put(''+utlt.siteUrl('ports/'+edit_port_id)+'', $('#portForm').serialize())
         .then(response => {
            showToast("Successfully Updated !!", 'warning');
            $(document).find('#portForm').trigger("reset");
            $('#portDatatable').DataTable().ajax.reload();
            index();
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#portForm [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#portForm [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#portForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#portForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
     });
});

function change_button(){
   $('#saveBtn').addClass('d-none');
   $('#editBtn').removeClass('d-none');
   $('#backBtn').removeClass('d-none');
   $('#title').text('Edit Port Details');
}

function index(){
   //window.location.replace(utlt.siteUrl('ports'));
   $('#saveBtn').removeClass('d-none');
   $('#editBtn').addClass('d-none');
   $('#backBtn').addClass('d-none');
   $('#title').text('Add Port Details');
   reset_form();
}

function reset_form(){
   $(document).find('#portForm').trigger("reset");
   $(document).find('#portForm .has-danger').removeClass('has-danger');
   $(document).find('#portForm').find('.help-block').empty();
}
</script>
@endpush