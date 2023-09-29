<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <title>
        @if (isset($site_title))
            {{ $site_title . ' ' . GetSetting('title-connector') . ' ' . GetSetting('site-title') }}
        @endif
    </title>
</head>

<body>
    @include('front.partial.header')
    @yield('content')
    @include('front.partial.footer')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('frontend/js/jquery-3.2.1.slim.min.js') }} "></script>
    <script src="{{ asset('frontend/js/popper.min.js') }} "></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('frontend/js/slick.js') }} "></script>
    <script src="{{ asset('frontend/js/custom.js') }} "></script>
    <script src="{{ asset('frontend/js/aos.js') }} "></script>
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>




    <!-- Optional JavaScript -->
    
    
    <script src="js/custom.js"></script>
    <!-- <script src="js/aos.js"></script> -->
    <script>
        // Animation js //
        AOS.init();
    </script>


    <script>
        // Animation js //
        AOS.init();
    </script>
    @yield('page-script')
    <script>
        function manageErrors(errors, containerId, param) {

            // setting all input variables empty
            $(`[${param}-data-input-error]`).html("");

            var validation = JSON.parse(errors);


            // fill up input variables with error
            $.each(validation.errors, function(key, value) {
                // console.log(`[${param}-data-input-error="${key}"]`);
                $(`[${param}-data-input-error="${key}"]`).html(value);
            })
        }

        function resetForm(formId, param) {
            // reset form
            $(`${formId}`).trigger('reset');
            // reset all custom input
            $(`${formId} .custom-file-label`).html('Choose file');
            // reset all error message
            $(`[${param}-data-input-error]`).text('');
        }

        // Toasters
        function triggerNotification(message, type) {
            toastr.clear();
            NioApp.Toast(message, type, {
                position: 'bottom-right'
            });
        }

        //Get Form Data
        function getFormData(data) {
            var formData = new FormData();
            $.each(data, function(i, field) {
                formData.append(field.name, field.value);
            });
            return formData;
        }

        const date = new Date();
        let year = date.getFullYear();
        var string = "FLIT " + year + " © ALL RIGHTS RESERVED"
        $("#RightsText").text(string)
    </script>

</body>

</html>
