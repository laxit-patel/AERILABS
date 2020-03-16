@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Inward')])   



    <div class="container-fluid mt--7 shadow-lg">
        <div class="row ">
            <div class="col-xl-12  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Inward') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('inward.index') }}" class="btn btn-sm bg-gradient-indigo text-white">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="inward_form" action="{{ route('inward.store') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="selected_client" id="selected_client">
                            

                            <div class="row">

                                <div class=" col-md-3 form-group{{ $errors->has('inward_id') ? ' has-danger' : '' }}">
                                    
                                    <input type="text" name="inward_id" id="input-id" class="form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_id') ? ' is-invalid' : '' }}"  value="{{ $key }}" required disabled>

                                    @if ($errors->has('inward_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class=" col-md-3 form-group{{ $errors->has('inward_reference') ? ' has-danger' : '' }}">
                                    
                                    <input type="text" name="inward_reference" id="inward_reference_focus" class="form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_reference') ? ' is-invalid' : '' }}" placeholder="{{ $reference }}" value="{{ old('inward_reference') }}" required autofocus>

                                    @if ($errors->has('inward_reference'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_reference') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                   
                                   <div class="col-md-6">
                                   <div class="input-daterange datepicker row align-items-center">
                                <div class="col">
                                    <div class="form-group ">
                                        <div class="input-group input-group-alternative ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-danger text-white"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="inward_date" class="form-control form-control-lg text-white bg-gradient-danger" placeholder="Inward Date" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-danger text-white"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="inward_report_date" class="form-control form-control-lg text-white bg-gradient-danger" placeholder="Invard Due Date" type="text" >
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>

                            </div>

                            <div class="row">

                            <div class=" col-md-12 form-group input-group{{ $errors->has('inward_client') ? ' has-danger' : '' }}">
                                    
                                    <select name="inward_client" id="inward_client"  class=" rounded custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_client') ? ' is-invalid' : '' }}" required >
                                        <option class="bg-danger display-4" selected disabled>-- Select Client --</option>
                                        @foreach($clients as $client)
                                        <option class="bg-danger display-4" value="{{ $client['client_id'] }}">{{ $client['client_name'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('inward_client'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_client') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>


                            <div class="row">

                            
                            

                            <div class="col-md-4 form-group input-group{{ $errors->has('inward_test') ? ' has-danger' : '' }}">
                    
                                <select class="inward-test form-control form-control-lg custom-select custom-select-lg font-weight-bold text-white bg-gradient-danger {{ $errors->has('inward_test') ? ' is-invalid' : '' }}" name="inward_test" id="inward_test_datalist">
                                    <option selected disabled>-- Select Test -- </option>
                                @foreach($tests as $test)
                                        <option class="display-4 bg-danger"  value="{{ $test['test_id'] }}">{{ $test['test_name'] }}</option>
                                        @endforeach
                                </select>



                                    @if ($errors->has('inward_test'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_test') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group input-group {{ $errors->has('inward_material') ? ' has-danger' : '' }}">
                                    
                                    <select name="inward_material" id="inward_material_dropdown" class="custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_material') ? ' is-invalid' : '' }}" required readonly="true">
                                        <option selected disabled>No Test Selected</option>
                                    </select>


                                    @if ($errors->has('inward_material'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_material') }}</strong>
                                        </span>
                                    @endif
                                   
                                </div> 

                                <div class=" col-md-2 form-group{{ $errors->has('test_price') ? ' has-danger' : '' }}">
                                    
                                    <input type="number" name="test_price" id="test_price" class="form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('test_price') ? ' is-invalid' : '' }}" placeholder="Price"  required readonly>

                                    @if ($errors->has('test_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_price') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class=" col-md-2 form-group{{ $errors->has('test_qty') ? ' has-danger' : '' }}">
                                    
                                    <input type="number" name="test_qty" id="test_qty" class="form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('test_qty') ? ' is-invalid' : '' }}" placeholder="Quantity" value="{{ old('test_qty') }}" required >

                                    @if ($errors->has('test_qty'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_qty') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                         


                            <div class=" form-group{{ $errors->has('inward_description') ? ' has-danger' : '' }}">
                                    
                                    <textarea name="inward_description" class="form-control form-control-lg text-white bg-gradient-danger" placeholder="Inward Description" ></textarea>

                                    @if ($errors->has('inward_description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-block text-white bg-gradient-success  mt-4" id="insert_inward">{{ __('Add') }}</button>
                                </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>


    @push('css')
        <link type="text/css" href="{{ asset('argon') }}/vendor/Chosen/chosen.css" rel="stylesheet">
    @endpush

    @push('js')
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/Chosen/chosen.proto.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/Chosen/chosen.jquery.js"></script>

    
    <script type="text/javascript">
    
    $("#inward_client").chosen({
        inherit_select_classes: true
    });

    </script>

    @push('js')

        <script type="text/javascript">
            $('#insert_inward').click(function () {
                $('#insert_inward').attr('disabled', true);
                $('#inward_form').submit();
                return true;
            });
        </script>

    @endpush
                                
    @endpush
@endsection