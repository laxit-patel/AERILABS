@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Material')])   

    <div class="container-fluid mt--7">
        <div class="row ">
            <div class="col-xl-12  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Material') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('material.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="post" id="material_store_form" action="{{ route('material.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                           

                            <div class="row">
                            <div class="col-md-4 form-group{{ $errors->has('material_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Material ID') }}</label>
                                    <input type="text" name="material_id" id="input-name" class="form-control form-control-lg font-weight-bold text-white bg-gradient-warning form-control-alternative{{ $errors->has('material_id') ? ' is-invalid' : '' }}" value="{{ $key }}" required autofocus disabled>

                                    @if ($errors->has('material_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-8 form-group{{ $errors->has('material_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Material Name') }}</label>
                                    <input type="text" name="material_name" id="input-name" class="form-control form-control-lg font-weight-bold text-white bg-gradient-warning {{ $errors->has('material_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('material_name') }}" required autofocus>

                                    @if ($errors->has('material_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            

                            <div class=" form-group{{ $errors->has('material_description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-details">{{ __('Material Description') }}</label>
                                    <textarea name="material_description" id="input-details" class="form-control bg-gradient-warning form-control-lg text-white {{ $errors->has('material_description') ? ' is-invalid' : '' }}" placeholder="Material Description" value="{{ old('material_description') }}" required></textarea>

                                    @if ($errors->has('material_description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- Remnent of last file operations
                                <div class="row">

                                <div class=" custom-file col-md-6 form-group{{ $errors->has('material_worksheet_format') ? ' has-danger' : '' }}">
                                    <label class="form-control-label " for="input-password">{{ __('Upload Material Format') }}</label>
                                    <input type="file" name="material_worksheet_format" id="input-password" class="  text-white  form-control form-control-lg font-weight-bold  bg-gradient-orange     form-control-alternative{{ $errors->has('material_worksheet_format') ? ' is-invalid' : '' }}" placeholder="{{ __('Upload Material Worksheet') }}" value="{{ old('material_worksheet_format') }}" required>
                                
                                    @if ($errors->has('material_worksheet_format'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_worksheet_format') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group{{ $errors->has('material_report_format') ? ' has-danger' : '' }}">
                                    <label class="form-control-label " for="input-password">{{ __('Upload Material Report') }}</label>
                                    <input type="file" name="material_report_format" id="input-password" class="  text-white  form-control form-control-lg font-weight-bold  bg-gradient-orange     form-control-alternative{{ $errors->has('material_report_format') ? ' is-invalid' : '' }}" placeholder="{{ __('Upload Material Format') }}" value="{{ old('material_report_format') }}" required>
                                
                                    @if ($errors->has('material_report_format'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_report_format') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                </div>
                                -->
                                

                                

                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-lg  btn-success mt-4" id="material_store_trigger">{{ __('Add') }}</button>
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
            $('#material_store_trigger').click(function () {
                $('#material_store_trigger').attr('disabled', true);
                $('#material_store_form').submit();
                return true;
            });
        </script>

    @endpush

@endsection