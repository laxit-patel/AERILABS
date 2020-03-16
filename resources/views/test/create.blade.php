@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add New Test')])   

    <div class="container-fluid mt--7 ">
        <div class="row ">
            <div class="col-xl-12  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add New Test') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('material.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="test_store_form" action="{{ route('test.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                            <div class="col-md-3 form-group{{ $errors->has('test_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-id">{{ __('Test Id') }}</label>
                                    <input type="text" name="test_id" id="input-id" class="form-control form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_id') ? ' is-invalid' : '' }}"     value="{{ $key }}" required disabled>

                                    @if ($errors->has('test_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class=" col-md-4 form-group{{ $errors->has('test_iscode') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reference">{{ __('Test IS CODE') }}</label>
                                    <input type="text" name="test_iscode" id="input-ireference" class="form-control form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_iscode') ? ' is-invalid' : '' }}" placeholder="{{ __('IS CODE') }}" value="{{ old('test_iscode') }}" required autofocus>

                                    @if ($errors->has('test_iscode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_iscode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-5 form-group{{ $errors->has('test_material') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-material">{{ __('Test Material') }}</label>
                                    

                                    <select name="test_material" id="input-material" class="custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_material') ? ' is-invalid' : '' }}" required autofocus>
                                        <option selected disabled>Select Material</option>
                                        @foreach($materials as $material)
                                        <option class="text-dark" value="{{ $material['material_id'] }}">{{ $material['material_name'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('test_material'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_material') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 form-group{{ $errors->has('test_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Test Name') }}</label>
                                    <input type="text" name="test_name" id="input-name" class="form-control form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('test_name') }}" required >

                                    @if ($errors->has('test_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3 form-group{{ $errors->has('test_duration') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-material">{{ __('Test Duration (in Days) ') }}</label>
                                        
                                            <input type="number" max="365" name="test_duration" id="input-material" class=" form-control form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_duration') ? ' is-invalid' : '' }}" placeholder="{{ __('Duration') }}" value="{{ old('test_duration') }}" required >
                                            
                                        
                                    @if ($errors->has('test_duration'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_duration ()') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3 form-group{{ $errors->has('test_rate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-rate">{{ __('Test Rate') }}</label>
                                    <input type="text" name="test_rate" id="input-rate" class="form-control form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_rate') ? ' is-invalid' : '' }}" placeholder="{{ __('Rates') }}" value="{{ old('test_parameter') }}" required >

                                    @if ($errors->has('test_rate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_rate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group{{ $errors->has('test_rate_mes') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-rate-mes">{{ __('Test Rate M.E.S') }}</label>
                                    <input type="text" name="test_rate_mes" id="input-rate-mes" class="form-control form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_rate_mes') ? ' is-invalid' : '' }}" placeholder="{{ __('M.E.S Rates') }}" value="{{ old('test_rate_mes') }}" required >

                                    @if ($errors->has('test_rate_mes'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_rate_mes') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                
                                
                                

                            </div>

                            <div class="row">

                            
                                <div class="col-md-6 form-group{{ $errors->has('test_worksheet') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-worksheet">{{ __('Worksheet Format') }}</label>
                                    <input type="file" name="test_worksheet" id="input-worksheet" class="form-control  form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_worksheet') ? ' is-invalid' : '' }}" placeholder="{{ __('Worksheet Format') }}" value="{{ old('test_worksheet') }}" required >

                                    @if ($errors->has('test_worksheet'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_worksheet') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group{{ $errors->has('test_report') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-report">{{ __('Report Format') }}</label>
                                    <input type="file" name="test_report" id="input-report" class="form-control  form-control-lg font-weight-bold text-white bg-gradient-info form-control-alternative{{ $errors->has('test_report') ? ' is-invalid' : '' }}" placeholder="{{ __('Report Format') }}" value="{{ old('test_report') }}" required >

                                    @if ($errors->has('test_report'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_report') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                             </div>

                                


                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-block btn-success mt-4" id="test_trigger">{{ __('Add') }}</button>
                                </div>
                            
                        </form>
                    </div>
                </div>
            </div>

            

        </div>
        
        @include('layouts.footers.auth')
    </div>

    @push('js')

        <script type="text/javascript">
            $('#test_trigger').click(function () {
                $('#test_trigger').attr('disabled', true);
                $('#test_store_form').submit();
                return true;
            });
        </script>

    @endpush

@endsection