@php
    $modual_name = 'favourite';
@endphp
@extends('backend.partial.app')

@section('content')
    @include('backend.partial.header')
    @include('backend.partial.sidebar')

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ Main Content ] start -->
            <div class="">
                @if (Session::get('UserSession')['role_id'] == '3')
                    <a href="{{ route('front.explore-fitness') }}"
                        class="btn btn-primary float-right text-end add-{{ $modual_name }}" style="color: white;"> <i
                            class='feather icon-plus-square'></i> EXPLORE ALL PROVIDERS </a>
                @endif
            </div>
            <h3>FAVOURITES</h3>
            <p>These Fitness Seekers added you th their Favourite List Click the CHAT icon to start connecting.</p>

            <div class="row mt-0 col-md-12">

                <div class="card-body border rounded mt-2">

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                @if (Session::get('UserSession')['role_id'] == '3')
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <li>
                                                    <a class="nav-link text-left active" id="v-pills-user-setting-tab"
                                                        data-toggle="pill" href="#v-pills-user-recent" role="tab"
                                                        aria-controls="v-pills-home" aria-selected="false">Recent</a>
                                                </li>

                                                <li><a class="nav-link text-left" id="v-pills-privacy-tab"
                                                        data-toggle="pill" href="#v-pills-all" role="tab"
                                                        aria-controls="v-pills-Privacy" aria-selected="true">All</a></li>

                                                <li><a class="nav-link text-left" id="v-pills-clear-all" data-toggle="pill"
                                                        href="#v-pills-notification" role="tab"
                                                        aria-controls="v-pills-notification" aria-selected="false">Clear</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-md-9 col-sm-12">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade active show" id="v-pills-user-recent"
                                                    role="tabpanel" aria-labelledby="v-pills-user-setting-tab">
                                                    @if (count($favourite_recent) <= 0)
                                                        <center style="margin: 3.5rem;">
                                                            <h6 class="text-muted">No favourite available</h6>
                                                            <center>
                                                    @endif
                                                    @foreach ($favourite_recent as $recent)
                                                        <img src="{{ asset($recent->profile_image) }}"
                                                            class="provider-favourit-image">
                                                    @endforeach
                                                </div>

                                                <div class="tab-pane fade " id="v-pills-all" role="tabpanel"
                                                    aria-labelledby="v-pills-privacy-tab">
                                                    @if (count($favourite_all) <= 0)
                                                        <center style="margin: 3.5rem;">
                                                            <h6 class="text-muted">No favourite available</h6>
                                                            <center>
                                                    @endif
                                                    @foreach ($favourite_all as $favourite_all)
                                                        <img src="{{ asset($favourite_all->profile_image) }}"
                                                            class="provider-favourit-image">
                                                    @endforeach
                                                </div>

                                                <div class="tab-pane fade" id="v-pills-notification" role="tabpanel"
                                                    aria-labelledby="v-pills-notification-tab">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <li>
                                                <a class="nav-link text-left active" id="v-pills-user-setting-tab"
                                                    data-toggle="pill" href="#v-pills-user-recent" role="tab"
                                                    aria-controls="v-pills-home" aria-selected="false">Recent</a>
                                            </li>

                                            <li><a class="nav-link text-left" id="v-pills-privacy-tab"
                                                    data-toggle="pill" href="#v-pills-all" role="tab"
                                                    aria-controls="v-pills-Privacy" aria-selected="true">All</a></li>

                                            <li><a class="nav-link text-left" id="v-pills-clear-all" data-toggle="pill"
                                                    href="#v-pills-notification" role="tab"
                                                    aria-controls="v-pills-notification" aria-selected="false">Clear</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade active show" id="v-pills-user-recent"
                                                role="tabpanel" aria-labelledby="v-pills-user-setting-tab">
                                                @if (count($favourite_recent) <= 0)
                                                    <center style="margin: 3.5rem;">
                                                        <h6 class="text-muted">No favourite available</h6>
                                                        <center>
                                                @endif
                                                @foreach ($favourite_recent as $recent)
                                                    <img src="{{ asset($recent->profile_image) }}"
                                                        class="provider-favourit-image">
                                                @endforeach
                                            </div>

                                            <div class="tab-pane fade " id="v-pills-all" role="tabpanel"
                                                aria-labelledby="v-pills-privacy-tab">
                                                @if (count($favourite_all) <= 0)
                                                    <center style="margin: 3.5rem;">
                                                        <h6 class="text-muted">No favourite available</h6>
                                                        <center>
                                                @endif
                                                @foreach ($favourite_all as $favourite_all)
                                                    <img src="{{ asset($favourite_all->profile_image) }}"
                                                        class="provider-favourit-image">
                                                @endforeach
                                            </div>

                                            <div class="tab-pane fade" id="v-pills-notification" role="tabpanel"
                                                aria-labelledby="v-pills-notification-tab">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

@section('page-script')
    <script>
        // Uppercase convert 
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        // Model open
        const modual_name = "{{ $modual_name }}";
        const ucword_modual_name = capitalizeFirstLetter(modual_name);

        function fetchFavouriteData() {
            $('#selection-datatable').DataTable({
                "pagingType": 'full_numbers',
                "Processing": true,
                "serverSide": true,
                "bDestroy": true,
                "responsive": true,
                "order": [
                    [0, "desc"]
                ],
                "ajax": "{{ route('admin.favourite.fetch') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                ]
            })
        }
        $(document).ready(function() {
            fetchFavouriteData();
        });
    </script>



    {{-- Delete Question Script --}}
    <script>
        $(document).on("click", ".delete-" + modual_name + "", function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this delete!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#172e60",
                cancelButtonColor: "#DD6B55",
                closeModal: false,
                confirmButtonText: 'Yes, delete it!',
                showClass: {
                    popup: 'slow-animation-show'
                },
                hideClass: {
                    popup: 'slow-animation-hide'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(this).data("id");
                    var formData = new FormData();
                    formData.append('id', id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.subscription.delete') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {

                                triggerNotification('Subscription',
                                    'The Subscription has been deleted.');

                                fetchFavouriteData();

                            } else {
                                triggerNotification('Subscription', 'Something went wrong');
                            }
                        },
                        error: function(request, status, error) {
                            triggerNotification('Subscription', 'Something went wrong');
                        }
                    });
                }
            })

        });
    </script>

    <script>
        $("#v-pills-clear-all").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this delete!",
                icon: 'warning',
                showCancelButton: true,
                closeModal: false,
                confirmButtonColor: "#172e60",
                cancelButtonColor: "#DD6B55",
                confirmButtonText: 'Yes, delete it!',
                showClass: {
                    popup: 'slow-animation-show'
                },
                hideClass: {
                    popup: 'slow-animation-hide'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.clear.all-favourite') }}",
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                triggerNotification('All provider has been deleted');
                                location.reload();
                            } else {
                                triggerNotification('Something went wrong');
                                triggerNotification('sssSubscription', 'Something went wrong');
                            }
                        },
                        error: function(request, status, error) {
                            triggerNotification('Something went wrong');
                        }
                    });
                }
            })
        });
    </script>

    {{-- Opction Add Script --}}
@endsection
