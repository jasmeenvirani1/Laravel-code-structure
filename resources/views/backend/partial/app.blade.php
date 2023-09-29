<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @if (isset($site_title))
            {{ $site_title . ' ' . GetSetting('title-connector') . ' ' . GetSetting('site-title') }}
        @endif
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Codedthemes" />

    {{-- Jquery Js --}}
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

    @yield('page-css')

    {{-- Refresh Token --}}
    <script type="text/javascript">
        var csrfToken = $('[name="csrf_token"]').attr('content');
        setInterval(refreshToken, 3600000); // 1 hour 
        function refreshToken() {
            $.get('refresh-csrf').done(function(data) {
                csrfToken = data; // the new token
            });
        }
        setInterval(refreshToken, 3600000); // 1 hour 
    </script>

    {{-- Data Tabel Css --}}
    <link rel="stylesheet" href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}">

    {{-- <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63be8c77c2f1ac1e202cd969/1gmg59dmd';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script--> --}}

    <link href="{{ asset('backend/css/jquerysctipttop.css') }}" rel="stylesheet" type="text/css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    {{-- Toster --}}
    <link rel="stylesheet" href="{{ asset('backend/css/toster/NToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/toster/NToast.css') }}">
</head>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<body class="">

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- Main content -->
    <div class="content-wrapper">
        @yield('content')
        @include('backend.partial.footer')
    </div>
   
    <!-- Main content End-->


    {{-- SweetAlert Model Start --}}
    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn  btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- SweetAlert Model End --}}


    <!-- Required Js -->
    <script src=" {{ asset('backend/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/pcoded.min.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('backend/js/plugins/apexcharts.min.js') }}"></script>

    <!-- custom-chart js -->
    <script src="{{ asset('backend/js/pages/dashboard-main.js') }}"></script>

    {{-- Data Tabel-js --}}
    <script src=" {{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>

    {{-- Sweet Alert-js --}}
    <script src="{{ asset('backend/js/sweetalert.js') }}"></script>

    {{-- Ck Editor Js --}}
    <script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>

    <script>
        // Uppercase convert 
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function manageErrors(errors, containerId, param) {

            // setting all input variables empty
            $(`[${param}-data-input-error]`).html("");
            var validation = JSON.parse(errors);

            // fill up input variables with error
            $.each(validation.errors, function(key, value) {
                $(`[${param}-data-input-error="${key}"]`).html(value);
            })
        }

        function clearErrors() {
            $('.input-error').html("");

        }

        function resetForm(formId, param) {
            // reset form
            $(`${formId}`).trigger('reset');
            // reset all custom input
            $(`${formId} .custom-file-label`).html('Choose file');
            // reset all error message
            $(`[${param}-data-input-error]`).text('');
        }
    </script>

    @yield('page-script')

    {{-- Toster Js --}}
    <script src="{{ asset('backend/js/toster/NToast.js') }}"></script>
    <script src="{{ asset('backend/js/toster/NToast.min.js') }}"></script>
    <script>
        function triggerNotification(msg) {
            NToast(
                "#ff7f53",
                "BL",
                msg,
                true,
                "fa fa-check",
                true,
                100,
            )
        }
    </script>


    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyALxsV6NZjFHMndrS7e0jmJv7FCeITeoMs",
            authDomain: "flit-3ffce.firebaseapp.com",
            projectId: "flit-3ffce",
            storageBucket: "flit-3ffce.appspot.com",
            messagingSenderId: "666171976047",
            appId: "1:666171976047:web:16ffea11ab8532d40ba09a",
            measurementId: "G-688M3P67P5"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();


        function startFCM() {
            messaging.requestPermission().then(function() {
                    return messaging.getToken()
                })
                .then(function(response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('store.token') }}',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(error) {
                            console.log(error);
                        },
                    });
                }).catch(function(error) {
                    console.log(error);
                });
        }
        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>

</body>

</html>
