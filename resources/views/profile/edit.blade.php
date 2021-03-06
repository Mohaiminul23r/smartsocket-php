@extends('layouts.app', ['activePage' => 'Profile', 'titlePage' => __('User Profile')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
              <div class="card-header card-header-primary p-2 pl-4">
                <h4 class="card-title">{{ __('Edit Profile') }}</h4>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success" id="success_edit_msg">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Name') }}</label>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="border pl-2 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Email') }}</label>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="border pl-2 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
               <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Phone') }}</label>
                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                      <input class="border pl-2 form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="text" placeholder="{{ __('Phone') }}" value="{{ old('name', auth()->user()->phone) }}" required="true" aria-required="true"/>
                      @if ($errors->has('phone'))
                        <span id="phone-error" class="error text-danger" for="input-phone">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('City') }}</label>
                    <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                      <input class="border pl-2 form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" id="input-city" type="text" placeholder="{{ __('City') }}" value="{{ old('city', auth()->user()->city) }}" required />
                      @if ($errors->has('city'))
                        <span id="city-error" class="error text-danger" for="input-city">{{ $errors->first('city') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <div class="col-md-6">
                    <label class="font-weight-bold mb-0">{{ __('Country') }}</label>
                    <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                      <input class="border pl-2 form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" id="input-country" type="text" placeholder="{{ __('Countrt') }}" value="{{ old('country', auth()->user()->country) }}" required />
                      @if ($errors->has('country'))
                        <span id="country-error" class="error text-danger" for="input-country">{{ $errors->first('country') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    @if(auth()->user()->image == null)
                      <img class="avatar" src="{{asset('image/Headshot-Placeholder-1.png')}}" style="width:100px; height:100px; border-radius:50%; margin-right:5px;">
                    @else
                      <img class="avatar" src="{{url(auth()->user()->image)}}" style="width:100px; height:100px; border-radius:50%; margin-right:5px;">
                    @endif
                  <input type="file" name="image" id="image">
                  <input type="hidden" name="token" value="{{ csrf_token() }}}">
                </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" style="font-size:14px;" class="btn btn-outline-success text-capitalize pb-2 pt-2">{{ __('Update Profile') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card">
              <div class="card-header card-header-primary p-2 pl-4">
                <h4 class="card-title">{{ __('Change password') }}</h4>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-md-3 col-form-label font-weight-bold" for="input-current-password">{{ __('Current Password') }}</label>
                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                      <input class="border pl-2 form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-3 col-form-label font-weight-bold" for="input-password">{{ __('New Password') }}</label>
                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="border pl-2 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-3 col-form-label font-weight-bold" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input class="border pl-2 form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-outline text-capitalize pb-2 pt-2">{{ __('Change password') }}</button>
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
      $(document).find('#success_edit_msg').delay(1200).fadeOut(500);
    });
  </script>
@endpush