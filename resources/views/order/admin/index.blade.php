<x-admin.layouts.app>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/lib/datatable.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lib/select2.css') }}">
    @endpush
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">{{ __('Orders') }}</h3>
                    </div>
                    <div class="col-auto text-right">
                        <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card filter-card" id="filter_inputs">
                <div class="card-body pb-0">
                    <form action="#" method="post">
                        <div class="row filter-row">
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label for="select_name">{{ __('Name') }}</label>
                                    <select class="form-control select" name="name" id="select_name"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label for="select_title">{{ __('Title') }}</label>
                                    <select class="form-control select" name="title" id="select_title"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label for="select_code">{{ __('Code') }}</label>
                                    <select class="form-control select" name="code" id="select_code"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label for="select_referral_code">{{ __('Referral Code') }}</label>
                                    <select class="form-control select" name="referral_code" id="select_referral_code"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label for="select_status">{{ __('Status') }}</label>
                                    <select class="form-control select" id="select_status" style="text-align: center">
                                        <option value="-1">{{ __('ALL') }}</option>
                                        @foreach(\App\Enums\OrderStatusEnum::getArrayView() as $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 datatable" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Customer') }}</th>
                                        <th>{{ __('Course') }}</th>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Referral Code') }}</th>
                                        <th>{{ __('Created At') }}</th>
                                        <th class="text-end">{{ __('Edit') }}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/lib/datatable.js') }}"></script>
        <script src="{{ asset('js/lib/select2.js') }}"></script>
        <script>
            $(document).ready(function() {
                let table = $('#datatable').DataTable({
                    destroy: true,
                    dom: 'ltrp',
                    lengthMenu:[10,20,25,50,100],
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.ajax.order') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'user_id', name: 'user_id' },
                        { data: 'course_id', name: 'course_id' },
                        { data: 'code', name: 'code' },
                        {
                            data: 'status',
                            render: function (data, type, row, meta) {
                                if(data === 1) {
                                    return `<span><i class="fas fa-check"></i>{{ __('Paid') }}</span>`;
                                } else {
                                    return `<span><i class="fas fa-times"></i>{{ __('Waiting') }}</span>`;
                                }
                            }
                        },
                        { data: 'total', name: 'total' },
                        { data: 'referral_code', name: 'referral_code' },
                        { data: 'created_at', name: 'created_at' },
                        {
                            data: 'edit',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<a class="btn btn-sm bg-success-light mr-2" href="${data}"><i class="far fa-edit mr-1"></i>Edit</a>`;
                            }
                        },
                    ],
                });

                const selectName = $('#select_name');

                selectName.select2({
                    ajax: {
                        url: "{{route('admin.ajax.order.search.name')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Name') }}',
                    allowClear:true,
                });

                selectName.change(function () {
                    console.log(this.value)
                    table.columns(1).search(this.value).draw();
                });

                const selectTitle = $('#select_title');

                selectTitle.select2({
                    ajax: {
                        url: "{{route('admin.ajax.order.search.title')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.title,
                                        id: item.id,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Title') }}',
                    allowClear:true,
                });

                selectTitle.change(function () {
                    table.columns(2).search(this.value).draw();
                });

                const selectCode = $('#select_code');

                selectCode.select2({
                    ajax: {
                        url: "{{route('admin.ajax.order.search.code')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.code,
                                        id: item.code,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Code') }}',
                    allowClear:true,
                });

                selectCode.change(function () {
                    table.columns(3).search(this.value).draw();
                });

                const selectReferralCode = $('#select_referral_code');

                selectReferralCode.select2({
                    ajax: {
                        url: "{{route('admin.ajax.order.search.referral-code')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.referral_code,
                                        id: item.referral_code,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Referral Code') }}',
                    allowClear:true,
                });

                selectReferralCode.change(function () {
                    table.columns(6).search(this.value).draw();
                });
                $('#select_status').change(function () {
                    if(this.value != -1) {
                        table.columns(4).search(this.value).draw();
                    } else {
                        table.columns(4).search('').draw();
                    }
                });
            });
        </script>
    @endpush
</x-admin.layouts.app>
