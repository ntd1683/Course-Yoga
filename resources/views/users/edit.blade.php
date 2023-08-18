<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h3 class="page-title">{{ __('Edit User') }}</h3>
                        <div>
                            <form action="{{ route('admin.user.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-admin.forms.buttons.danger
                                    type="submit">{{ __('Delete') }}</x-admin.forms.buttons.danger>
                                <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.user.update', $user)}}" method="post">
                            @method('PUT')
                            @include('users.partials.form', $user)
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layouts.app>
