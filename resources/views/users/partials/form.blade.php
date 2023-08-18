@csrf
<div class="tab-content pt-0">
    <div id="general" class="tab-pane active">
        <div class="card mb-0">
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">{{ __('Name') }}</label>
                    <input type="text" class="form-control" value="{{ old('name') ?: $user->name }}"
                           placeholder="{{ __('Name') }}..." name="name" id="name">
                </div>

                <label for="">{{ __('Gender') }}</label>
                <div class="form-group d-flex justify-content-around">
                    <div>
                        <input type="radio"
                               @checked(old('gender') ? old('gender') == 1 : $user->gender == 1)
                               name="gender" id="gender" value="1">
                        <label for="gender" class="ms-2">{{ __('Male') }}</label>
                    </div>
                    <div>
                        <input type="radio"
                               @checked(old('gender') ? old('gender') == 0 : $user->gender == 0)
                               name="gender" id="gender1" value="0">
                        <label for="gender1" class="ms-2">{{ __('Female') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthdate">{{ __('Birthdate') }}</label>
                    <x-admin.forms.inputs.datepicker name="birthdate" id="birthdate"
                                                     value="{{ old('birthdate') ?: $user->birthdate }}"
                                                     placeholder="xx/xx/xxxx"/>
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('Mobile Number') }}</label>
                    <input type="text" class="form-control" placeholder="032xxxxxxxx"
                           id="phone" name="phone"
                           value="{{ old('phone') ?: $user->phone }}">
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" class="form-control" placeholder="abc@example.com"
                           id="email" name="email"
                           value="{{ old('email') ?: $user->email }}">
                </div>
                <div class="form-group">
                    <label for="level">{{ __('Level') }}</label>
                    <select name="level" id="level" class="form-control select" style="text-align:center;">
                        @foreach(\App\Enums\UserLevelEnum::getArrayView() as $key => $value)
                            <option value="{{ $value }}"
                                @selected(old('level') ? old('level') == $value : $user->level== $value )
                            >{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">{{ __('Address') }}</label>
                    <input type="text" class="form-control" placeholder="HCM"
                           name="address" id="address"
                           value="{{ old('address') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <x-admin.forms.buttons.primary type="submit">{{ __('Save Changes') }}</x-admin.forms.buttons.primary>
    </div>
</div>
