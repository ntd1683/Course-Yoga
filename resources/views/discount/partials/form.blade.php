@csrf
<div class="tab-content pt-0">
    <div id="general" class="tab-pane active">
        <div class="card mb-0">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" class="form-control" value="{{ old('name') ?: $discount->name }}"
                           placeholder="{{ __('Name') }}..." name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="code">{{ __('Code') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('code') ?: $discount->code }}"
                               placeholder="{{ __('Code') }}" id="code" name="code">
                        <button class="btn btn-outline-primary" type="button" onclick="generate('code', 5)"><i class="fas fa-cog"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="percent">{{ __('Percent') }}</label>
                    <input type="number" class="form-control"
                           id="percent" name="percent" value="{{ old('percent') ?: $discount->percent }}">
                </div>
                @if(auth()->user()->level == 3)
                    <div class="form-group">
                        <label for="active">{{ __('Active') }}</label>
                        <select class="form-control" id="active" name="active">
                            <option value="0" @selected($discount->active == 0)>{{ __('Not Active') }}</option>
                            <option value="1" @selected($discount->active == 1)>{{ __('Active') }}</option>
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="expired_at">{{ __('Expired At') }}</label>
                    <x-admin.forms.inputs.datepicker name="expired_at" id="expired_at"
                                                     value="{{ old('expired_at') !== null ? old('expired_at') : $discount->expired_at }}"
                                                     placeholder="xx/xx/xxxx"
                                                     jsOption="$('.datepicker').datepicker('setStartDate', 'dateToday');"/>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <x-admin.forms.buttons.primary type="submit">{{ __('Save Changes') }}</x-admin.forms.buttons.primary>
    </div>
    <script>
        function generate(id, length) {
            const characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
            const charactersLength = characters.length;
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#' + id).val('YogiXuan_' + result);
        }
    </script>
</div>
