@extends('front.partial.app')
@section('content')
    <div class="support-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="support-left">
                        <h1 class="support-heading">Feedback</h1>

                        {{-- <p class="s-titile">Please feel free to reach out directly through rhe website contact form.
                        <span>Our support team will do their best to respond within 24 hours</span>
                    </p> --}}

                        {{-- <h4 class="qs-heading">Question?</h4>
                    <p class="qs-title">Review <a href="{{route('front.get-pages',['slug' => 'faq'])}}">our FAQ
                            Section</a> to help assist you.</p> --}}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="support-form">
                        <form id="FeedbackFrom" action="javascript:void(0);" >
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name*</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname">
                                    <label for="inputEmail4">First Name*</label>
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="firstname"></strong></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">&nbsp;</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                    <label for="text">Last Name*</label>
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="lastname"></strong></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="text" class="form-control" id="email" name="email">
                                <span class="input-error" role="alert"> <strong
                                        add-data-input-error="email"></strong></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Feedback*</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="feedback"></textarea>
                                <span class="input-error" role="alert"> <strong
                                        add-data-input-error="feedback"></strong></span>
                            </div>

                            <button type="submit" class="btn custom-btn feedback-from-submit-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        $("#FeedbackFrom").submit(function(event) {
            $(".feedback-from-submit-btn").text('Submiting....');
            var data = $(this).serializeArray();

            var formData = new FormData();
            formData = getFormData(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('front.store-feedback') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $(".feedback-from-submit-btn").text('Submit');
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "addOptionForm", 'add');
                    $(".feedback-from-submit-btn").text('Submit');
                }
            });
        });
    </script>
@endsection
