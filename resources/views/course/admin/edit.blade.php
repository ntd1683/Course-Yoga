<x-admin.layouts.app>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/lib/select2.css') }}">
    @endpush
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title pt-2">{{ __('Course Edit') }}</h3>
                    <div>
                        <form action="{{ route('admin.course.destroy', $course) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-admin.forms.buttons.danger
                                type="submit">{{ __('Delete') }}</x-admin.forms.buttons.danger>
                            <a href="http://localhost/admin/course/create" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.course.update', $course)}}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @include('course.admin.partials.form', $course)
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/lib/select2.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#users').select2({
                    ajax: {
                        url: "{{route('admin.ajax.user.search.lecturers')}}",
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
                                        text: item.email,
                                        id: item.id,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter User') }}',
                    allowClear: true,
                })

                let lecturers = {!! $lecturers !!};
                lecturers.forEach(option => {
                    $("#users").select2("trigger", "select", {data: {id: option.user_id, text: option.email}});
                })
            });
        </script>
    @endpush
</x-admin.layouts.app>
