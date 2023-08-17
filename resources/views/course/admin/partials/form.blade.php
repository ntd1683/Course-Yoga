@csrf
<div class="tab-content pt-0">
    <div id="general" class="tab-pane active">
        <div class="card mb-0">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" class="form-control" value="{{ old('title') ?: $course->title }}"
                           placeholder="{{ __('Title') }}..." name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <x-admin.forms.inputs.textarea placeholder="{{ __('Description') }}..."
                                                   id="description" name="description">{{ old('description') ?: $course->description }}</x-admin.forms.inputs.textarea>
                </div>
                <div class="form-group">
                    <label for="link_embedded">{{ __('Link Embedded') }}</label>
                    <input type="text" class="form-control" placeholder="{{ __('https://www.youtube.com/playlist?list=xxxxxxxx') }}"
                           id="link_embedded" name="link_embedded" value="{{ old('link_embedded') ?: $course->link_embedded }}">
                </div>
                <div class="form-group">
                    <label for="site_address">{{ __('Price') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">VNĐ</span>
                        </div>
                        <input type="text" class="form-control"
                               aria-label="{{ __('Amount (to the nearest VND)') }}"
                               name="price" value="{{ old('price') ?: $course->price/1000 }}">
                        <div class="input-group-append">
                            <span class="input-group-text">.000</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type">{{ __('Type') }}</label>
                    <select class="form-control" id="type" name="type">
                        @foreach(\App\Enums\CourseTypeEnum::getArrayView() as $key => $value)
                            <option value="{{ $value }}" @selected($value == old('type') || $course->type )>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="view">{{ __('View') }}</label>
                    <input type="number" class="form-control"
                           id="view" name="view" value="{{ old('view') ?: $course->view }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Image') }} </label>
                    <h3>{{ __('Image Size : 4x5') }}</h3>
                    <x-admin.forms.inputs.image name="image" value="{{ $course->image == null ? null : Storage::url( old('image') ?: $course->image ) }}" class="text-center" style="width:fit-content;"/>
                </div>
                @if($course->id != null)
                    <hr>
                    <div class="form-group">
                        <label for="users" class="font-weight-bold h3">{{ __('Add Lecturers') }}</label>
                        <select name="users[]" id="users" multiple="multiple" class="form-control">

                        </select>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <x-admin.forms.buttons.primary type="submit">{{ __('Save Changes') }}</x-admin.forms.buttons.primary>
    </div>
</div>
