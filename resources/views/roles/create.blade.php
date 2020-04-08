@extends('layouts.app', ['activePage' => 'Roles', 'titlePage' => __('Manage Roles')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title">Create New Role</h6>
          </div>
          <div class="card-body">
            @include('roles.create_form')
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
        utlt.Delete(url,'#roleDatatable');
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
            setTimeout(function(){
            	window.location.replace(''+utlt.siteUrl('roles')+'');
            }, 1000);           
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
});
</script>
@endpush