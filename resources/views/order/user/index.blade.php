<x-user.layouts.app>
    <!-- contact-area -->
    <section class="contact-area contact-bg" data-background="{{ asset('images/bg/contact_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">{{ __('Order') }}</h5>
                        </div>
                        <div class="contact-form">
                            <form action="{{ route('order.payment', $course) }}" method="post">
                                @csrf
                                <div>
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" placeholder="{{ __('Enter Your Name') }}" id="name" name="name"
                                           value="{{ old('name') ?: auth()->user()->name }}">
                                </div>
                                <div>
                                    <label for="phone">{{ __('Phone') }}</label>
                                    <input type="text" placeholder="{{ __('Enter Your Phone') }}" id="phone"
                                           name="phone"
                                           value="{{ old('phone') ?: auth()->user()->phone }}">
                                </div>
                                <div>
                                    <label for="email">{{ __('Email') }}</label>
                                    <input type="email" placeholder="{{ __('Enter Your Email') }}" id="email"
                                           name="email" readonly
                                           value="{{ old('email') ?: auth()->user()->email }}">
                                </div>
                                <div>
                                    <label for="referral_code">{{ __('Referral Code') }}</label>
                                    <input type="text" placeholder="{{ __('Enter Your Name') }}" id="referral_code"
                                           name="referral_code"
                                           value="{{ old('referral_code') }}">
                                </div>
                                <label for="discount">{{ __('Discount Code') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" placeholder="{{ __('Enter Your Discount Code') }}" id="discount"
                                           name="discount"
                                           value="{{ old('discount') }}" class="form-control order">
                                    <div class="input-group-append">
                                        <button class="btn order" type="button">{{ __('Apply') }}</button>
                                    </div>
                                </div>
                                <hr style="margin-top: 0; opacity:25%;" class="mb-3">
                                <h4 class="text-danger">{{ __('Payment Method') }}</h4>
                                <div class="radio-group d-flex justify-content-around my-4">
                                    <label for="bank" class="border p-3 rounded payment" data-select="false" id="select-bank">
                                        <input type="radio" name="type" value="1" id="bank" class="d-none">
                                        <img src="{{ asset('images/bank/bank.png') }}" width="auto" height="60" alt="bank">
                                    </label>
                                    <label for="vnpay" class="border p-3 rounded payment" data-select="false" id="select-vnpay">
                                        <input type="radio" name="type" value="1" id="vnpay" class="d-none">
                                        <img src="{{ asset('images/bank/vnpay.png') }}" width="auto" height="60" alt="vnpay">
                                    </label>
                                    <label for="momo" class="border p-3 rounded payment" data-select="false" id="select-momo">
                                        <input type="radio" name="type" value="2" id="momo" class="d-none">
                                        <img src="{{ asset('images/bank/momo.png') }}" width="auto" height="60" alt="momo">
                                    </label>
                                </div>
                                @push('js')
                                    <script>
                                        window.addEventListener('load', () => {
                                            let selectVnpay = $('#select-vnpay');
                                            let selectMomo = $('#select-momo');
                                            let selectBank = $('#select-bank');

                                            selectVnpay.click(() => {
                                                $('.payment').removeClass('selected');
                                                selectVnpay.addClass('selected');
                                            })

                                            selectMomo.click(() => {
                                                $('.payment').removeClass('selected');
                                                selectMomo.addClass('selected');
                                            })

                                            selectBank.click(() => {
                                                $('.payment').removeClass('selected');
                                                selectBank.addClass('selected');
                                            })
                                        })
                                    </script>
                                @endpush
                                <hr style="margin-top: 0; opacity:25%;" class="mb-3">
                                <div class="text-right">
                                    <h4 style="color:yellow;">{{ __('Total') }}</h4>
                                    <h5>{{ $course->price }}</h5>
                                    <button class="btn">{{ __('Buy') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="widget-title mb-50">
                        <h5 class="title">{{ __('Information') }}</h5>
                    </div>
                    <div class="contact-info-wrap">
                        <div class="contact-info-list">
                            <ul>
                                <li>
                                    <div class="icon"><i class="fas fa-heading"></i></div>
                                    <p><span>{{ __('Name') }} :</span> {{ $course->title }}</p>
                                </li>
                                <li>
                                    <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                                    <p><span>{{ __('Price') }} :</span> {{ price_format($course->price) }}</p>
                                </li>
                                <li>
                                    <div class="icon"><i class="fas fa-quote-left"></i></div>
                                    <p>
                                        <span>{{ __('Type') }} :</span> {{ \App\Enums\CourseTypeEnum::getKeyByValue($course->type)  }}
                                    </p>
                                </li>
                                <li>
                                    <div class="icon"><i class="fas fa-eye"></i></div>
                                    <p><span>{{ __('View') }} :</span> {{ $course->view }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->
</x-user.layouts.app>
