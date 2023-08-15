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
                        <h3 class="page-title">{{ __('Users Subscribed') }}</h3>
                    </div>
                    <div class="col-auto text-right">
                        <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a>
                            <a href="{{ route('admin.subscribe.create') }}" class="btn btn-primary add-button ml-3">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card filter-card" id="filter_inputs">
                <div class="card-body pb-0">
                    <form action="#" method="post">
                        <div class="row filter-row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="select_name">{{ __('Name') }}</label>
                                    <select class="form-control select" name="name" id="select_name"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="select_email">{{ __('Email') }}</label>
                                    <select class="form-control select" name="email" id="select_email"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="select_title">{{ __('Course') }}</label>
                                    <select class="form-control select" name="title" id="select_title"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="select_type">{{ __('Type') }}</label>
                                    <select class="form-control select" id="select_type" style="text-align: center">
                                        <option value="-1" selected>{{ __('Select All') }}</option>
                                        <option value="0">{{ __('Not Added') }}</option>
                                        <option value="1">{{ __('Added') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 text-center">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">{{ __('Filter') }}</button>
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
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Course') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th class="text-end">{{ __('Edit') }}</th>
                                        <th class="text-end">{{ __('Delete') }}</th>
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
                    ajax: '{!! route('admin.ajax.subscribe') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'users.name', name: 'users.name'},
                        { data: 'users.email', name: 'users.email' },
                        {
                            data: 'courses.title',
                            render: function (data, type, row, meta) {
                                return `<p title="${data.title}">${data.value}</p>`;
                            }
                        },
                        {
                            data: 'status',
                            render: function (data, type, row, meta) {
                                if(data === 1) {
                                    return `<div class="text-success"><i class="fas fa-check"></i>{{ __('Added') }}</div>`;
                                } else {
                                    return `<div class="text-danger"><i class="fas fa-times"></i></i>{{ __('Not added') }}</div>`;
                                }
                            }
                        },
                        {
                            data: 'edit',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<a class="btn btn-sm bg-success-light mr-2" href="${data}"><i class="far fa-edit mr-1"></i>Edit</a>`;
                            }
                        },
                        {
                            data: 'destroy',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<form action="${data}" method="post">
                                    @csrf
                                @method('DELETE')
                                <button type='button' class="btn btn-sm bg-danger-light mr-2 btn-delete"><i class="far fa-trash-alt mr-1"></i>Delete</button>
                                </form>`;
                            }
                        },
                    ],
                });

                const selectName = $('#select_name');

                selectName.select2({
                    ajax: {
                        url: "{{route('admin.ajax.subscribe.search.name')}}",
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
                                        text: item.user.name,
                                        id: item.user.name,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Name') }}',
                    allowClear:true,
                });

                selectName.change(function () {
                    table.columns(1).search(this.value).draw();
                });

                const selectEmail = $('#select_email');

                selectEmail.select2({
                    ajax: {
                        url: "{{route('admin.ajax.subscribe.search.email')}}",
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
                                        text: item.user.email,
                                        id: item.user.email,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Email') }}',
                    allowClear:true,
                });

                selectEmail.change(function () {
                    table.columns(2).search(this.value).draw();
                });

                const selectTitle = $('#select_title');

                selectTitle.select2({
                    ajax: {
                        url: "{{route('admin.ajax.subscribe.search.course')}}",
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
                                        text: item.course.title,
                                        id: item.course.title,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Title') }}',
                    allowClear:true,
                });

                selectTitle.change(function () {
                    table.columns(3).search(this.value).draw();
                });

                $('#select_type').change(function () {
                    if(this.value != -1) {
                        table.columns(4).search(this.value).draw();
                    } else {
                        table.columns(4).search('').draw();
                    }
                });

                $(document).on('click','.btn-delete',function(e){
                    let confirm_delete = confirm("Bạn có chắc muốn xoá không ?");
                    if (confirm_delete === true) {
                        let form = $(this).parents('form');
                        $.ajax({
                            type: "POST",
                            url: form.attr('action'),
                            data: form.serialize(),
                            dataType: "json",
                            success: function (response) {
                                toasting.create({
                                    "title": "Success",
                                    "text": response.message,
                                    "type": "success",
                                    "progressBarType": "rainbow"
                                });
                                table.draw();
                            },
                        });
                    }
                });
            });
        </script>
    @endpush
</x-admin.layouts.app>
