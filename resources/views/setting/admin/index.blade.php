<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">{{ __('General Settings') }}</h3>
                    </div>
                </div>
            </div>
            @include('setting.partials.setting-header')
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.settings.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content pt-0">
                                <div id="general" class="tab-pane active">
                                    <div class="card mb-0">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ __('General Settings') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="site_name">{{ __('Website Name') }}</label>
                                                <input type="text" class="form-control" value="{{ option('site_name') }}"
                                                       placeholder="Yoga" name="site_name" id="site_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_description">{{ __('Description') }}</label>
                                                <input type="text" class="form-control" placeholder="{{ __('Yoga...') }}"
                                                       id="site_description" name="site_description" value="{{ option('site_description') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_phone">{{ __('Mobile Number') }}</label>
                                                <input type="text" class="form-control" placeholder="032xxxxxxxx"
                                                       id="site_phone" name="site_phone" value="{{ option('site_phone') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_email">{{ __('Email') }}</label>
                                                <input type="email" class="form-control" placeholder="abc@example.com"
                                                       id="site_email" name="site_email" value="{{ option('site_email') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_address">{{ __('Address') }}</label>
                                                <input type="text" class="form-control" placeholder="HCM"
                                                       name="site_address" id="site_address" value="{{ option('site_address') }}">
                                            </div>
                                            <div class="form-group d-flex justify-content-around">
                                                <div>
                                                    <label>Website Logo</label>
                                                    <x-admin.forms.inputs.image name="site_logo" value="{{ Storage::url(option('site_logo')) }}"
                                                                                class="text-center"/>
                                                </div>
                                                <div>
                                                    <label>Website Favicon</label>
                                                    <x-admin.forms.inputs.image name="site_favicon"
                                                                                value="{{ Storage::url(option('site_favicon')) }}"
                                                                                class="text-center"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layouts.app>
