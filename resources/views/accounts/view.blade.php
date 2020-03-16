@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' =>  'View Invoice',
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7    ">

        <div class="row">

            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0 ">
                <div class="card text-center card-profile shadow-primary">

                 Invoice Actions

                    <hr>

                    <button class="btn  btn-success m-3" id="export_to_pdf">Print</button>

                    <a href="/invoice/pay/{{ $invoices[0]->invoice_id }}" class="btn  btn-default m-3" id="export_to_pdf">Pay</a>

                </div>
            </div>

            <div class="col-xl-8 order-xl-1 ">
                <div class="card bg-secondary shadow-primary ">
                   
                    <div class="card-body">




                        <table class="table" id="invoice_table" border="1">
                            <tbody>
                            <tr>
                                <td colspan="9" class="text-center bg-darker text-white font-weight-bolder">Invoice</td>
                            </tr>
                            <tr>
                                <td colspan="5" rowspan="3">
                                    <span class="text-underline">Ahmedabad Engineering Research Institute</span><br>
                                    New York Tower A, Shop No. G - 4, Ground Floor,<br>
                                    Thaltej Cross Road, Opp Muktidham,<br>
                                    Ahmedabad, Gujarat 380054<br>
                                    <b> GSTIN : &nbsp BSUPS4056DSFD</b>
                                </td>
                                <td colspan="2">
                                    {{ $invoices[0]->invoice_id }}
                                </td>
                                <td colspan="2">
                                    {{ date('d-m-Y', strtotime($invoices[0]->created_at)) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Buyer's Referene</td>
                                <td colspan="2">Supplier's Reference</td>
                            </tr>
                            <tr>
                                <td colspan="2">Buyer's Order No.</td>
                                <td colspan="2">Dated</td>
                            </tr>
                            <tr>
                                <td colspan="5" rowspan="3">
                                    <span class="text-underline">Client Details</span><br>
                                    Name : &nbsp {{ $invoices[0]->client_name }}<br>
                                    Address : &nbsp {{ $invoices[0]->client_address }}<br>
                                    GSTIN : &nbsp{{ $invoices[0]->client_gstin }}
                                </td>
                                <td colspan="2">Dispatch Document No.</td>
                                <td colspan="2">Delivery Note</td>
                            </tr>
                            <tr>
                                <td colspan="2">Dispatched Through</td>
                                <td colspan="2">Destination</td>
                            </tr>
                            <tr>
                                <td colspan="2">Terms </td>
                                <td colspan="2">Conditions</td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-center">Invoice Items</td>
                            </tr>
                            <tr class="bg-darker text-white font-weight-bolder">
                                <td>Sr.No</td>
                                <td colspan="3">Description of Goods</td>
                                <td>HSN/SAC</td>
                                <td>Qty</td>
                                <td>Rate</td>
                                <td>Per</td>
                                <td>Amount</td>
                            </tr>
                            <?php $counter = 1; ?>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $counter  }}</td>
                                <td colspan="3">{{$item->test_name}}</td>
                                <td></td>
                                <td>Test</td>
                                <td>{{$item->record_price}}</td>
                                <td>{{$item->record_qty}}</td>
                                <td>{{$item->record_qty * $item->record_price}}</td>
                            </tr>
                            <?php $counter++ ?>
                            @endforeach

                            <tr >
                                <td></td>
                                <td colspan="7" class="text-right"> TAX </td>

                                <td>{{   $invoices[0]->invoice_tax  }}</td>
                            </tr>

                            <tr class="bg-darker text-white font-weight-bolder">
                                <td></td>
                                <td colspan="6" class="text-right">Total</td>
                                <td>{{  $invoices[0]->invoice_qty }}</td>
                                <td>{{   $invoices[0]->invoice_total  }}</td>
                            </tr>

                            <tr>
                                <td colspan="9" class="text-right ">Amount in Words : <span class="font-weight-bolder text-dark">{{ ucwords($amount_in_word)  }}</span></td>
                            </tr>




                            <tr class="bg-darker text-white font-weight-bolder">
                                <td colspan="6">Banking Details</td>
                                <td colspan="3">Authorised Signatory</td>
                            </tr>
                            <tr>
                                <td>Bank Name</td>
                                <td colspan="5"> BANK OF INDIA - 497</td>
                                <td colspan="3" rowspan="3"></td>
                            </tr>
                            <tr>
                                <td>A/C NO</td>
                                <td colspan="5">203620110000497</td>
                            </tr>
                            <tr>
                                <td>IFSC</td>
                                <td colspan="5">BKID0002036</td>
                            </tr>


                            </tbody>
                        </table>







                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    </div>

    @push('js')

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <script type="text/javascript">
            $("#export_to_pdf").on("click", function () {

                html2canvas($('#invoice_table')[0], {
                    onrendered: function (canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 500,
                                
                            }]
                        };
                        pdfMake.createPdf(docDefinition).download("Table.pdf");
                    }
                });
            });
        </script>

    @endpush

@endsection