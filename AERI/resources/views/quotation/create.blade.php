@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Quotation')])

    <div class="container-fluid mt--7">
        <div class="row ">
            <div class="col-xl-12  order-xl-1">
                <div class="card bg-secondary  shadow-primary">
                    <div class="card-header  bg-white border-0">
                        <div class="row align-items-center ">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Generate Quotation') }}</h3>
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
                                    <input type="text" name="quotation_id" id="input-name" class="form-control form-control-lg font-weight-bold text-white bg-gradient-emo form-control-alternative{{ $errors->has('quotation_id') ? ' is-invalid' : '' }}" value="{{ $key  }}" required  disabled>

                                    @if ($errors->has('quotation_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quotation_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-8 form-group{{ $errors->has('quotation_client') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Client ID') }}</label>

                                    <select name="quotation_client" id="quotation_client"  class=" rounded custom-select custom-select-lg form-control form-control-lg font-weight-bold text-white bg-gradient-emo form-control-alternative{{ $errors->has('quotation_client') ? ' is-invalid' : '' }}" required >
                                        <option class="bg-darker display-4" selected disabled>-- Select Client --</option>
                                        @foreach($clients as $client)
                                            <option class="bg-darker display-4" value="{{ $client['client_id'] }}">{{ $client['client_name'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('quotation_client'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quotation_client') }}</strong>
                                        </span>
                                    @endif
                                </div>



                            </div>

                            <div class="     form-group{{ $errors->has('material_description') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-details">{{ __('Select Tests') }}</label>

                                        <select
                                                multiple="multiple"
                                                name="quotation_items[ ]"
                                                id="quotation_items"
                                                multiple
                                        >
                                            @foreach($tests as $test)
                                                <option class="display-4 bg-danger"  value="{{ $test['test_id'] }}">{{ $test['test_name'] }}</option>
                                            @endforeach
                                        </select>

                                @if ($errors->has('material_description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_description') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class=" form-group{{ $errors->has('material_description') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-details">{{ __('Terms & Conditions') }}</label>


                                <div id="quill_terms" ></div>

                                <textarea name="quotation_terms" style="display:none" id="hidden_quotation_terms"></textarea>

                            @if ($errors->has('material_description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('material_description') }}</strong>
                                        </span>
                                @endif
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

    @push('css')
        <link type="text/css" href="{{  asset('argon') }}/vendor/quill/dist/quill.core.css" rel="stylesheet">
        <link type="text/css" href="{{  asset('argon') }}/vendor/multi.js/multi.min.css" rel="stylesheet">
        <link type="text/css" href="{{  asset('argon') }}/vendor/Chosen/chosen.css" rel="stylesheet">
    @endpush

    @push('js')

        <script src="{{ asset('argon') }}/vendor/quill/dist/quill.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/Chosen/chosen.proto.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/Chosen/chosen.jquery.js"></script>
        <script src="{{ asset('argon') }}/vendor/multi.js/multi.min.js"></script>

        <script>
            var select = document.getElementById("quotation_items");
            multi(select, {
                non_selected_header: "Select Test",
                selected_header: "Selected Tests"
            });
        </script>

        <script type="text/javascript">

            var quill = new Quill('#quill_terms', {
                modules: {
                    toolbar: [

                        ['bold', 'italic', 'underline', 'strike'],
                        ['link'],
                        [{ 'script': 'sub'}, { 'script': 'super' }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean']
                    ]
                },
                placeholder: 'Compose an epic...',
                theme: 'snow'
            });

            $('#quotation_trigger').click(function () {
                $('#quotation_trigger').attr('disabled', true);
                $('#hidden_quotation_terms').val(JSON.stringify(quill.getContents()));
                $('#material_store_form').submit();
                return true;
            });



            $("#quotation_client").chosen({
                inherit_select_classes: true
            });
        </script>

    @endpush

@endsection