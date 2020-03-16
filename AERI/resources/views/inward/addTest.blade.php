@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Select Test')])   


    @push('css')
    <link type="text/css" href="{{ asset('argon') }}/vendor/Chosen/chosen.css" rel="stylesheet">
    @endpush

    <div class="container-fluid mt--7 shadow-lg">
        <div class="row ">
            <div class="col-xl-12  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Select Test') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('inward.index') }}" class="btn btn-sm bg-gradient-indigo text-white">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('inward.store') }}" autocomplete="off">
                            @csrf
                            

                            <div class="row">

                                <div class=" col-md-6 form-group input-group{{ $errors->has('inward_client') ? ' has-danger' : '' }}">

                                    <select name="inward_client" id="select_inward_filltable"  class=" rounded custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_client') ? ' is-invalid' : '' }}" required autofocus>
                                       <option selected disabled>Select Inward</option>
                                    @foreach($inwards as $inward)
                                        <option class="bg-danger display-4" value="{{ $inward->inward_id }}">{{ $inward->inward_id }} - {{ $inward->client_name }} </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('inward_client'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_client') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                

                                <div class=" col-md-6 form-group input-group{{ $errors->has('inward_client') ? ' has-danger' : '' }}">
                                    
                                    <select name="inward_client" id="inward_client"  class=" rounded custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_client') ? ' is-invalid' : '' }}" required autofocus>
                                        @foreach($clients as $client)
                                        <option> Select Quotation </option>s
                                        <!-- <option class="bg-danger display-4" value="{{ $client['client_id'] }}">{{ $client['client_name'] }}</option> -->
                                        @endforeach
                                    </select>

                                    @if ($errors->has('inward_client'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_client') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>

                            </div>

                           
<hr>

                        <table class="table ">
                        <thead class="bg-darker text-white   ">
                            <tr>
                            <th scope="col">Test</th>
                            <th scope="col">Material</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="test_table_body">
                            <tr>
                            <th colspan="5" class="text-center">No <span class="btn btn-sm bg-red text-white">Inward</span> or <span class="btn btn-sm bg-yellow text-white">Quotation </span> Selected</th>
                            
                            </tr>
                        
                        
                        </tbody>
                        </table>

<hr>

                            <div class="row">

                            <div class="col-md-6 form-group input-group{{ $errors->has('inward_test') ? ' has-danger' : '' }}">
                    
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

                                <div class="col-md-6 form-group input-group {{ $errors->has('inward_material') ? ' has-danger' : '' }}">
                                    
                                    <select name="inward_material" id="inward_material_dropdown" class="custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_material') ? ' is-invalid' : '' }}" required autofocus>
                                        <option selected disabled>No Test Selected</option>
                                    </select>
                                    @if ($errors->has('inward_material'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('inward_material') }}</strong>
                                        </span>
                                    @endif
                                   
                                </div> 

                            </div>

                         

                            <div class="btn-group " role="group" style="width:100%">
                            <button type="submit" class="btn btn-lg btn-block bg-gradient-primary text-white  mt-4">{{ __('Add & Return') }}</button>
                                <button type="submit" class="btn btn-lg btn-block bg-gradient-success text-white mt-4">{{ __('Add & Exit') }}</button>
                                </div>
                          
                           
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>


    @push('js')
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/Chosen/chosen.proto.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/Chosen/chosen.jquery.js"></script>

    
    <script type="text/javascript">
    console.log('chosen initiated');
    
    $("#inward_client").chosen({
        inherit_select_classes: true
    });

    </script>                            
                                
    @endpush
@endsection