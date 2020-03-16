@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' =>  'Inward',
        'class' => 'col-lg-12'
    ])   

    <div class="container-fluid mt--7">

        <div class="row">
        
            <div class="col-xl-5 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow-primary">
                <div class="card-header bg-gradient-red border-0">
                        <div class="row align-items-center ">
                            <h3 class="col-12 mb-0 text-white">Tests</h3>
                        </div>
                    </div>

                    <div class="card-body ">




                                    <div class="row">
                                        <div class="col">
                                            <div class="card bg-default shadow">
                                                <div class="card-header bg-transparent border-0">
                                                    <h3 class="text-white text-center mb-0" id="table_title">Pending Tests</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-dark table-flush rounded-lg">
                                                        <thead class="thead-dark ">
                                                        <tr>
                                                            <th scope="col" class="sort" data-sort="name">Name</th>
                                                            <th scope="col" class="sort" data-sort="budget">Assigned To</th>
                                                            <th scope="col" class="sort" data-sort="status">Quantity</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody id="tbody_rates_table">

                                                        @foreach ($records as $record)

                                                            <tr

                                                            >
                                                                <td class="text-left">
                                                                    {{ $record->test_name }}
                                                                </td>

                                                                <td class="text-right">

                                                                    @if( $record->record_assign_to == NULL )

                                                                        <select class="custom-select custom-select-sm" onchange="javascript:handleSelect(this)">
                                                                            <option selected disabled>--Assign--</option>
                                                                            @foreach ($users as $user)
                                                                                <option value="/assignRecord/{{ $record->record_id }}/to/{{$user->id }}" > {{ $user->name }} </option>
                                                                            @endforeach
                                                                        </select>

                                                                    @else

                                                                        {{ $record->name }}
                                                                    @endif

                                                                </td>

                                                                <td class="text-right">
                                                                    {{ $record->record_qty }}
                                                                </td>

                                                            </tr>


                                                        @endforeach



                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                        <hr>

                        <form method="post" action="{{ route('addNewRecord') }}" autocomplete="off">
                            @csrf

                            <input type="hidden" value={{ $inwards[0]->inward_id }} name="inward_id">
  
                        <div class="row " id="test-selection">

                        <div class="col-md-12 form-group input-group{{ $errors->has('inward_test') ? ' has-danger' : '' }}">

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

                            <div class="col-md-12 form-group input-group {{ $errors->has('inward_material') ? ' has-danger' : '' }}">
                                
                                <select name="inward_material" id="inward_material_dropdown" class="custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('inward_material') ? ' is-invalid' : '' }}" required >
                                    <option selected disabled>No Test Selected</option>
                                    
                                    
                                </select>


                                @if ($errors->has('inward_material'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('inward_material') }}</strong>
                                    </span>
                                @endif
                            
                            </div> 

                            <div class="col-md-6 form-group{{ $errors->has('test_price') ? ' has-danger' : '' }}">
                                    
                                    <input type="text" name="test_price" id="test_price" class="form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('test_price') ? ' is-invalid' : '' }}" placeholder="Price"  required readonly>

                                    @if ($errors->has('test_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_price') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class=" col-md-6 form-group{{ $errors->has('test_qty') ? ' has-danger' : '' }}">
                                    
                                    <input type="text" name="test_qty" id="test_qty" class="form-control form-control-lg font-weight-bold text-white bg-gradient-danger form-control-alternative{{ $errors->has('test_qty') ? ' is-invalid' : '' }}" placeholder="Quantity" value="{{ old('test_qty') }}" required >

                                    @if ($errors->has('test_qty'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('test_qty') }}</strong>
                                        </span>
                                    @endif
                                </div>

                        </div>

                        <div class="btn btn-success btn-block btn-lg" id="test-selection-trigger">Add New</div>
                        <button type="submit" class="btn btn-success btn-block text-white btn-lg" id="test-selection-add">Add </button>
                        
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-xl-7 order-xl-1 ">
                <div class="card bg-secondary shadow-primary">
                    <div class="card-header bg-gradient-red border-0">
                        <div class="row align-items-center">

                        <div class="accordion container-fluid" id="accordionExample">
                        <span class="text-white">{{ $inwards[0]->client_name }}</span>
                        <div class="bg-transparent float-right text-white collapsed"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        
                                <i class="fas fa-caret-down text-white"></i>            
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">





                        <table class="table bg-darker text-white rounded">
                        
                        <thead>
                        <tr>
                            <th colspan=2>
                            <h3 class="text-center text-white"> Consignee Details</h3>
                            </th>
                        </tr>
                        <tr>
                            <td> GSTIN </td>
                            <td> {{ $inwards[0]->client_gstin }} </td>
                        <tr>
                        <tr>
                            <td> Mobile </td>
                            <td> {{ $inwards[0]->client_phone }} </td>
                        <tr>
                        <tr>
                            <td> Email </td>
                            <td> {{ $inwards[0]->client_email }} </td>
                        <tr>
                        <tr>
                            <td> Address </td>
                            <td> {{ $inwards[0]->client_address }} </td>
                        <tr>
                        </thead>
                        </table>


                    </div>
                    </div>
                </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" autocomplete="off">
                            @csrf
                            @method('put')

                            <input type="hidden" name="inward_client" id="inward_client" value="{{ $inwards[0]->client_id  }}">
                            
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif   

                            <div class="container">
                            
                            <div class="input-daterange datepicker row align-items-center">
                                <div class="col">
                                    <div class="form-group ">
                                        <label>Inward Date</label>
                                        <div class="input-group input-group-alternative ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-danger text-white"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="inward_date" class="form-control form-control-lg text-white bg-gradient-danger" value="{{ $inwards[0]->inward_date }}" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Report Date</label> 
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-danger text-white"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="inward_report_date" class="form-control form-control-lg text-white bg-gradient-danger" value="{{ $inwards[0]->inward_report_date }}" type="text" >
                                        </div>
                                    </div>
                                </div>
                                </div>

                            </div>

                            
<hr>
                                <span class="mr-2 progress-meter"></span>
                                <div>
                                <div class="progress" >
                                    <div class="progress-bar bg-info" role="progressbar" id="progress-bar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                </div>
                                </div>


                                <div class="btn-group " role="group" style="width:100%">
                                <a href="/inward" class="btn btn-block btn-primary float-left mt-4">{{ __('Back') }}</a>
                                <a href="/inward" class="btn btn-block btn-success float-right mt-4 ">{{ __('Invoice') }}</a>
                                </div>
                                
                                    
                                
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        @push('js')
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        
    <!-- Handle Task Assignment -->
    <script type="text/javascript">
    function handleSelect(elm)
    {
        window.location = elm.value;
    }
    </script>
    <!-- task assignment ends -->

    <script type="text/javascript">
    $("#test-selection").hide();
    $("#test-selection-add").hide();
        
    $("#test-selection-trigger").on('click', function () {
        $(this).hide();
        $("#test-selection").fadeIn("slow");
        $("#test-selection-add").fadeIn("slow");

    });

    </script>                              
                                
    @endpush
        
        @include('layouts.footers.auth')
    </div>
@endsection