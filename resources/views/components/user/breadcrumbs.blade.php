@unless ($breadcrumbs->isEmpty())
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('images/bg/breadcumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Our Plan</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @foreach ($breadcrumbs as $breadcrumb)
                                    @if (!is_null($breadcrumb->url) && !$loop->last)
                                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                                    @else
                                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
@endunless
