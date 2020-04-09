@extends('layouts.app', ['activePage' => 'Users', 'titlePage' => __('User Details')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card">
              <div class="card-header card-header-primary p-2 pl-4">
                <h4 class="card-title">{{ __('Edit User') }}</h4>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
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
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" style="font-size:14px;" class="btn btn-outline-success text-capitalize pb-2 pt-2">{{ __('Update User') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection