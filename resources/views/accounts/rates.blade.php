@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Rate List')])


    @push('css')
        <link type="text/css" href="{{ asset('argon') }}/vendor/Chosen/chosen.css" rel="stylesheet">
    @endpush


    <div class="container-fluid mt--7">
        @if (session('status'))
            <div class="alert text-white alert-success text-default alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close test-default" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            @if (session('error'))
                <div class="alert text-white alert-danger text-default alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close test-default" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="row ">


            <div class="col-xl-6  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Rate List') }}</h3>

                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('material.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf


                            <div class="row">

                                <div class="col-md-12 form-group{{ $errors->has('select_rate_client') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Select Client') }}</label>

                                    <select name="select_rate_client" id="select_rate_client"  class=" rounded custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('select_rate_client') ? ' is-invalid' : '' }}" required >
                                        <option class="bg-gradient-bliss display-4" selected disabled> -- Select Client -- </option>
                                        @foreach($clients as $client)
                                            <option class="bg-gradient-bliss display-4" value="{{ $client['client_id'] }}">{{ $client['client_name'] }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <hr>


                            <div id="rates_container" class="bg-bliss text-center">



                                <div class="row">
                                    <div class="col">
                                        <div class="card bg-default shadow">
                                            <div class="card-header bg-transparent border-0">
                                                <h3 class="text-white mb-0" id="table_title">Price List</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table align-items-center table-dark table-flush rounded-lg">
                                                    <thead class="thead-dark ">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Test</th>
                                                        <th scope="col" class="sort" data-sort="budget">Base Price</th>
                                                        <th scope="col" class="sort" data-sort="status">Client Price</th>
                                                        <th scope="col" >Edit</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbody_rates_table">

                                                    <tr id="placeholder_row">
                                                        <th colspan="4">
                                                            <div class="badge btn-block btn badge-lg badge-default" > No Client Selected</div>
                                                        </th>
                                                    </tr>



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-6  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add New Rates') }}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                        <form method="post" id="rates_form" action="{{ route('ratesStore') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-md-12 form-group{{ $errors->has('rates_client') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Select Client') }}</label>


                                    <select name="rates_client" id="rates_client"  class=" rounded custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('rates_client') ? ' is-invalid' : '' }}" required >
                                        <option class="bg-gradient-bliss display-4" selected disabled> -- Select Client -- </option>
                                        @foreach($clients as $client)
                                            <option class="bg-gradient-bliss display-4" value="{{ $client['client_id'] }}">{{ $client['client_name'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('rates_client'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rates_client') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-8 form-group{{ $errors->has('rates_test') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Select Test') }}</label>


                                    <select name="rates_test" id="rates_test"  class=" rounded custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('rates_test') ? ' is-invalid' : '' }}" required >
                                        <option class="bg-gradient-bliss display-4" selected disabled> -- Select Test -- </option>
                                        @foreach($tests as $test)
                                            <option class="bg-gradient-bliss text-white display-4" value="{{ $test['test_id'] }}">{{ $test['test_name'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('rates_test'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rates_test') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('rates_base_test') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Base Rates') }}</label>

                                    <input type="text" name="rates_base_rates" id="rates_base_rates" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('rates_base_rates') ? ' is-invalid' : '' }}" placeholder="Base Rate" readonly>

                                    @if ($errors->has('rates_base_test'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rates_base_test') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            </div>


                            <div class="row">

                                <div class="col-md-6 form-group{{ $errors->has('rates_rate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('New Rate') }}</label>

                                    <input type="number" name="rates_rates" id="rates_rates" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('rates_rates') ? ' is-invalid' : '' }}" placeholder="Rate"  required >

                                    @if ($errors->has('rates_rates'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rates_rates') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">


                                    <input type="submit" class="btn btn-block btn-lg  form-control form-control-lg btn-success mt-4">


                                </div>



                            </div>



                        </form>
                    </div>
                </div>
            </div>

        </div>

            <!-- modal for individual price change -->


                <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered " role="document">
                        <div class="modal-content bg-gradient-bliss text-white">

                            <div class="modal-header">
                                <h6 class="modal-title text-white" id="modal-title-notification">Enter New Rate</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-white"><i class="fa fa-times-circle"></i></span>
                                </button>
                            </div>

                            <div class="modal-body">


                                    <form method="get" action="/rates/ratesUpdate" id="change_rate_form">

                                    <input type="hidden" name="modal_client_id" id="modal_client_id">
                                    <input type="hidden" name="modal_test_id" id="modal_test_id">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="modal_client_name">Client Name</label>
                                                <input type="text" name="modal_client_name" class="form-control" id="modal_client_name" readonly required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="modal_test_name">Test Name</label>
                                                <input type="text" name="modal_test_name" class="form-control" id="modal_test_name" readonly required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="modal_test_price">New Rates</label>
                                                <input type="number" name="modal_test_price" class="form-control" id="modal_test_price" required>

                                            </div>
                                        </div>
                                    </form>


                            </div>

                            <div class="modal-footer">
                                <button type="button" id="change_rate_trigger" class="btn btn-white">Save Changes</button>

                            </div>

                        </div>
                    </div>

            <!-- modal for individual price change -->

        @include('layouts.footers.auth')
    </div>

    @push('js')
        <script src="{{ asset('argon') }}/vendor/Chosen/chosen.proto.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/Chosen/chosen.jquery.js"></script>


        <script type="text/javascript">

            $("#rates_client").chosen({
                inherit_select_classes: true
            });

            $("#rates_test").chosen({
                inherit_select_classes: true
            });

            $("#select_rate_client").chosen({
                inherit_select_classes: true
            });

            $(document).on("click", "#modal_trigger", function () {
                var client = $(this).data('client');
                var test = $(this).data('test');
                var client_name = $(this).data('clientname');
                var test_name = $(this).data('testname');
                console.log(client);
                $("#modal_client_id").val( client );
                $("#modal_test_id").val( test );
                $("#modal_client_name").val( client_name );
                $("#modal_test_name").val( test_name );

                // As pointed out in comments,
                // it is unnecessary to have to manually call the modal.
                $('#modal-notification').modal('show');
            });

        </script>

            <script type="text/javascript">
                //normal submit form
                $('#insert_rates').click(function () {
                    $('#insert_rates').attr('disabled', true);
                    $('#rates_form').submit();
                    return true;
                });

                //modal form update
                $('#change_rate_trigger').click(function () {
                    $('#change_rate_trigger').attr('disabled', true);
                    $('#change_rate_form').submit();
                    return true;
                });
            </script>

    @endpush

@endsection