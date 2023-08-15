<x-admin.layouts.app>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/admin/tag.css') }}">
    @endpush
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title pt-2">{{ __('Subscription Edit') }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.subscribe.store')}}" method="post">
                            @csrf
                            <div class="tab-content pt-0">
                                <div id="general" class="tab-pane active">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title">{{ __('Course') }}</label>
                                                <select class="form-control select" name="title" id="title"
                                                        style="text-align: center">
                                                </select>
                                            </div>
                                            <h3>{{ __('Lesson') }}</h3>
                                            <div id="lesson">

                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label for="email">{{ __('Email') }}</label>
                                                    <a href="#" style="cursor:pointer" id="copy_email"><i class="far fa-clipboard"></i><span>{{ __('Copy') }}</span></a>
                                                </div>
                                                <div id="url_email" class="d-none" data-tagify="{{ route('admin.ajax.course.search.users') }}"></div>
                                                <input type="text" class="form-control" id="email" name="emails">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">{{ __('Status') }}</label>
                                                <select class="form-control" id="type" name="status" required>
                                                    <option value="0" selected>{{ __('Not Added') }}</option>
                                                    <option value="1">{{ __('Added') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <x-admin.forms.buttons.primary
                                        type="submit">{{ __('Save Changes') }}</x-admin.forms.buttons.primary>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/admin/tag.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#copy_email').click(() => {
                    let value = $('#email').val();
                    navigator.clipboard.writeText(value).then(function () {
                        // Sao chép thành công
                        alert('Đã sao chép vào clipboard');
                    }).catch(function (error) {
                        // Xảy ra lỗi
                        alert('Lỗi khi sao chép:' + error);
                    });
                })

                const selectTitle = $('#title');

                selectTitle.select2({
                    ajax: {
                        url: "{{ route('admin.ajax.course.search.title') }}",
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
                    let url = "{{ route('admin.ajax.course.search.lessons') }}";
                    let data = {
                        id: this.value,
                    };
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: data,
                        dataType: "json",
                        success: function (response) {
                            $('#lesson').html(response.data);
                        },
                        error: function (response) {
                            toasting.create({
                                "title": "Error",
                                "text": response.message,
                                "type": "error",
                                "progressBarType": "rainbow"
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-admin.layouts.app>
