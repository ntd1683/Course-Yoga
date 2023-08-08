<x-admin.layouts.app>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/lib/select2.css') }}">
    @endpush
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title pt-2">{{ __('Lesson Edit') }}</h3>
                    <div>
                        <form action="{{ route('admin.lesson.destroy', $lesson) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-admin.forms.buttons.danger
                                type="submit">{{ __('Delete') }}</x-admin.forms.buttons.danger>
                            <a href="{{ route('admin.lesson.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.lesson.update', $lesson)}}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @include('lesson.partials.form', $lesson)
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
                $('#course').select2({
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
                                        id: item.id,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: '{{ __('Enter User') }}',
                    allowClear: true,
                })

                let course = {!! $course !!};
                $("#course").select2("trigger", "select", {data: {id: course.id, text: course.title }});
            });
        </script>
    @endpush
</x-admin.layouts.app>
