<x-user.layouts.app>
    {{ Breadcrumbs::render('course') }}
    <!-- movie-area -->
    <section class="movie-area movie-bg" data-background="{{ __('images/bg/movie_bg.jpg') }}">
        <div class="container">
            <form action="{{ route('ajax.course.getCourses') }}" onsubmit="return false;" id="form_get_courses">
                <div class="row align-items-end mb-60">
                    <div class="col-lg-4">
                        <div class="section-title text-center text-lg-left">
                            <span class="sub-title">{{ __('Course') }}</span>
                            @if(! request()->has('user')|| request()->has('user') == 0)
                                <h2 class="title">{{ __('ALL Course') }}</h2>
                            @else
                                <h2 class="title">{{ __('My Course') }}</h2>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="movie-page-meta row">
                            <div class="tr-movie-menu-active text-center">
                                <button type="button" class="active" data-filter="*">{{ __('ALL') }}</button>
                                <button type="button" class="" data-filter=".free">{{ __('Free') }}</button>
                                <button type="button" class="" data-filter=".premium">{{ __('Premium') }}</button>
                                <button type="button" class="" data-filter=".buy">{{ __('Most Bought') }}</button>
                            </div>
                            <div class="movie-filter-form">
                                <select name="filter" class="custom-select" id="search_filter">
                                    <option selected>{{ __('Filter') }}</option>
                                    <option value="0">{{ __('Created At (Newest)') }}</option>
                                    <option value="1">{{ __('Title (A-Z)') }}</option>
                                    <option value="2">{{ __('Title (Z-A)') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center justify-content-lg-end mt-3">
                        <div class="col-8 col-lg-6 position-relative">
                            <div class="input-group">
                                <input type="text" name="title" class="form-input" placeholder="Search title here..." id="search_query">
                                <i class="fas fa-search position-absolute"
                                   style="right: 3%;font-size: medium;top: 18%; opacity: 30%;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id="list_courses">
                @include('course.user.partials.list', $courses)
            </div>
        </div>
    </section>
    <!-- movie-area-end -->

    <!-- newsletter-area -->
    @include('components.user.layouts.partials.newsletter')
    <!-- newsletter-area-end -->
    @push('js')
        <script>
            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
                return 0;
            };

            let query;
            let sort;
            let perPage;
            let user = getUrlParameter("user");
            function filter(user = 0, query = null,sort = null,perPage = null) {
                $.ajax({
                    method: 'GET',
                    url: $('#form_get_courses').attr('action'),
                    data: {
                        "q": query,
                        "filter": sort,
                        "per_page": perPage,
                        "user": user,
                    },
                    success: function (data) {
                        $('#list_courses').html(data);
                    },
                });
            }

            $('#search_query').keyup(() => {
                query = $('#search_query').val();
                filter(user,query,sort);
            })

            $('#search_query').change(() => {
                query = $('#search_query').val();
                filter(user,query,sort)
            })

            $('#search_filter').change(() => {
                sort = $('#search_filter').val();
                filter(user,query,sort)
            })
        </script>
    @endpush
</x-user.layouts.app>
