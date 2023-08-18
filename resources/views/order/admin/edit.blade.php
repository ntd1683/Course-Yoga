<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title pt-2">{{ __('Order Edit') }}</h3>
                    <div>
                        <form action="{{ route('admin.order.destroy', $order) }}" method="POST">
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
                        <form action="{{ route('admin.order.update', $order)}}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="tab-content pt-0">
                                <div id="general" class="tab-pane active">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="user">{{ __('User') }}</label>
                                                <input type="text" class="form-control" value="{{ $order->user->name }}" readonly id="user">
                                            </div>
                                            <div class="form-group">
                                                <label for="course">{{ __('Course') }}</label>
                                                <input type="text" class="form-control" value="{{ $order->course->title }}" readonly id="course">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">{{ __('Type') }}</label>
                                                <input type="text" class="form-control" value="{{ \App\Enums\TypeOrderEnum::getKeyByValue($order->type) }}" readonly id="type">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">{{ __('Status') }}</label>
                                                <input type="text" class="form-control" value="{{ \App\Enums\OrderStatusEnum::getKeyByValue($order->status) }}" readonly id="status">
                                            </div>
                                            <div class="form-group">
                                                <label for="total">{{ __('Total') }}</label>
                                                <input type="text" class="form-control" value="{{ price_format($order->total) }}" readonly id="total">
                                            </div>
                                            <div class="form-group">
                                                <label for="code">{{ __('Bill Code') }}</label>
                                                <input type="text" class="form-control" value="{{ $order->code }}" readonly id="code">
                                            </div>
                                            <div class="form-group">
                                                <label for="referral_code">{{ __('Referral Code') }}</label>
                                                <input type="text" class="form-control" value="{{ $order->referral_code }}" readonly id="referral_code">
                                            </div>
                                            <div class="form-group">
                                                <label for="discount">{{ __('Discount') }}</label>
                                                <input type="text" class="form-control" value="{{ $order->discount }}" readonly id="discount">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">{{ __('Name') }}</label>
                                                <input type="text" class="form-control" value="{{ $order->name }}" id="name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label for="phone">{{ __('Phone') }}</label>
                                                    <a href="#" style="cursor:pointer" id="copy_phone"><i class="far fa-clipboard"></i><span>{{ __('Copy') }}</span></a>
                                                </div>
                                                <input type="text" class="form-control" value="{{ $order->phone }}" id="phone" name="phone">
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label for="email">{{ __('Email') }}</label>
                                                    <a href="#" style="cursor:pointer" id="copy_email"><i class="far fa-clipboard"></i><span>{{ __('Copy') }}</span></a>
                                                </div>
                                                <input type="text" class="form-control" value="{{ $order->email }}" id="email" name="email">
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
                let valuePhone = $('#phone').val();
                $('#copy_phone').click(() => {
                    navigator.clipboard.writeText(valuePhone).then(function () {
                        // Sao chép thành công
                        alert('Đã sao chép vào clipboard');
                    }).catch(function (error) {
                        // Xảy ra lỗi
                        alert('Lỗi khi sao chép:' + error);
                    });
                })
                let valueEmail = $('#email').val();
                $('#copy_email').click(() => {
                    navigator.clipboard.writeText(valueEmail).then(function () {
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
