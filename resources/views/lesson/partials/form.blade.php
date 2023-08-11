@csrf
<div class="tab-content pt-0">
    <div id="general" class="tab-pane active">
        <div class="card mb-0">
            <div class="card-body">
                <div class="form-group">
                    <label for="course" class="font-weight-bold">{{ __('Course') }}</label>
                    <select name="course_id" id="course" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" class="form-control" value="{{ old('title') ?: $lesson->title }}"
                           placeholder="{{ __('Title') }}..." name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <x-admin.forms.inputs.textarea placeholder="{{ __('Description') }}..."
                                                   id="description"
                                                   name="description">{{ old('description') ?: $lesson->description }}</x-admin.forms.inputs.textarea>
                </div>
                <div class="form-group">
                    <label for="link_embedded">{{ __('Link Embedded') }}</label>
                    <input type="text" class="form-control" placeholder="{{ __('https://www.youtube.com/watch?v=xxxxxxx') }}"
                           id="link_embedded" name="link_embedded"
                           value="{{ old('link_embedded') ?: $lesson->link_embedded }}">
                </div>
                <div class="form-group">
                    <label for="view">{{ __('View') }}</label>
                    <input type="number" class="form-control"
                           id="view" name="view" value="{{ old('view') ?: $course->view }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Image') }}</label>
                    <x-admin.forms.inputs.image name="image"
                                                value="{{ $lesson->image == null ? null : Storage::url( old('image') ?: $lesson->image ) }}"
                                                class="text-center" style="width:fit-content;"/>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="published"
                                       @checked($lesson->published == 1) id="published">
                                <span class="ms-2 h5">{{ __('Publish') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->level >= 2)
                    <div class="form-group d-none" id="accepted">
                        <div class="col-md-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="accepted" @checked($lesson->accepted == 1)>
                                    <span class="ms-2 h5">{{ __('Accept') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <x-admin.forms.buttons.primary type="submit">{{ __('Save Changes') }}</x-admin.forms.buttons.primary>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function () {
            if ($('#published:checkbox:checked').length) {
                if ($('#accepted').length) {
                    $('#accepted').toggleClass('d-none');
                }
            }

            $('#published').on('click', () => {
                if ($('#accepted').length) {
                    $('#accepted').toggleClass('d-none');
                }
            })
        });
    </script>
@endpush
