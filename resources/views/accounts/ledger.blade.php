@extends('layouts.app')


@push('css')
    <!-- Fresh Bootrsap Table-->
    <link type="text/css" href="{{ asset('argon') }}/vendor/fresh-table/fresh-bootstrap-table.css" rel="stylesheet">

@endpush

@section('content')
    @include('layouts.headers.cards')



    <div class="container-fluid mt--7 ">

        <div class="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert text-white alert-success text-default alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close test-default" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="col-xl-12 mb-5 mb-xl-0 ">

                <div class="fresh-table full-color-azure shadow-primary bg-gradient-darker">
                    <!--
                    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
                    Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
                    -->
                    <div class="toolbar ">
                        &nbsp;
                        <div class=" icon-shape bg-gradient-bliss text-white rounded-circle shadow">
                            <i class="fas fa-book "></i>
                        </div> &nbsp; Ledgers

                    </div>
                    <table id="fresh-table" class="table">
                        <thead class="text-white bg-gradient-bliss">
                        <th data-field="iscode" data-sortable="true">Client</th>
                        <th data-field="name" data-sortable="true">GST</th>
                        <th data-field="material" data-sortable="true">Debit</th>
                        <th data-field="duration">Credit</th>
                        <th data-field="action">Action</th>
                        </thead>
                        <tbody class="text-white">

                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->client_name }}</td>
                                <td>{{ $client->client_gstin }}</td>
                                <td>{{ $client->client_receivable }}</td>
                                <td>{{ $client->client_credit   }}</td>

                                <td>

                                    <a href="#!" class="avatar  bg-success  rounded-circle">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a href="#!" class="avatar bg-success  rounded-circle">
                                        <i class="fa fa-credit-card"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>



            </div>

        </div>
        @include('layouts.footers.auth')
    </div>





@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    @push('js')
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
        <script src="{{ asset('argon') }}/vendor/fresh-table/fresh-table.js"></script>

        <!-- Handle Task Assignment -->
        <script type="text/javascript">
            function handleSelect(elm)
            {
                window.location = elm.value;
            }
        </script>
        <!-- task assignment ends -->

        <script type="text/javascript">


            var $table = $('#fresh-table')
            var $alertBtn = $('#alertBtn')

            window.operateEvents = {

                'click .edit': function (e, value, row, index) {
                    location.href = '/edit/'+row._data.inward;
                },

            }

            function operateFormatter(value, row, index) {
                return [
                    '<div class="table-action edit"  >',
                    '<a class=" icon-shape bg-gradient-info text-white rounded-circle shadow">',
                    '<i class="fas fa-edit "></i>',
                    '</a>',
                    '</div>',

                ].join('')
            }

            $(function () {
                $table.bootstrapTable({
                    classes: 'table table-hover table-striped',
                    toolbar: '.toolbar',

                    search: false,
                    showRefresh: false,
                    showToggle: false,
                    showFullscreen: false,


                    pagination: true,
                    striped: true,
                    sortable: true,
                    pageSize: 8,
                    pageList: [8, 10, 25, 50, 100],


                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        return ''
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + ' rows visible'
                    }
                })

                $alertBtn.click(function () {
                    alert('You pressed on Alert')
                })
            })

            function router()
            {
                window.location.href = "/accounts/create ";
            }

        </script>

    @endpush
@endpush