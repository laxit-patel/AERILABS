@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' =>  'Payment',
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7    ">

        <div class="row">



            <div class="col-xl-12 order-xl-1 ">
                <div class="card bg-secondary shadow-primary ">

                    <div class="card-body">



                            <form method="post" id="payment_form" action="{{ route('ProcessPayment') }}" autocomplete="off" >
                            @csrf

                                <input type="hidden" name="payment_transaction" value="{{ $invoices[0]->transaction_id }}">
                                <input type="hidden" name="payment_client" value="{{ $invoices[0]->invoice_client }}">

                            <div class="row">
                                <div class="col-md-3 form-group{{ $errors->has('payment_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Payment ID') }}</label>
                                    <input type="text" name="payment_id" id="payment_id" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('payment_id') ? ' is-invalid' : '' }}" value="{{ $key }}" required autofocus disabled>

                                    @if ($errors->has('payment_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('payment_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3 form-group{{ $errors->has('payment_invoice') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Payment Invoice') }}</label>
                                    <input type="text" name="payment_invoice" id="payment_invoice" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss {{ $errors->has('payment_invoice') ? ' is-invalid' : '' }}" placeholder="{{ __('Invoice') }}" value="{{ $invoices[0]->invoice_id  }}" readonly required autofocus>

                                    @if ($errors->has('material_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3 form-group{{ $errors->has('payment_invoice') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Payment Inward') }}</label>
                                    <input type="text" name="payment_inward" id="payment_invoice" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss {{ $errors->has('payment_invoice') ? ' is-invalid' : '' }}" placeholder="{{ __('Invoice') }}" value="{{ $invoices[0]->inward_id  }}" readonly required autofocus>

                                    @if ($errors->has('material_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3 form-group{{ $errors->has('payment_invoice') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Payment Invoice') }}</label>

                                    <select name="payment_method" id="input-material" class="custom-select  custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('test_material') ? ' is-invalid' : '' }}" required autofocus>
                                        <option selected disabled>Select Material</option>
                                        <option class="text-dark" >Cash</option>
                                        <option class="text-dark">Check</option>
                                        <option class="text-dark">N.E.F.T</option>
                                        <option class="text-dark">R.T.G.S</option>
                                    </select>

                                    @if ($errors->has('material_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-3 form-group{{ $errors->has('payment_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Check Number') }}</label>
                                        <input type="text" name="payment_mode_check_number" id="payment_mode_check_number" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss form-control-alternative{{ $errors->has('payment_id') ? ' is-invalid' : '' }}" required autofocus >

                                        @if ($errors->has('payment_id'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('payment_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-3 form-group{{ $errors->has('payment_invoice') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Check Date') }}</label>
                                        <input type="text" name="payment_mode_check_date" id="payment_invoice" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss {{ $errors->has('payment_invoice') ? ' is-invalid' : '' }}"   required autofocus>

                                        @if ($errors->has('material_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-3 form-group{{ $errors->has('payment_invoice') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Bank Name') }}</label>
                                        <input type="text" name="payment_mode_bank_name" id="payment_invoice" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss {{ $errors->has('payment_invoice') ? ' is-invalid' : '' }}"   required autofocus>

                                        @if ($errors->has('material_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-3 form-group{{ $errors->has('payment_invoice') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Amount') }}</label>
                                        <input type="text" name="payment_mode_amount" id="payment_invoice" class="form-control form-control-lg font-weight-bold text-white bg-gradient-bliss {{ $errors->has('payment_invoice') ? ' is-invalid' : '' }}"  value="{{ $invoices[0]->invoice_total  }}" required autofocus>

                                        @if ($errors->has('material_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class=" form-group{{ $errors->has('material_description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-details">{{ __('Material Description') }}</label>
                                    <textarea name="payment_mode_description" id="input-details" class="form-control bg-gradient-bliss form-control-lg text-white {{ $errors->has('material_description') ? ' is-invalid' : '' }}" placeholder="Payment Description"  required></textarea>

                                    @if ($errors->has('material_description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_description') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            <div class="text-center">
                                <button type="submit" id="payment_insert" class="btn btn-block btn-lg  btn-success mt-4">{{ __('Add') }}</button>
                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

    @push('css')



    @endpush

    @push('js')

        <script type="text/javascript">
            $('#payment_insert').click(function () {
                $('#payment_insert').attr('disabled', true);
                $('#payment_form').submit();
                return true;
            });
        </script>

    @endpush

@endsection