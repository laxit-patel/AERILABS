@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Generate')])

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
            <div class="col-xl-12  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Generate Quotation New') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('material.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="post" id="quotation_form" action="{{ route('processDraft') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf


                            <div class="row">

                                <div class="col-md-4 form-group{{ $errors->has('quotation_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Quotation ID') }}</label>
                                    <input type="text" name="quotation_id" id="input-name" class="form-control form-control-lg font-weight-bold text-white bg-gradient-emo form-control-alternative{{ $errors->has('quotation_id') ? ' is-invalid' : '' }}" value="{{ $quotation[0]->quotation_id ?? '' }}" required  disabled>

                                    @if ($errors->has('quotation_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quotation_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-8 form-group{{ $errors->has('quotation_client') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Client ID') }}</label>

                                    <input type="text" name="quotation_id" id="input-name" class="form-control form-control-lg font-weight-bold text-white bg-gradient-emo form-control-alternative{{ $errors->has('quotation_id') ? ' is-invalid' : '' }}" value="{{ $quotation[0]->quotation_client ?? ''  }}" required  disabled>

                                    @if ($errors->has('quotation_client'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quotation_client') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="card bg-default shadow">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="text-white mb-0" id="table_title">Item Vise Rates</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-dark table-flush rounded-lg">
                                                <thead class="thead-dark ">
                                                <tr>
                                                    <th scope="col" class="sort" data-sort="name">Test</th>
                                                    <th scope="col" class="sort" data-sort="budget">Rates</th>
                                                    <th scope="col" class="sort" data-sort="status">Qty</th>
                                                    <th scope="col" class="sort" data-sort="status">Total</th>


                                                </tr>
                                                </thead>
                                                <tbody id="tbody_items_table">

                                                @foreach ($items as $item)
                                                    <tr>
                                                        <td>{{$item[0]->test_name}}</td>
                                                        <td >{{$item[0]->test_rate}}</td>
                                                        <td><input class="form-control-sm allownumericwithoutdecimal" type="text" onkeyup='qtyXprice(this)'></td>
                                                        <td class="total_cell"><input class="form-control-sm allownumericwithoutdecimal" type="text" ></td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td id="quotation_final_qty">Qty</td>
                                                    <td id="quotation_final_total">Total</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div >
                                            <tr class="text-white">
                                                <td>Mobilization</td>
                                                <td>Mobilization</td>
                                                <td>Mobilization</td>
                                            </tr>
                                        </div>
                                        <div >
                                            <tr class="text-white">
                                                Visit Charge
                                            </tr>
                                        </div>

                                        <div >
                                            <tr class="text-white">
                                                {!! $terms  !!}
                                            </tr>
                                        </div>

                                    </div>
                                </div>
                            </div>




                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-lg  btn-success mt-4" id="quotation_trigger">{{ __('Add') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>



        </div>

        @include('layouts.footers.auth')
    </div>


    @push('js')


        <script>
            $("#quotation_final_total").text(0);
            function refreshTotal(){
                var sub_qty;
                var cell_value;
                let container;
                var sub_total;

                $('#tbody_items_table tr').each(function(){

                    $(this).find('.total_cell input').each(function(){
                        container = $(this).val();

                    })
                    $("#quotation_final_total").text( parseInt($("#quotation_final_total").text()) + Number(container));
                });

                $("#quotation_final_qty").val();

            };

            function qtyXprice(el){
                //prev cell value as price
                var price = $(el).closest('td').prev().text();
                var qty = el.value;
                var total = price * qty;
                $(el).closest('td').next().find('input').val(total);
                refreshTotal();
            };
        </script>

        <script type="text/javascript">



            $('#quotation_trigger').click(function () {
                $('#quotation_trigger').attr('disabled', true);
                $('#hidden_quotation_terms').val(JSON.stringify(quill.getContents()));
                $('#material_store_form').submit();
                return true;
            });


        </script>

    @endpush

@endsection