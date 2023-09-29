@extends('front.partial.app')
@section('content')
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 text-end billing_left pl-0"></div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 my-3 mb-6">
                <div class="row">
                    {{-- <div class="col-lg-12"> --}}
                    <div class="col-lg-6">
                        <div class="billing-part">
                            <h1 class="billing-heading">Billing Details</h1>
                            <form id="paymentFrom" action="javascript:void(0);">
                                <div class="form-group">
                                    <label for="neme">First Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="name"></strong></span>
                                </div>

                                <div class="form-group">
                                    <label for="neme">Card Number</label>
                                    <input type="text" class="form-control" id="card_number" name="card_number">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="card_number"></strong></span>
                                </div>

                                <div class="form-group">
                                    <label for="neme">Billing Address 1*</label>
                                    <input type="text" class="form-control" id="billing_address" name="billing_address">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="billing_address"></strong></span>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Country</label>
                                        <input type="text" class="form-control" id="country" name="country">
                                        <span class="input-error" role="alert"> <strong
                                                add-data-input-error="country"></strong></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Province/State</label>
                                        <input type="text" class="form-control" id="inputCity" name="state">
                                        <span class="input-error" role="alert"> <strong
                                                add-data-input-error="state"></strong></span>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="phone"></strong></span>
                                </div>
                        </div>
                        {{-- <div class="submit-btn">
                                <button type="submit" class="btn btn-primary payment-submit-btn">submit</button>
                            </div> --}}
                    </div>

                    <div class="col-lg-6 billing-part" style="margin-top: 2em;">
                        <h1 class="billing-heading"></h1>
                        <div class="form-group">
                            <label for="neme">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                            <span class="input-error" role="alert"> <strong
                                    add-data-input-error="last_name"></strong></span>
                        </div>

                        <div class="">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="month">Expiry Date</label>
                                    <select id="month" class="form-control" name="month">
                                        <option value="1">Jan</option>
                                        <option value="2">Feb</option>
                                    </select>
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="month"></strong></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="year">Year</label>
                                    <select id="year" class="form-control" name="year">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                    </select>
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="year"></strong></span>
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="inputCity">Cvv</label>
                                    <input type="text" class="form-control" id="inputCity" name="cvv">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="cvv"></strong></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="billing_address">Billing Address 2</label>
                                <input type="text" class="form-control" id="billing_address_2"
                                    name="billing_address_2">
                                <span class="input-error" role="alert"> <strong
                                        add-data-input-error=""></strong></span>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="city"></strong></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="zip_code"></strong></span>
                                </div>
                            </div>
                        </div>

                        <p class="billing-title">Needs to look something like this</p>

                        <div class="submit-btn">
                            <button type="submit" class="btn btn-primary payment-submit-btn">submit</button>

                        </div>
                        <button type="submit" style="visibility: hidden;" class="btn btn-primary" data-toggle="modal"
                            data-target="#thankyouModal" id="showModal">submit</button>

                        <!-- Modal -->
                        <div class="modal fade thank" id="thankyouModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h2 class="b-poup-heading">Thank you for joining FLIT!</h2>
                                        <p class="b-poup-title">We sent a confirmation to your email and
                                            <span>you can always access your biling</span>
                                            information on your dashboard
                                        </p>
                                    </div>
                                    <div class="submit-btn pb-bottom">
                                        <a href="{{ route('user.home') }}" type="button"
                                            class="btn btn-primary">Continue To Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- </div> --}}

                    {{-- <div class="choose-plan" > --}}
                    {{-- <h1 class="billing-heading">Choose Payment Method</h1> --}}
                    {{-- 
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="plan_id" value="14"
                                id="exampleRadios1">
                            <label class="form-check-label" for="exampleRadios1" checked>Gpay</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="plan_id" value="14"
                                id="exampleRadios2">
                            <label class="form-check-label" for="exampleRadios2">Phone Pay</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="plan_id" value="14"
                                id="exampleRadios3">
                            <label class="form-check-label" for="exampleRadios3">Upi</label>
                        </div> --}}


                    {{-- <h1 class="billing-heading">CHOOSE PAYMENT METHOD</h1>

                        <div class="form-group">
                            <label for="inputState">PAYMENT METHOD</label>
                            <select id="inputState" class="form-control-with-select-box" name="payment">
                                <option value="gpay">Gpay</option>
                                <option value="phonepay">Phone Pay</option>
                                <option value="upi">Upi</option>
                            </select>
                            <span class="input-error" role="alert"> <strong
                                    add-data-input-error="payment"></strong></span>
                        </div> --}}


                    {{-- </div> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        $("#paymentFrom").submit(function(event) {
           

            $(".payment-submit-btn").text('Submiting....');
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
                url: "{{ route('front.payment') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 200) {
                        $(".payment-submit-btn").text('Submit');
                        $(".input-error").children('strong').text("");
                        $("#showModal").click();
                    } else {
                        alert(response.message)
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "addOptionForm", 'add');
                    $(".payment-submit-btn").text('Submit');
                }
            });
        });
    </script>
@endsection
