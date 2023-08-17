<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">{{ __('Welcome') }} {{ \App\Enums\UserLevelEnum::getKeyByValue(auth()->user()->level) }}!</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-primary">
<i class="far fa-user"></i>
</span>
                                <div class="dash-widget-info">
                                    <h3>429</h3>
                                    <h6 class="text-muted">Users</h6>
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
<i class="fas fa-user-shield"></i>
</span>
                                <div class="dash-widget-info">
                                    <h3>148</h3>
                                    <h6 class="text-muted">Providers</h6>
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
<i class="fas fa-qrcode"></i>
</span>
                                <div class="dash-widget-info">
                                    <h3>124</h3>
                                    <h6 class="text-muted">Services</h6>
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
                                    <h3>$11378</h3>
                                    <h6 class="text-muted">Subscription</h6>
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
                            <h4 class="card-title">Recent Bookings</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center">
                                    <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Service</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap">
                                            <img class="avatar-xs rounded-circle" src="https://ui-avatars.com/api/?background=random&name=Yoga"
                                                 alt="User Image"> Annette Silva
                                        </td>
                                        <td class="text-nowrap">9 Sep 2020</td>
                                        <td>Car Repair Services</td>
                                        <td>
                                            <span class="badge bg-danger inv-badge">Pending</span>
                                        </td>
                                        <td>
                                            <div class="font-weight-600">$50</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <img class="avatar-xs rounded-circle" src="https://ui-avatars.com/api/?background=random&name=Yoga"
                                                 alt="User Image"> Stephen Wilson
                                        </td>
                                        <td class="text-nowrap">8 Sep 2020</td>
                                        <td>Steam Car Wash</td>
                                        <td>
                                            <span class="badge bg-danger inv-badge">Pending</span>
                                        </td>
                                        <td>
                                            <div class="font-weight-600">$14</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <img class="avatar-xs rounded-circle" src="https://ui-avatars.com/api/?background=random&name=Yoga"
                                                 alt="User Image"> Ryan Rodriguez
                                        </td>
                                        <td class="text-nowrap">7 Sep 2020</td>
                                        <td>House Cleaning Services</td>
                                        <td>
                                            <span class="badge bg-danger inv-badge">Pending</span>
                                        </td>
                                        <td>
                                            <div class="font-weight-600">$100</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <img class="avatar-xs rounded-circle" src="https://ui-avatars.com/api/?background=random&name=Yoga"
                                                 alt="User Image"> Lucile Devera
                                        </td>
                                        <td class="text-nowrap">6 Sep 2020</td>
                                        <td>Interior Designing</td>
                                        <td>
                                            <span class="badge bg-danger inv-badge">Pending</span>
                                        </td>
                                        <td>
                                            <div class="font-weight-600">$5</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <img class="avatar-xs rounded-circle" src="https://ui-avatars.com/api/?background=random&name=Yoga"
                                                 alt="User Image"> Roland Storey
                                        </td>
                                        <td class="text-nowrap">5 Sep 2020</td>
                                        <td>Plumbing Services</td>
                                        <td>
                                            <span class="badge bg-danger inv-badge">Pending</span>
                                        </td>
                                        <td>
                                            <div class="font-weight-600">$150</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 d-flex">

                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Payments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Provider</th>
                                        <th>Service</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>15 Sep 2020</td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Nancy Olson</a>
</span>
                                        </td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Matthew Garcia</a>
</span>
                                        </td>
                                        <td>Car Repair Services</td>
                                        <td>$50</td>
                                        <td>
                                            <span class="badge badge-dark">Pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14 Sep 2020</td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Ramona Kingsley</a>
</span>
                                        </td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Yolanda Potter</a>
</span>
                                        </td>
                                        <td>Electric Panel Repairing Service</td>
                                        <td>$45</td>
                                        <td>
                                            <span class="badge badge-dark">Pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13 Sep 2020</td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Ricardo Lung</a>
</span>
                                        </td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Ricardo Flemings</a>
</span>
                                        </td>
                                        <td>Steam Car Wash</td>
                                        <td>$14</td>
                                        <td>
                                            <span class="badge badge-dark">Pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12 Sep 2020</td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Annette Silva</a>
</span>
                                        </td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Maritza Wasson</a>
</span>
                                        </td>
                                        <td>House Cleaning Services</td>
                                        <td>$100</td>
                                        <td>
                                            <span class="badge badge-dark">Pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11 Sep 2020</td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Stephen Wilson</a>
</span>
                                        </td>
                                        <td>
<span class="table-avatar">
<a href="#" class="avatar avatar-xs mr-2">
<img class="avatar-img rounded-circle" alt="" src="https://ui-avatars.com/api/?background=random&name=Yoga">
</a>
<a href="javascript:void(0);">Marya Ruiz</a>
</span>
                                        </td>
                                        <td>Computer & Server AMC Service</td>
                                        <td>$80</td>
                                        <td>
                                            <span class="badge badge-info">Inprogress</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin.layouts.app>
