@extends('layouts.app', ['activePage' => 'Roles', 'titlePage' => __('Manage Roles')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title">Edit Role Details</h6>
          </div>
          <div class="card-body">
            @include('roles.edit_form')
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
	//group checkbox 
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

    //redirect to role index
    $(document).on('click', '#cancelBtn', function(){
        window.location.replace(''+utlt.siteUrl('roles')+'');
    });

     //update when button clicked
     $('#editBtn').click(function(){
         let role_id = $('#edit_role_id').val();
         axios.put(''+utlt.siteUrl('roles/'+role_id)+'', $('#roleEditForm').serialize())
         .then(response => {
            showToast("Successfully Updated !!", 'warning');
            $(document).find('#roleEditForm').trigger("reset");
            setTimeout(function(){
            	window.location.replace(''+utlt.siteUrl('roles')+'');
            }, 1000);
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#roleEditForm [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#roleEditForm [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#roleEditForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#roleEditForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
     });
});
</script>
@endpush