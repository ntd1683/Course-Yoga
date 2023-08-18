<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">{{ __('Create Lesson') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.lesson.store')}}" method="post" enctype="multipart/form-data">
                            @include('lesson.partials.form', $lesson = new \App\Models\Lesson())
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
                    placeholder: '{{ __('Enter Course') }}',
                    allowClear: true,
                })
            });
        </script>
    @endpush
</x-admin.layouts.app>
