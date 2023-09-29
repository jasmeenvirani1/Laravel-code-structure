@extends('backend.partial.app')

@section('content')
    @include('backend.partial.header')
    @include('backend.partial.sidebar')

    @if (Session::get('UserSession')['role_id'] == '1')
        @php
            $frist_label = 'Provider';
            $second_label = 'Seeker';
        @endphp
        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <!-- <div class="page-header </div> -->
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row mt-0">

                                                                                                                <!-- order-card start -->

                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-blue order-card">
                        <div class="card-body">
                            <h6 class="text-white">Total Users</h6>
                            <h2 class="text-right text-white"><i
                                    class="feather icon-users float-left"></i><span>{{ $total_user }}</span>
                            </h2>
                            <p class="m-b-0">Active Users<span class="float-right">{{ $active_user }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-body">
                            <h6 class="text-white">Providers</h6>
                            <h2 class="text-right text-white"><i
                                    class="feather icon-user-check float-left"></i><span>{{ $total_provider }}</span>
                            </h2>
                            <p class="m-b-0">Subscribed<span class="float-right">{{ $total_subscribed_provider }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-body">
                            <h6 class="text-white">Seekers</h6>
                            <h2 class="text-right text-white"><i
                                    class="feather icon-tag float-left"></i><span>{{ $total_seekers }}</span>
                            </h2>
                            <p class="m-b-0">This Month<span class="float-right">{{ $total_subscribed_seekers }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-red order-card">
                        <div class="card-body">
                            <h6 class="text-white">Total Payment</h6>
                            <h2 class="text-right text-white"><i
                                    class="feather icon-repeat float-left"></i><span>₹{{ $total_payment }}</span>
                            </h2>
                            <p class="m-b-0">This Month<span class="float-right">₹{{ $total_month_payment }}</span></p>
                        </div>
                    </div>
                </div>
                <!-- order-card end -->

                <!-- users visite start -->
                <div class="col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Latest Register Users </h5>
                        </div>
                        <div class="card-body pl-0 pb-0">
                            <div id="unique-visitor-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body bg-patern">
                                    <div class="row">
                                        <div class="col-auto">
                                            <span>Seekers</span>
                                        </div>
                                        <div class="col text-right">
                                            <h2 class="mb-0">{{ $total_seekers }}</h2>
                                            <span
                                                class="text-c-green">{{ round(($total_subscribed_seekers * 100) / MakeDiveable($total_seekers, 2)) }}%<i
                                                    class="feather icon-trending-up ml-1"></i></span>
                                        </div>
                                    </div>
                                    <div id="customer-chart"></div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <h3 class="m-0"><i
                                                    class="fas fa-circle f-10 m-r-5 text-success"></i>{{ $total_seekers }}
                                            </h3>
                                            <span class="ml-3">Total</span>
                                        </div>
                                        <div class="col">
                                            <h3 class="m-0"><i
                                                    class="fas fa-circle text-primary f-10 m-r-5"></i>{{ $total_subscribed_seekers }}
                                            </h3>
                                            <span class="ml-3">Subscribed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body bg-patern-white">
                                    <div class="row">
                                        <div class="col-auto">
                                            <span>Provider</span>
                                        </div>
                                        <div class="col text-right">
                                            <h2 class="mb-0 text-white">{{ $total_provider }}</h2>
                                            <span
                                                class="text-white">{{ round(($total_subscribed_provider * 100) / MakeDiveable($total_provider, 2)) }}%<i
                                                    class="feather icon-trending-up ml-1"></i></span>
                                        </div>
                                    </div>
                                    <div id="customer-chart1"></div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <h3 class="m-0 text-white"><i
                                                    class="fas fa-circle f-10 m-r-5 text-success"></i>{{ $total_provider }}
                                            </h3>
                                            <span class="ml-3">Total</span>
                                        </div>
                                        <div class="col">
                                            <h3 class="m-0 text-white"><i
                                                    class="fas fa-circle f-10 m-r-5 text-white"></i>{{ $total_subscribed_provider }}
                                            </h3>
                                            <span class="ml-3">Subscribed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users visite end -->


                <!-- social statustic start -->
                {{-- <div class="col-md-6 col-lg-4">
                <div class="card seo-card overflow-hidden">
                    <div class="card-body seo-statustic">
                        <i class="feather icon-save f-20 text-c-red"></i>
                        <h5 class="mb-1">65%</h5>
                        <p>Memory</p>
                    </div>
                    <div class="seo-chart">
                        <div id="seo-card1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-envelope-open text-c-blue d-block f-40"></i>
                        <h4 class="m-t-20"><span class="text-c-blue">8.62k</span> Subscribers</h4>
                        <p class="m-b-20">Your main list is growing</p>
                        <button class="btn btn-primary btn-sm btn-round">Manage List</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fab fa-twitter text-c-green d-block f-40"></i>
                        <h4 class="m-t-20"><span class="text-c-blgreenue">+40</span> Followers</h4>
                        <p class="m-b-20">Your main list is growing</p>
                        <button class="btn btn-success btn-sm btn-round">Check them out</button>
                    </div>
                </div>
            </div> --}}
                <!-- social statustic end -->
                <!-- account-section start -->

                <!-- account-section end -->
                <!-- Customer overview start -->
                <div class="col-lg-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Latest Providers</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="table-responsive">
                                        <div class="customer-scroll" style="height:420px;position:relative;">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th><span>Register date</span></th>
                                                        <th><span>Name <a class="help" data-toggle="popover"></a></span>
                                                        </th>
                                                        <th><span>Email <a class="help"></a></span></th>
                                                        <th><span>Plan Type <a class="help"></a></span></th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($latest_provider as $list)
                                                        <tr>
                                                            <td>{{ $list->created_at->format('d-M-Y') }}</td>
                                                            <td>{{ $list->name }}
                                                                <div class="progress mt-1" style="height:4px;">
                                                                    <div class="progress-bar bg-danger rounded"
                                                                        role="progressbar" style="width: 60%;"
                                                                        aria-valuenow="60" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $list->email }}
                                                                <div class="progress mt-1" style="height:4px;">
                                                                    <div class="progress-bar bg-warning  rounded"
                                                                        role="progressbar" style="width: 50%;"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                @if (strlen($list->type) > 0)
                                                                    {{ ucwords($list->type) }}
                                                                @else
                                                                    {{ 'Free' }}
                                                                @endif
                                                                <div class="progress mt-1" style="height:4px;">
                                                                    <div class="progress-bar bg-success  rounded"
                                                                        role="progressbar" style="width: 50%;"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Latest Seeker</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="table-responsive">
                                        <div class="customer-scroll" style="height:420px;position:relative;">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th><span>REGISTER DATE<a class="help"
                                                                    data-toggle="popover"></a></span>
                                                        </th>
                                                        <th><span>Name <a class="help"></a></span></th>
                                                        <th><span>Email <a class="help"></a></span></th>
                                                        <th><span>Status</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($latest_seeker as $list)
                                                        <tr>
                                                            <td>{{ $list->created_at->format('d-M-Y') }}</td>
                                                            <td>{{ $list->name }}
                                                                <div class="progress mt-1" style="height:4px;">
                                                                    <div class="progress-bar bg-danger rounded"
                                                                        role="progressbar" style="width: 60%;"
                                                                        aria-valuenow="60" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $list->email }}
                                                                <div class="progress mt-1" style="height:4px;">
                                                                    <div class="progress-bar bg-warning  rounded"
                                                                        role="progressbar" style="width: 50%;"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if (strlen($list->type) > 0)
                                                                    {{ ucwords($list->type) }}
                                                                @else
                                                                    {{ 'Free' }}
                                                                @endif
                                                                <div class="progress mt-1" style="height:4px;">
                                                                    <div class="progress-bar bg-success  rounded"
                                                                        role="progressbar" style="width: 50%;"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Customer overview end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
        </div>
        <!-- [ Main Content ] end -->
    @elseif(Session::get('UserSession')['role_id'] == '2')
        <div class="pcoded-main-container">

            <div class="pcoded-content">
                <h3>Matches </h3>
                {{-- <p>These Fitness Seekers added you th their Favourite List Click the CHAT icon to start connecting.</p> --}}
                <div class="row mt-0 col-md-12">

                    <div class="card-body border rounded mt-2">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
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

                                                <li><a class="nav-link text-left" id="v-pills-clear-all"
                                                        data-toggle="pill" href="#v-pills-notification" role="tab"
                                                        aria-controls="v-pills-notification"
                                                        aria-selected="false">Clear</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade active show" id="v-pills-user-recent"
                                                    role="tabpanel" aria-labelledby="v-pills-user-setting-tab">
                                                    @if (count($recent) <= 0)
                                                        <center style="margin: 3.5rem;">
                                                            <h6 class="text-muted">No Suggested available</h6>
                                                            <center>
                                                    @endif
                                                    @php
                                                        $plan_status = GetProviderPlanStatus(Session::get('UserSession')['id']);
                                                    @endphp
                                                    @foreach ($recent as $seeker)
                                                        <a
                                                            @if ($plan_status == 1) href="{{ route('front.get-profile', ['id' => $seeker->id]) }}" @else href = "Javascript:void(0);" onclick="ShowPlanListModel()" @endif>
                                                            <img src="{{ asset($seeker->profile_image) }}"
                                                                class="provider-favourit-image">
                                                        </a>
                                                    @endforeach
                                                </div>

                                                <div class="tab-pane fade" id="v-pills-all" role="tabpanel"
                                                    aria-labelledby="v-pills-user-setting-tab">
                                                    @if (count($all_match) <= 0)
                                                        <center style="margin: 3.5rem;">
                                                            <h6 class="text-muted">No Suggested available</h6>
                                                            <center>
                                                    @endif
                                                    @foreach ($all_match as $seeker)
                                                        <img src="{{ asset($seeker->profile_image) }}"
                                                            class="provider-favourit-image">
                                                    @endforeach
                                                </div>

                                                <div class="tab-pane fade" id="v-pills-notification" role="tabpanel"
                                                    aria-labelledby="v-pills-notification-tab">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="subscriptionModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Purchace subscription plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Purchace any subscription plan after you are show this profile :(</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{route('front.bill')}}" class="btn  btn-primary" style="color: #ffff">Go to subscription plan</a>

                    </div>
                </div>
            </div>
        </div>
    @elseif(Session::get('UserSession')['role_id'] == '3')
    @endif
@endsection

@section('page-script')
    @if (Session::get('UserSession')['role_id'] == '1')
        <script>
            $(document).ready(function() {
                var details = {
                    'total_label': 'Total',
                    'num_of_total': '{{ $total_seekers }}',
                    'color_of_total': '#2ed8b6',

                    'second_label': 'Subscribed',
                    'num_of_second': "{{ $total_subscribed_seekers }}",
                    'color_of_second': '#fab34b',

                    'id': '#customer-chart',
                };
                getDonutChart(details);

                var details = {
                    'total_label': 'Total',
                    'num_of_total': '{{ $total_provider }}',
                    'color_of_total': '#2ed8b6',

                    'second_label': 'Subscribed',
                    'num_of_second': "{{ $total_subscribed_provider }}",
                    'color_of_second': '#fab34b',

                    'id': '#customer-chart1',
                };
                getDonutChart(details);

                var provider_arr = "{{ $provider_graph_data }}";
                var seeker_arr = "{{ $seeker_graph_data }}";
                var row_date = [];
                for (var i = 1; i < 6; i++) {
                    var d = new Date();
                    var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + (d.getDate() - i + 1);
                    row_date.push(strDate);
                }

                var final_dates = row_date.reverse()

                var details = {
                    'dates': final_dates,

                    'frist_label': '{{ $frist_label }}',
                    'num_of_frist': '{{ $total_provider }}',
                    'color_of_frist': '#73b4ff', //Blue
                    'frist_graph_count': JSON.parse(provider_arr),

                    'second_label': '{{ $second_label }}',
                    'num_of_second': "{{ $total_seekers }}",
                    'color_of_second': '#59e0c5', //Green
                    'second_graph_count': JSON.parse(seeker_arr),

                    'y_axis': "{{ $y_axis }}",
                    'id': '#unique-visitor-chart',
                };
                getLineChart(details);
            });

            function getDonutChart(details) {
                var options1 = {
                    chart: {
                        height: 150,
                        type: 'donut',
                    },
                    dataLabels: {
                        enabled: false
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '75%'
                            }
                        }
                    },
                    labels: [details.second_label, details.total_label],
                    series: [parseInt(details.num_of_second), parseInt(details.num_of_total)],
                    legend: {
                        show: false
                    },
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        padding: {
                            top: 20,
                            right: 0,
                            bottom: 0,
                            left: 0
                        },
                    },
                    colors: [details.color_of_second, details.color_of_total],
                    fill: {
                        opacity: [1, 1],
                    },
                    stroke: {
                        width: 0,
                    }
                }
                var chart = new ApexCharts(document.querySelector(details.id), options1);
                chart.render();
            }

            function getLineChart(details) {
                // console.log(details);
                var options = {
                    chart: {
                        height: 230,
                        type: 'line',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 3,
                        curve: 'smooth'
                    },
                    series: [{
                        name: details.frist_label,
                        data: details.frist_graph_count,
                    }, {
                        name: details.second_label,
                        data: details.second_graph_count,
                    }],
                    legend: {
                        position: 'top',
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: details.dates,
                        axisBorder: {
                            show: false,
                        },
                        label: {
                            style: {
                                color: '#ccc'
                            }
                        },
                    },
                    yaxis: {
                        show: true,
                        min: 0,
                        max: parseInt(details.y_axis),
                        labels: {
                            style: {
                                color: '#ccc'
                            }
                        }
                    },
                    colors: [details.color_of_frist, details.color_of_second],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            gradientToColors: ['#4099ff', '#2ed8b6'],
                            shadeIntensity: 0.5,
                            type: 'horizontal',
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        },
                    },
                    markers: {
                        size: 5,
                        colors: ['#4099ff', '#2ed8b6'],
                        opacity: 0.9,
                        strokeWidth: 2,
                        hover: {
                            size: 7,
                        }
                    },
                    grid: {
                        borderColor: '#cccccc3b',
                    }
                }
                var chart = new ApexCharts(document.querySelector("#unique-visitor-chart"), options);
                chart.render();
            }
        </script>
    @endif
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
                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });
                    // $.ajax({
                    //     type: "POST",
                    //     url: "{{ route('admin.clear.all-favourite') }}",
                    //     dataType: "json",
                    //     processData: false,
                    //     contentType: false,
                    //     success: function(response) {
                    //         if (response.status == 200) {
                    //             triggerNotification('All clear succesfully');
                    //             location.reload();
                    //         } else {
                    //             triggerNotification('Something went wrong');
                    //             triggerNotification('sssSubscription', 'Something went wrong');
                    //         }
                    //     },
                    //     error: function(request, status, error) {
                    //         triggerNotification('Something went wrong');
                    //     }
                    // });
                    location.reload();
                }
            })
        });
    </script>
    <script>
        function ShowPlanListModel() {

            $("#subscriptionModal").modal('toggle')
        }
    </script>
    @if (Session::get('UserSession')['role_id'] == '2')
        <script>
            $(document).ready(function() {
                startFCM();
            });
        </script>
    @endif
@endsection
