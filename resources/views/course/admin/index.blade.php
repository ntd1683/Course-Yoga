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
                        <h3 class="page-title">{{ __('Course') }}</h3>
                    </div>
                    <div class="col-auto text-right">
                        <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a>
                        <a href="{{ route('admin.course.create') }}" class="btn btn-primary add-button ml-3">
                            <i class="fas fa-plus"></i>
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
                                    <label for="select_title">{{ __('Title') }}</label>
                                    <select class="form-control select" name="title" id="select_title"
                                            style="text-align: center">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label for="select_user">{{ __('Author') }}</label>
                                    <select class="form-control select" id="select_user" style="text-align: center">
                                        <option value="0">{{ __('All Users') }}</option>
                                        <option value="{{ auth()->user()->name }}">{{ __('Me') }}</option>
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
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('View') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Author') }}</th>
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
                    ajax: '{!! route('admin.ajax.course') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        {
                            data: 'title',
                            render: function (data, type, row, meta) {
                                return `<p title="${data.title}">${data.value}</p>`;
                            }
                        },
                        { data: 'type', name: 'type' },
                        { data: 'view', name: 'view' },
                        { data: 'price', name: 'price' },
                        { data: 'author', name: 'author' },
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

                const selectTitle = $('#select_title');

                selectTitle.select2({
                    ajax: {
                        url: "{{route('admin.ajax.course.search.title')}}",
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
                                        id: item.title,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter Title') }}',
                    allowClear:true,
                });

                selectTitle.change(function () {
                    table.columns(1).search(this.value).draw();
                });
                $('#select_user').change(function () {
                    table.columns(5).search(this.value).draw();
                });

                $(document).on('click','.btn-delete',function(e){
                    let confirm_delete = confirm("Are you sure you want to delete it?");
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
                                    "text": "{{ __('Delete Course Successfully') }}",
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
