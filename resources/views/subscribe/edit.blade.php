<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title pt-2">{{ __('Subscription Edit') }}</h3>
                    <div>
                        <form action="{{ route('admin.subscribe.destroy', $subscription) }}" method="POST">
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
                        <form action="{{ route('admin.subscribe.update', $subscription)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="tab-content pt-0">
                                <div id="general" class="tab-pane active">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title">{{ __('Course') }}</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $subscription->course()->first()->title }}"
                                                       placeholder="{{ __('Title') }}..." readonly id="title">
                                            </div>
                                            <h3>{{ __('Lesson') }}</h3>
                                            @forelse($lessons as $lesson)
                                                <div class="form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <label>{{ __('Lesson') }}</label>
                                                        <a href="https://studio.youtube.com/video/{{ $lesson->idVideo }}/edit"
                                                           style="cursor:pointer" target="_blank"><i class="fab fa-youtube"></i><span>{{ __('Open') }}</span></a>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{ $lesson->title }}"
                                                           readonly>
                                                </div>
                                            @empty
                                                <h4>{{ __('Empty') }}</h4>
                                            @endforelse
                                            <hr>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label for="email">{{ __('Email') }}</label>
                                                    <a href="#" style="cursor:pointer" id="copy_email"><i class="far fa-clipboard"></i><span>{{ __('Copy') }}</span></a>
                                                </div>
                                                <input type="text" class="form-control" value="{{ $subscription->user()->first()->email }}" readonly id="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">{{ __('Status') }}</label>
                                                <select class="form-control" id="type" name="status" required>
                                                    <option
                                                        value="0" @selected($subscription->status == 0) >{{ __('Not Added') }}</option>
                                                    <option
                                                        value="1" @selected($subscription->status == 1) >{{ __('Added') }}</option>
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
        <script>
            $(document).ready(function () {
                let value = $('#email').val();
                $('#copy_email').click(() => {
                    navigator.clipboard.writeText(value).then(function () {
                        // Sao chép thành công
                        alert('Đã sao chép vào clipboard');
                    }).catch(function (error) {
                        // Xảy ra lỗi
                        alert('Lỗi khi sao chép:' + error);
                    });
                })
            });
        </script>
    @endpush
</x-admin.layouts.app>
