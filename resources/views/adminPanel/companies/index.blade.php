@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item">@lang('models/companies.plural')</li>
</ul>
@endsection
@section('content')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    @include('flash::message')
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                @lang('models/companies.plural')
                <span class="d-block text-muted pt-2 font-size-sm">Descriptions</span>
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body">
        @include('adminPanel.companies.table')
    </div>
</div>
<!--end::Card-->
@endsection

@section('scripts')
<script>
    "use strict";
    // Class definition
    var KTDatatableHtmlTableDemo = function() {
        // Private functions

        // demo initializer
        var demo = function() {

            var datatable = $('#kt_datatable').KTDatatable({
                data: {
                    saveState: { cookie: false },
                },
                search: {
                    input: $('#kt_datatable_search_query'),
                    key: 'generalSearch'
                },
                columns: [{
                        field: 'DepositPaid',
                        type: 'number',
                    },
                    {
                        field: 'Status',
                        title: 'Status',
                        autoHide: false,
                        // callback function support for column rendering

                        // 0 => in progress, 1 => Pending, 2 => Approved, 3 => Rejected, 4 => Deactivate
                        template: function(row) {
                            var status = {
                                0: {
                                    'title': 'In Progress',
                                    'class': ' label-light-warning'
                                },
                                1: {
                                    'title': 'Pending',
                                    'class': ' label-light-success'
                                },
                                2: {
                                    'title': 'Approved',
                                    'class': ' label-light-info'
                                },
                                3: {
                                    'title': 'Rejected',
                                    'class': ' label-light-info'
                                },
                                4: {
                                    'title': 'Deactivated',
                                    'class': ' label-light-info'
                                }
                            };
                            return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
                        },
                    },
                ],
            });



            $('#kt_datatable_search_status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'Status');
            });

            $('#kt_datatable_search_type').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'Type');
            });

            $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

        };

        return {
            // Public functions
            init: function() {
                // init dmeo
                demo();
            },
        };
    }();

    jQuery(document).ready(function() {
        KTDatatableHtmlTableDemo.init();
    });
</script>
@endsection
