<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">{{ __('Welcome') }} {{ \App\Enums\UserLevelEnum::getKeyByValue(auth()->user()->level) }}
                            !</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3>{{ $statistical['count_users'] }}</h3>
                                    <h6 class="text-muted">{{ __('Users') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3>{{ $statistical['count_subscriber'] }}</h3>
                                    <h6 class="text-muted">{{ __('Subscribers') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="fas fa-swatchbook"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3>{{ $statistical['count_courses'] }}</h3>
                                    <h6 class="text-muted">{{ __('Courses') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-primary">
                                    <i class="far fa-credit-card"></i>
                                </span>
                                <div class="dash-widget-info">
                                    <h3>VNĐ {{ $statistical['payment'] }}</h3>
                                    <h6 class="text-muted">{{ __('Payment') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Top 5 Buyers') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Price') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tableUser as $user)
                                        <tr>
                                            <td class="text-nowrap">
                                                {{ $user->id }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                <div class="font-weight-600">{{ price_format($user->revenue) }} VNĐ</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Top 5 Most Purchased Courses') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Count') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tableCourse as $course)
                                        <tr>
                                            <td class="text-nowrap">{{ $course->id }}</td>
                                            <td class="text-nowrap">{{ $course->title }}</td>
                                            <td class="text-nowrap">{{ $course->count }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="form_get_revenue" data-ajax="{{ route('admin.ajax.chart-js.revenue') }}" class="d-none"></div>
            <div class="row justify-content-end">
                <div class="col-2">
                    <select class="form-control text-center" name="time" id="select-time" style="width: fit-content;">
                        <option>{{ __('Select Time') }}</option>
                        <option value="0">{{ __('Date') }}</option>
                        <option value="1">{{ __('Month') }}</option>
                        <option value="2">{{ __('Year') }}</option>
                    </select>
                </div>
            </div>
            <canvas id="chartRevenue" width="200" height="200"></canvas>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('js/admin/chart.js') }}"></script>
    @endpush
</x-admin.layouts.app>
