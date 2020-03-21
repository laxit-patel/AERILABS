@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                            
                                <h2 class="text-white mb-0"><i class="ni ni-book-bookmark text-success"></i> Reports</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active bg-success" data-toggle="tab">
                                            <span class="d-none d-md-block">Add New</span>
                                            <span class="d-md-none">+</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->

                        <div class="table-responsive bg-gradient-darker rounded py-4">
                            <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <table class="table table-flush" id="datatable_schedule" role="grid" aria-describedby="datatable-buttons_info">
                                    <thead class="thead-light">
                                    <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 230.767px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th><th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 345.75px;" aria-label="Position: activate to sort column ascending">Position</th><th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 174.167px;" aria-label="Office: activate to sort column ascending">Office</th><th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 82.2px;" aria-label="Age: activate to sort column ascending">Age</th><th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 163.55px;" aria-label="Start date: activate to sort column ascending">Start date</th><th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 140.567px;" aria-label="Salary: activate to sort column ascending">Salary</th></tr>
                                    </thead>
                                    <tfoot>
                                    <tr><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Position</th><th rowspan="1" colspan="1">Office</th><th rowspan="1" colspan="1">Age</th><th rowspan="1" colspan="1">Start date</th><th rowspan="1" colspan="1">Salary</th></tr>
                                    </tfoot>
                                    <tbody>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">Airi Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td>2008/11/28</td>
                                        <td>$162,700</td>
                                    </tr><tr role="row" class="even">
                                        <td class="sorting_1">Angelica Ramos</td>
                                        <td>Chief Executive Officer (CEO)</td>
                                        <td>London</td>
                                        <td>47</td>
                                        <td>2009/10/09</td>
                                        <td>$1,200,000</td>
                                    </tr><tr role="row" class="odd">
                                        <td class="sorting_1">Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr><tr role="row" class="even">
                                        <td class="sorting_1">Bradley Greer</td>
                                        <td>Software Engineer</td>
                                        <td>London</td>
                                        <td>41</td>
                                        <td>2012/10/13</td>
                                        <td>$132,000</td>
                                    </tr><tr role="row" class="odd">
                                        <td class="sorting_1">Brenden Wagner</td>
                                        <td>Software Engineer</td>
                                        <td>San Francisco</td>
                                        <td>28</td>
                                        <td>2011/06/07</td>
                                        <td>$206,850</td>
                                    </tr><tr role="row" class="even">
                                        <td class="sorting_1">Brielle Williamson</td>
                                        <td>Integration Specialist</td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2012/12/02</td>
                                        <td>$372,000</td>
                                    </tr><tr role="row" class="odd">
                                        <td class="sorting_1">Bruno Nash</td>
                                        <td>Software Engineer</td>
                                        <td>London</td>
                                        <td>38</td>
                                        <td>2011/05/03</td>
                                        <td>$163,500</td>
                                    </tr><tr role="row" class="even">
                                        <td class="sorting_1">Caesar Vance</td>
                                        <td>Pre-Sales Support</td>
                                        <td>New York</td>
                                        <td>21</td>
                                        <td>2011/12/12</td>
                                        <td>$106,450</td>
                                    </tr><tr role="row" class="odd">
                                        <td class="sorting_1">Cara Stevens</td>
                                        <td>Sales Assistant</td>
                                        <td>New York</td>
                                        <td>46</td>
                                        <td>2011/12/06</td>
                                        <td>$145,600</td>
                                    </tr><tr role="row" class="even">
                                        <td class="sorting_1">Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012/03/29</td>
                                        <td>$433,060</td>
                                    </tr></tbody>
                                </table>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            
        </div>
       

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">




    <!-- Data Tables JS Resources -->
    <script src="{{ asset('argon') }}/vendor/DataTables/datatables.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/AutoFill-2.3.4/js/autoFill.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/Buttons-1.6.1/js/buttons.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/ColReorder-1.5.2/js/colReorder.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/FixedColumns-3.3.0/js/fixedColumns.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/FixedHeader-3.1.6/js/fixedHeader.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/JSZip-2.5.0/jszip.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/KeyTable-2.5.1/js/keyTable.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/Responsive-2.2.3/js/responsive.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/RowGroup-1.1.1/js/rowGroup.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/RowReorder-1.2.6/js/rowReorder.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/Scroller-2.0.1/js/scroller.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/SearchPanes-1.0.1/js/searchPanes.bootstrap4.js"></script>
    <script src="{{ asset('argon') }}/vendor/DataTables/Select-1.3.1/js/select.bootstrap4.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $("#datatable_schedule").DataTable({
                searchPanes: {
                    layout: 'columns-2'
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'copy', 'print'
                ],
                buttons: {
                    buttons: [
                        { extend: 'copy', text: "<i class='fa fa-copy'></i>" , className: 'btn   btn-success' },
                        { extend: 'print', text: "<i class='fa fa-print'></i>" , className: 'btn   btn-success' },
                        { extend: 'excel', text: "<i class='fa fa-file-excel'></i>" , className: 'btn   btn-success' }
                    ]
                },

                "pageLength": 5,
                "pagingType": "numbers"
            });
        } );


    </script>


@endpush