<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">{{ __('Create User') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.user.store')}}" method="post">
                            @include('users.partials.form', $user = new \App\Models\User())
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layouts.app>
