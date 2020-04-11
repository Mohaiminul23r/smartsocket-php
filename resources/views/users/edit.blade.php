@extends('layouts.app', ['activePage' => 'Users', 'titlePage' => __('Update User Details')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form id="edit_user_form" autocomplete="off" class="form-horizontal">
            <div class="card">
              <div class="card-header card-header-primary p-2 pl-4">
                <h4 class="card-title">{{ __('Edit User') }}</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Name') }}</label>
                    <div class="form-group">
                      <input class="border pl-2 form-control" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{$user->name}}" required />
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Email') }}</label>
                    <div class="form-group">
                      <input class="border pl-2 form-control" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{$user->email}}" required/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                </div>
               <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Phone') }}</label>
                    <div class="form-group">
                      <input class="border pl-2 form-control" name="phone" id="input-phone" type="text" placeholder="{{ __('Phone') }}" value="{{$user->phone}}"/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('City') }}</label>
                    <div class="form-group">
                      <input class="border pl-2 form-control" name="city" id="input-city" type="text" placeholder="{{ __('City') }}" value="{{$user->city}}" />
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Country') }}</label>
                    <div class="form-group">
                      <input class="border pl-2 form-control" name="country" id="input-country" type="text" placeholder="{{ __('Country') }}" value="{{$user->country}}" />
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="button" id="update_btn" style="font-size:14px;" class="btn btn-outline-success text-capitalize pb-2 pt-2">{{ __('Update') }}</button>
                <button type="" style="font-size:14px;" class="btn btn-outline-info text-capitalize pb-2 pt-2"><a href="{{ route('user.index') }}">{{ __('Cancel') }}</a></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script type="text/javascript">
  $(document).ready(function(){

    //update user data
    $(document).on('click', '#update_btn', function(){
        $(document).find('#edit_user_form .has-danger').removeClass('has-danger');
        $(document).find('#edit_user_form').find('.help-block').empty();
        let user_id = $("#user_id").val();
         axios.put(''+utlt.siteUrl('user/'+user_id+'')+'', $('#edit_user_form').serialize())
         .then(response => {
            showToast("Successfully Updated. ");
            $(document).find('#edit_user_form').trigger("reset");
            setTimeout(function(){
              window.location.replace(utlt.siteUrl('user'));
            }, 500);           
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#edit_user_form [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#edit_user_form [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#edit_user_form [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#edit_user_form [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
    });
  });
</script>
@endpush