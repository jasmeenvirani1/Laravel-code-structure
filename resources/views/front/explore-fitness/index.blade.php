@extends('front.partial.app')
@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <div class="explore-bg">
        <div class="container">
            <div class="explore-padding">
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <h1 class="explore-heading">Explore Fitness</h1>
                        <p class="e-titile">Browse Our community directory of Personal<br>
                            Trainers, Fitness & Wellness Facilities, Group<br>
                            Classes, Workshops, Events and more.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="wrap">
        <div class="faq-main-part">
            <div class="container">
                <div class="row">

                    <!-- LEFT PART START -->
                    <div class="col-lg-3">
                        <div class="left-part">
                            <div class="top-bg-left">
                                <p class="top-bg-title">
                                    <strong>Login</strong> or <strong>create your free account</strong> to save <br>
                                    favourites and chat directly With registered<br>
                                    FLIT Fitness Providers.
                                </p>
                            </div>

                            <form action="{{ url('/') }}/explore-fitness" method="get">
                                <div class="search-part">
                                    <div class="input-group">
                                        <input class="form-control border-end-0 border"
                                            placeholder="Find your next workout..." name="keyword"
                                            id="example-search-input">
                                        <span class="input-group-append">
                                            <button
                                                class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border ms-n5"
                                                type="submit">
                                                <img src="{{ asset('frontend/img/sear-icon.png') }}">
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>

                            <div class="filter-part">
                                <h2 class="filter-part-heading">FILTER ({{ $num_of_filter }})</h4>
                                    <h4><a href="{{route('front.explore-fitness')}}" class="btn reset-filter-btn">Reset filter</a></h4>
                            </div>

                            <!-- ACCORIDIAN  PART START -->
                            <div class="accdian-part">
                                <div id="accordion" class="accordion">
                                    <div class="card mb-0">
                                        <div class="card-header @if (count($location_filter_arr) <= 0) collapsed @endif"
                                            data-toggle="collapse" href="#collapseOne">
                                            <a class="card-title">
                                                Location
                                            </a>
                                        </div>

                                        <div id="collapseOne"
                                            class="card-body collapse @if (count($location_filter_arr) > 0) show @endif"
                                            data-parent="#accordion">
                                            <form action="http://127.0.0.1:8000/explore-fitness" method="get">
                                                <div class="search-part" style="padding:0;">
                                                    <div class="input-group">
                                                        <input
                                                            class="form-control border-end-0 border ui-autocomplete-input"
                                                            placeholder="Find location..." name="location"
                                                            id="example-search-input-location" autocomplete="off" required>
                                                        <span class="input-group-append">
                                                            <button
                                                                class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border ms-n5"
                                                                type="submit">
                                                                <img src="http://127.0.0.1:8000/frontend/img/sear-icon.png">
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <form action="javascript:void(0);" id="filterForm">

                                            <div class="card-header collapsed" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseTwo">
                                                <a class="card-title">
                                                    Type of Access
                                                </a>
                                            </div>
                                            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                                                <p class="crd-detail">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                    life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                                                    cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                    eiusmod. Brunch 3 wolf moon tempor, sunt
                                                    aliqua put a bird on it squid single-origin coffee nulla assumenda
                                                    shoreditch et. samus labore sustainable VHS.</p>
                                            </div>

                                            <div class="card-header collapsed" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseThree">
                                                <a class="card-title">
                                                    Workout Categories
                                                </a>
                                            </div>


                                            <div id="collapseThree" class="collapse" data-parent="#accordion">

                                                <div class="row col-md-12">
                                                    @foreach ($workouts_list as $workouts)
                                                        @if (count($workouts['sub_workouts']) <= 0)
                                                            @continue
                                                        @endif
                                                        <div class="col-md-6">
                                                            <span
                                                                class="workout-categories-label">{{ $workouts['name'] }}</span>
                                                            {{-- <ol> --}}
                                                            @foreach ($workouts['sub_workouts'] as $sub_workouts)
                                                                <li style="list-style: none;"><input class="loactions"
                                                                        name="workout" value="{{ $sub_workouts['sub_id'] }}"
                                                                        type="checkbox"
                                                                        @if (in_array($sub_workouts['sub_id'], $workout_filter_arr)) checked @endif>&nbsp{{ $sub_workouts['name'] }}
                                                                </li>
                                                            @endforeach
                                                            {{-- </ol> --}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="card-header collapsed" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseFour">
                                                <a class="card-title">
                                                    Your Fitness Goals/Interests
                                                </a>
                                            </div>

                                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                                                <div class="card-body col-md-12">
                                                    <div class="row">

                                                        @foreach ($goal_list as $goal)
                                                            <div class="col-md-6">
                                                                <input type="checkbox" class="loactions" name="golas"
                                                                    value="{{ $goal->id }}" id="{{ $goal->id }}"
                                                                    style="width: 16px;height: 16px;"
                                                                    @if (in_array($goal->id, $goal_filter_arr)) checked @endif>
                                                                <label
                                                                    for="{{ $goal->id }}">{{ $goal->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-header collapsed" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseFive">
                                                <a class="card-title">
                                                    Demographics & Accessibility
                                                </a>
                                            </div>
                                            <div id="collapseFive" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p class="crd-detail">Anim pariatur cliche reprehenderit, enim eiusmod
                                                        high life accusamus terry richardson ad squid. 3 wolf moon officia
                                                        aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                                        nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                                        aliqua put a bird on it squid single-origin coffee nulla assumenda
                                                        shoreditch et. samus labore sustainable VHS.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="card-header collapsed" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseSix">
                                                <a class="card-title">
                                                    Price Range
                                                </a>
                                            </div>
                                            <div id="collapseSix" class="collapse" data-parent="#accordion">
                                                <div class="p-4">
                                                    <input type="range" name="price" step="20" min="100"
                                                        class="" max="{{ $top_price }}" value=""
                                                        onchange="rangePrimary.value=value">
                                                    <input type="text" id="rangePrimary" readonly
                                                        value="{{ $price }}" />
                                                    <button class="btn btn-primary"
                                                        onclick="ChangeFilterValue(1)">Filter</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- ACCORIDIAN  PART END -->
                        </div>
                    </div>

                    <!-- LEFT PART END -->


                    <!-- RIGHT PART START -->
                    <div class="col-lg-9">
                        <div class="row">
                            @if (count($provider_list) <= 0)
                                <div class="col-lg-3 col-6">
                                    <div class="gallery-part">
                                        <div class="overlay">
                                            Not Found
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @foreach ($provider_list as $list)
                                <div class="col-lg-3 col-6">
                                    <div class="gallery-part">
                                        <img class="img-fluid" src="{{ asset($list->profile_image) }}"
                                            style="height: 35vh; object-fit: contain;">
                                        <div class="overlay">
                                            <a href="javascript:void(0);"
                                                class="icon provider-like-button change_{{ $list->user_id }}"
                                                title="Heart" data-id="{{ $list->user_id }}"
                                                @if (in_array($list->user_id, $like_list)) data-deleteStatus="1" @else data-deleteStatus="0" @endif>
                                                <i class="fa fa-heart" data-changecssid="{{ $list->user_id }}"
                                                    @if (in_array($list->user_id, $like_list)) style="color:#ea6363"; @endif></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- RIGHT PART START -->
                </div>
            </div>


        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('frontend/js/jquery-ui.auto.complete.js') }}"></script>
    <script>
        $(".provider-like-button").click(function() {
            var providerId = $(this).attr("data-id");
            var deleteStatus = $(this).attr("data-deleteStatus");

            var formData = new FormData()
            formData.append('providerId', providerId);
            formData.append('deleteStatus', deleteStatus);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('front.add.favourite.provider') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    var changeStatus = 0;
                    var color = '#afafaf';
                    if (deleteStatus == 0) {
                        changeStatus = 1;
                        color = '#ea6363';
                    }
                    $(`[data-changecssid="` + providerId + `"]`).css("color", color);
                    $(`[data-id="` + providerId + `"]`).attr("data-deletestatus", changeStatus);
                },
            });
        });

        $(document).ready(function() {
            $(".loactions").change(function() {
                ChangeFilterValue();
            });
        });

        function ChangeFilterValue(priceClick = 0) {
            var url = "{{ url('/') }}";
            var past_url = window.location.href;
            var data = $("#filterForm").serializeArray()
            var string = "";
            $.each(data, function(key, val) {
                if (priceClick == 0 && val.name == "price") {
                    return 1;
                }
                string += val.name + '[]' + "=" + val.value + "&"
            });
            string = url + '/explore-fitness/?' + string;
            window.location.replace(string)
        }
    </script>
    <script>
        $(function() {
            var availableTags = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('get.keyword') }}",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $.each(response.data, function(i, field) {
                        availableTags.push(field.keyword)
                    });
                },
            });

            $("#example-search-input").autocomplete({
                source: availableTags
            });
        });
    </script>
    <script>
        $(function() {
            var availableLocation = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('get.provider-citys') }}",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $.each(response.data, function(i, field) {
                        availableLocation.push(field.location)
                    });
                },
            });

            $("#example-search-input-location").autocomplete({
                source: availableLocation
            });
        });
    </script>
    @php
        $request = app('request')->request->all();
    @endphp
    @if (count($request) > 0)
        <script>
            $(document).ready(function() {
                $(document).scrollTop(500);
            });
        </script>
    @endif
@endsection
