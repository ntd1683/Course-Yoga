<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">{{ __('Create Course') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row d-none" id="error">
                <div class="col-12">
                    <h3 class="page-title text-danger font-bold">{{ __('Error') }}</h3>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body p-0 text-danger" id="text-error">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.ajax.course.import.sheet')}}" method="post" id="form_import" onsubmit="return false;">
                            @csrf
                            <div class="tab-content pt-0">
                                <div id="general" class="tab-pane active">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="sheet">{{ __('Link Sheet') }}</label>
                                                <input type="text" class="form-control" value="{{ old('sheet') }}"
                                                       placeholder="https://docs.google.com/spreadsheets/d/xxxxxxxxx" name="sheet" id="sheet">
                                            </div>
                                            <div class="form-group">
                                                <label for="sheet_tab_name">{{ __('Sheet Tab Name') }}</label>
                                                <input type="text" class="form-control" value="{{ old('sheet_tab_name') }}"
                                                       placeholder="{{ __('Sheet1') }}" name="sheet_tab_name" id="sheet_tab_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="name_title">{{ __('Name') }} {{ __('Column') }} {{ __('Title') }}</label>
                                                <input type="text" class="form-control" value="{{ old('name_title') }}"
                                                       placeholder="{{ __('Example') }}: {{ __('Title') }}" name="name_title" id="name_title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name_description">{{ __('Name') }} {{ __('Column') }} {{ __('Description') }}</label>
                                                <input type="text" class="form-control" value="{{ old('name_description') }}"
                                                       placeholder="{{ __('Example') }}: {{ __('Description') }}" name="name_description" id="name_description">
                                            </div>
                                            <div class="form-group">
                                                <label for="name_link_embedded">{{ __('Name') }} {{ __('Column') }} {{ __('Link Embedded') }}</label>
                                                <input type="text" class="form-control" value="{{ old('name_link_embedded') }}"
                                                       placeholder="{{ __('Example') }}: {{ __('Link Embedded') }}" name="name_link_embedded" id="name_link_embedded">
                                            </div>
                                            <div class="form-group">
                                                <label for="name_type">{{ __('Name') }} {{ __('Column') }} {{ __('Type') }}</label>
                                                <input type="text" class="form-control" value="{{ old('name_type') }}"
                                                       placeholder="{{ __('Example') }}: {{ __('Type') }}" name="name_type" id="name_type">
                                            </div>
                                            <div class="form-group">
                                                <label for="name_price">{{ __('Name') }} {{ __('Column') }} {{ __('Price') }}</label>
                                                <input type="text" class="form-control" value="{{ old('name_price') }}"
                                                       placeholder="{{ __('Example') }}: {{ __('Price') }}" name="name_price" id="name_price">
                                            </div>
                                            <div class="form-group">
                                                <label for="name_image">{{ __('Name') }} {{ __('Column') }} {{ __('Image') }}</label>
                                                <input type="text" class="form-control" value="{{ old('name_image') }}"
                                                       placeholder="{{ __('Example') }}: {{ __('Image') }}" name="name_image" id="name_image">
                                            </div>
                                            <div class="form-group">
                                                <label for="name_view">{{ __('Name') }} {{ __('Column') }} {{ __('View') }}</label>
                                                <input type="text" class="form-control" value="{{ old('name_view') }}"
                                                       placeholder="{{ __('Example') }}: {{ __('View') }}" name="name_view" id="name_view">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <x-admin.forms.buttons.primary type="button" id="button_submit">
                                        <span class="spinner-border spinner-border-sm mr-2 d-none" role="status" id="spinner"></span>
                                        {{ __('Save Changes') }}
                                    </x-admin.forms.buttons.primary>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('#button_submit').click(() => {
                const form = $('#form_import');
                $('#spinner').toggleClass('d-none')
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: "json",
                    success: function (response) {
                        $('#spinner').toggleClass('d-none');
                        toasting.create({
                            "title": "Success",
                            "text": response.message,
                            "type": "success",
                            "progressBarType": "rainbow"
                        });

                        $('#error').removeClass('d-none');
                        let error;

                        $.each(response.data, (index, value) => {
                            error += `<p>${value}</p>`;
                        })

                        $('#text-error').html(error);

                        $('html, body').animate({
                            scrollTop: $("#text-error").offset().top
                        }, 200);
                    },
                    error: function (response) {
                        $('#spinner').toggleClass('d-none');
                        toasting.create({
                            "title": "Error",
                            "text": response.responseJSON.message,
                            "type": "error",
                            "progressBarType": "rainbow"
                        });
                    }
                });
            })
        </script>

    @endpush
</x-admin.layouts.app>
