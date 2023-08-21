<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title pt-2">{{ __('Trial Edit') }}</h3>
                    <div>
                        <form action="{{ route('admin.trial.destroy', $trial) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-admin.forms.buttons.danger
                                type="submit">{{ __('Delete') }}</x-admin.forms.buttons.danger>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.trial.update', $trial)}}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="tab-content pt-0">
                                <div id="general" class="tab-pane active">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                        <label for="phone">{{ __('Phone') }}</label>
                                                    <a href="#" style="cursor:pointer" id="copy_phone"><i class="far fa-clipboard"></i><span>{{ __('Copy') }}</span></a>
                                                </div>
                                                <input type="text" class="form-control" value="{{ $trial->phone }}" readonly id="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">{{ __('Type') }}</label>
                                                <select class="form-control" id="type" name="type">\
                                                    <option value="0" @selected($trial->type == 0) >{{ __('Disapprove') }}</option>
                                                    <option value="1" @selected($trial->type == 1) >{{ __('Approve') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <x-admin.forms.buttons.primary type="submit">{{ __('Save Changes') }}</x-admin.forms.buttons.primary>
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
            $(document).ready(function () {
                let value = $('#phone').val();
                $('#copy_phone').click(() => {
                    navigator.clipboard.writeText(value).then(function () {
                        alert('Copied to clipboard');
                    }).catch(function (error) {
                        alert('Error while copying:' + error);
                    });
                })
            });
        </script>
    @endpush
</x-admin.layouts.app>
