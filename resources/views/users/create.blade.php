@extends('layouts.app', ['activePage' => 'Users', 'titlePage' => __('Create New User')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form id="user_create_form" autocomplete="off" class="form-horizontal">
            <div class="card">
              <div class="card-header card-header-primary p-2 pl-4">
                <h4 class="card-title">{{ __('Create New User') }}</h4>
              </div>
              <div class="card-body col-md-10 offset-1">
                <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0 text-dark text-dark">{{ __('Name') }}<span class="ml-1 text-danger">*</span></label>
                    <div class="form-group">
                      <input type="text" class="border pl-2 form-control" name="name"placeholder="{{ __('User Name') }}" required/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0 text-dark">{{ __('Email') }}<span class="ml-1 text-danger">*</span></label>
                    <div class="form-group">
                      <input type="email" class="border pl-2 form-control" name="email" placeholder="{{ __('Email Address') }}" required/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                </div>
               <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0 text-dark">{{ __('Phone') }}</label>
                    <div class="form-group">
                      <input type="text" class="border pl-2 form-control" name="phone"placeholder="{{ __('Phone') }}" required/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0 text-dark">{{ __('City') }}</label>
                    <div class="form-group">
                      <input type="text" class="border pl-2 form-control" name="city"placeholder="{{ __('City') }}"/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0 text-dark">{{ __('Country') }}</label>
                    <div class="form-group">
                      <input type="text" class="border pl-2 form-control" name="country"placeholder="{{ __('Country') }}" value="Bangladesh"/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0 text-dark">{{ __('Password') }}<span class="ml-1 text-danger">*</span></label>
                    <div class="form-group">
                      <input type="password" class="border pl-2 form-control" name="password"placeholder="{{ __('Enter Password') }}" required/>
                      <span class="d-none help-block"></span>
                    </div>
                  </div>
                </div>
              </div>
            </form>
              <div class="card-footer ml-auto mr-auto">
                <button type="button" id="create_btn" style="font-size:14px;" class="btn btn-outline-success text-capitalize pb-2 pt-2 btn-sm">{{ __('Create User') }}</button>
                <button type="" style="font-size:14px;" class="btn btn-outline text-capitalize pb-2 pt-2 btn-sm"><a href="{{ route('user.index') }}">{{ __('Cancel') }}</a></button>
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

    //insert new user data
    $(document).on('click', '#create_btn', function(){
        $(document).find('#user_create_form .has-danger').removeClass('has-danger');
        $(document).find('#user_create_form').find('.help-block').empty();
         axios.post(''+utlt.siteUrl('user')+'', $('#user_create_form').serialize())
         .then(response => {
            showToast("Successfully Created. ");
            $(document).find('#user_create_form').trigger("reset");
            setTimeout(function(){
            	window.location.replace(utlt.siteUrl('user'));
            }, 500);           
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#user_create_form [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#user_create_form [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#user_create_form [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#user_create_form [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
    });
  });
</script>
@endpush