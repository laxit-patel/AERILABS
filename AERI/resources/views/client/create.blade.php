@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Client')])   

    <div class="container-fluid mt--7">
        <div class="row ">
            <div class="col-xl-12  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Client') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('client.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('client.store') }}" autocomplete="off">
                            @csrf
                            
                            
                            

                            <div class="row">
                            

                                </div>

                                <div class="row">

                                <div class=" col-md-3 form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('ID') }}</label>
                                    <input type="text" name="client_id" id="input-name" class="disabled form-control form-control-lg font-weight-bold text-white bg-gradient-primary form-control-alternative{{ $errors->has('client_id') ? ' is-invalid' : '' }}" placeholder="" value="{{ $key }}" required  autofocus disabled>

                                    @if ($errors->has('client_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_id') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="col-md-5 form-group{{ $errors->has('client_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="client_name" id="input-name" class="form-control form-control-lg font-weight-bold text-white bg-gradient-primary form-control-alternative{{ $errors->has('client_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('client_name') }}" required autofocus>

                                    @if ($errors->has('client_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('client_phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Phone') }}</label>
                                    <input type="text" name="client_phone" id="input-password" class="form-control form-control-lg font-weight-bold text-white bg-gradient-primary form-control-alternative{{ $errors->has('client_phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ old('client_phone') }}" required>
                                    
                                    @if ($errors->has('client_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </div>

                                <div class="row">
                                <div class=" col-md-6 form-group{{ $errors->has('client_email') ? ' has-danger' : '' }} ">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="client_email" id="input-email" class="form-control form-control-lg font-weight-bold text-white  bg-gradient-primary  form-control-alternative{{ $errors->has('client_email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('client_email') }}" required>

                                    @if ($errors->has('client_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group{{ $errors->has('client_gestin') ? ' has-danger' : '' }} ">
                                    <label class="form-control-label" for="input-gstin">{{ __('GSTIN') }}</label>
                                    <input type="text" name="client_gstin" id="input-gstin" class="form-control form-control-lg font-weight-bold text-white  bg-gradient-primary  form-control-alternative{{ $errors->has('client_gstin') ? ' is-invalid' : '' }}" placeholder="{{ __('G.S.T') }}" value="{{ old('client_gstin') }}" required>

                                    @if ($errors->has('client_gstin'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_gstin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </div>
                                

                                <div class="form-group{{ $errors->has('client_address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
                                    <textarea name="client_address" id="input-address" class="form-control text-white form-control-lg bg-gradient-primary {{ $errors->has('client_address') ? ' is-invalid' : '' }}" placeholder="Client Address" value="{{ old('client_address') }}" required></textarea>
                                    
                                    @if ($errors->has('client_address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_address') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                

                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-block btn-success mt-4">{{ __('Add') }}</button>
                                </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection