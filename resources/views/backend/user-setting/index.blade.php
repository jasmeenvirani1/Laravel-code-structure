@php
    $modual_name = 'user-setting';
@endphp
@extends('backend.partial.app')

@section('content')
    @include('backend.partial.header')
    @include('backend.partial.sidebar')
    @php
        function CheckPrivacy($data, $key)
        {
            if ($data[0][$key] == '1') {
                echo 'checked';
            }
        }
    @endphp
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">

            <div class="row mt-0 col-md-12">
                <!-- data-tabel start -->

                <div class="card-body border rounded mt-2">

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">SETTINGS</h5>
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <li><a class="nav-link text-left active" id="v-pills-user-setting-tab"
                                                    data-toggle="pill" href="#v-pills-user-setting" role="tab"
                                                    aria-controls="v-pills-home" aria-selected="false">User Settings</a>
                                            </li>

                                            <li><a class="nav-link text-left" id="v-pills-privacy-tab" data-toggle="pill"
                                                    href="#v-pills-privacy" role="tab" aria-controls="v-pills-Privacy"
                                                    aria-selected="true">Privacy</a></li>

                                            <li><a class="nav-link text-left" id="v-pills-notification-tab"
                                                    data-toggle="pill" href="#v-pills-notification" role="tab"
                                                    aria-controls="v-pills-notification"
                                                    aria-selected="false">Notifications</a></li>

                                            <li><a class="nav-link text-left" id="v-pills-security-tab" data-toggle="pill"
                                                    href="#v-pills-security" role="tab" aria-controls="v-pills-security"
                                                    aria-selected="false">Security & Login </a></li>

                                            @if (Session::get('UserSession')['role_id'] == '2')
                                                <li><a class="nav-link text-left" id="v-pills-billing-tab"
                                                        data-toggle="pill" href="#v-pills-billing" role="tab"
                                                        aria-controls="v-pills-billing" aria-selected="false">Billing </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade active show" id="v-pills-user-setting" role="tabpanel"
                                                aria-labelledby="v-pills-user-setting-tab">
                                                @php
                                                    foreach ($user_data as $list) {
                                                        $user = $list;
                                                    }
                                                    if (Session::get('UserSession')['role_id'] == '2') {
                                                        foreach ($card_detail as $c) {
                                                            $card = $c;
                                                        }
                                                    }
                                                @endphp
                                                <form action="javascript:void(0);" id="updateUserDetailForm">

                                                    <div class="row">
                                                        <h4>USER SETTINGS</h4>
                                                        <div class="col-md-12">

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Your Full Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="Enter Full Name" name="name"
                                                                    value="{{ $user->name }}">
                                                                <span class="input-error" role="alert"> <strong
                                                                        updateUser-data-input-error="name"></strong></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Email</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="Enter Email" name="email"
                                                                    value="{{ $user->email }}">
                                                                <span class="input-error" role="alert"> <strong
                                                                        updateUser-data-input-error="email"></strong></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">Location(City,Province,Country)</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="Enter Location" name="location"
                                                                    value="{{ $user->location }}">
                                                                <span class="input-error" role="alert"> <strong
                                                                        updateUser-data-input-error="location"></strong></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Social Media Links</label>
                                                                <br>
                                                                <div class="row">

                                                                    <div class="col-md-6">
                                                                        <label for="exampleInputEmail1">Instagram</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="Enter Instagram Link"
                                                                            name="instagram"
                                                                            value="{{ $user->instagram }}">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="exampleInputEmail1">Tiktok</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="Enter Tiktok Link" name="tiktok"
                                                                            value="{{ $user->tiktok }}">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="exampleInputEmail1">Facebook</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="Enter Facebook Link"
                                                                            name="facebook" value="{{ $user->facebook }}">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="exampleInputEmail1">Youtube</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="Enter Youtube Link"
                                                                            name="youtube" value="{{ $user->youtube }}">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="exampleInputEmail1">Twitter</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="Enter Twitter Link"
                                                                            name="twitter" value="{{ $user->twitter }}">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="exampleInputEmail1">Linkedin</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="Enter Linkedin Link"
                                                                            name="linkedin" value="{{ $user->linkedin }}">
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-primary edit-user-submit-btn float-right">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>



                                            <div class="tab-pane fade " id="v-pills-privacy" role="tabpanel"
                                                aria-labelledby="v-pills-privacy-tab">
                                                <h4>PRIVACY</h4>

                                                <form action="javascript:void(0);" id="updateUserPrivacyForm">
                                                    <input type="hidden" name="user_id" value="{{ $list->user_id }}">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="custom-control col-md-6 custom-switch">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input type_3"
                                                                        id="profilePublic" name="profile_public"
                                                                        {{ CheckPrivacy($privacy_deatil, 'profile_public') }}>
                                                                    <label class="custom-control-label"
                                                                        for="profilePublic">Is Your Profile public
                                                                        ?</label>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <label for="exampleInputEmail1">Content informaction displayed
                                                                ?</label>

                                                            <div class="ml-3">
                                                                <div class="form-group">
                                                                    <div class="custom-control col-md-6 custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input type_3"
                                                                            id="profilePublicShow" name="chat_button"
                                                                            {{ CheckPrivacy($privacy_deatil, 'chat_button') }}>
                                                                        <label class="custom-control-label"
                                                                            for="profilePublicShow">Flit Chat
                                                                            Button</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="custom-control col-md-6 custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input type_3"
                                                                            id="profilePublicEmil" name="email"
                                                                            {{ CheckPrivacy($privacy_deatil, 'email') }}>
                                                                        <label class="custom-control-label"
                                                                            for="profilePublicEmil">Email</label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="custom-control col-md-6 custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input type_3"
                                                                            id="profilePublicLinks"
                                                                            name="social_media_link"
                                                                            {{ CheckPrivacy($privacy_deatil, 'social_media_link') }}>
                                                                        <label class="custom-control-label"
                                                                            for="profilePublicLinks">Social Media
                                                                            Links</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group">
                                                                <div class="custom-control col-md-6 custom-switch">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input type_3"
                                                                        id="profilePublicLocation" name="location"
                                                                        {{ CheckPrivacy($privacy_deatil, 'location') }}>
                                                                    <label class="custom-control-label"
                                                                        for="profilePublicLocation">Show your location
                                                                        ?</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <button type="submit"
                                                                class="btn btn-primary edit-user-privacy-submit-btn float-right">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane fade" id="v-pills-notification" role="tabpanel"
                                                aria-labelledby="v-pills-notification-tab">
                                                <h4>NOTIFICATIONS</h4>

                                                <form action="javascript:void(0);" id="updateNotificationForm">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="custom-control col-md-6 custom-switch">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input type_3"
                                                                        id="notifactionLogged"
                                                                        name="login_time_notifaction"
                                                                        {{ CheckPrivacy($user_data, 'login_time_notifaction') }}>
                                                                    <label class="custom-control-label"
                                                                        for="notifactionLogged">Receive notification while
                                                                        logged in ?</label>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group">
                                                                <div class="custom-control col-md-6 custom-switch">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input type_3"
                                                                        id="notifactionEmail"
                                                                        name="recive_email_notifaction"
                                                                        {{ CheckPrivacy($user_data, 'recive_email_notifaction') }}>
                                                                    <label class="custom-control-label"
                                                                        for="notifactionEmail">Receive email notification
                                                                        ?</label>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group">
                                                                <div class="custom-control col-md-6 custom-switch">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input type_3"
                                                                        id="notifactionMonthly"
                                                                        name="newsletter_notifaction"
                                                                        {{ CheckPrivacy($user_data, 'newsletter_notifaction') }}>
                                                                    <label class="custom-control-label"
                                                                        for="notifactionMonthly">Subscribe to the monthly
                                                                        FLIT newsletter ?</label>
                                                                    <br>
                                                                    <p class="ml-4 mt-2 notification-warning"
                                                                        align="justify">
                                                                        Once a month we'll send you fitness tips,community
                                                                        updates and other cool stuf you'll probably want to
                                                                        know if you're already hear!
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-primary update-user-notification-submit-btn float-right">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane fade" id="v-pills-security" role="tabpanel"
                                                aria-labelledby="v-pills-security-tab">
                                                <h4>SECURITY & LOGIN</h4>

                                                <form action="javascript:void(0);" id="updateSecurityForm">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Login Email</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="Enter Email" name="email"
                                                                    value="{{ $user->email }}" readonly>
                                                                <span class="input-error" role="alert"> <strong
                                                                        updateSecurity-data-input-error="email"></strong></span>
                                                            </div>
                                                            <label for="exampleInputEmail1">Update Password</label>
                                                            <div class="form-group">

                                                                <input type="password" class="form-control mt-2"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="Enter New Password" name="password">

                                                                <input type="password" class="form-control mt-2"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="Enter Confirm Password"
                                                                    name="confirm_password">
                                                                <span class="input-error" role="alert"> <strong
                                                                        updateSecurity-data-input-error="confirm_password"></strong></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="custom-control col-md-6 custom-switch">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input type_3"
                                                                        id="authorization"
                                                                        name="two_factora_authorization"
                                                                        {{ CheckPrivacy($user_data, 'two_factora_authorization') }}>
                                                                    <label class="custom-control-label"
                                                                        for="authorization">Two Factor Authorization
                                                                        ?</label>
                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-primary update-security-submit-btn float-right">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            @if (Session::get('UserSession')['role_id'] == '2')
                                                <div class="tab-pane fade" id="v-pills-billing" role="tabpanel"
                                                    aria-labelledby="v-pills-billing-tab">
                                                    <h4>Billing</h4>
                                                    <form action="javascript:void(0);" id="updateBillingForm">
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Card Number</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputEmail1"
                                                                        aria-describedby="emailHelp"
                                                                        placeholder="Enter Card Number" name="card_number"
                                                                        value="{{ $card->card_number }}">
                                                                    <span class="input-error" role="alert"> <strong
                                                                            updateBilling-data-input-error="card_number"></strong></span>
                                                                    <br>

                                                                    <label for="exampleInputEmail1">Next Payment</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputEmail1"
                                                                        aria-describedby="emailHelp"
                                                                        placeholder="Next Payment" name="next_payment"
                                                                        value="{{ $card->next_payment }}">
                                                                    <span class="input-error" role="alert"> <strong
                                                                            updateBilling-data-input-error="next_payment"></strong></span>


                                                                    <label for="exampleInputEmail1">Payment Due</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputEmail1"
                                                                        aria-describedby="emailHelp"
                                                                        placeholder="Payment Due" name="payment_due"
                                                                        value="{{ $card->due_payment }}">
                                                                    <span class="input-error" role="alert"> <strong
                                                                            updateBilling-data-input-error="payment_due"></strong></span>

                                                                    <hr>
                                                              
                                                                    <div
                                                                        class="custom-control col-md-6 custom-switch mt-2">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input type_3"
                                                                            id="renew_automatic" name="renew_automatic"
                                                                            {{ CheckPrivacy($card_detail, 'renew_automatic') }}>
                                                                        <label class="custom-control-label"
                                                                            for="renew_automatic">Renew
                                                                            Automatically</label>
                                                                    </div>
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary update-billing-submit-btn float-right">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
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
@endsection

@section('page-script')
    <script>
        var userUpdate = "{{ route('user.setting.update') }}";
        // Get Data from Form and send with ajax.
        $("#updateUserDetailForm").submit(function(event) {
            var edit_user_data = $(this).serializeArray();

            var formData = new FormData();
            $.each(edit_user_data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".edit-user-submit-btn").text('Updating....');

            $.ajax({
                type: "POST",
                url: userUpdate,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 400) {
                        manageErrors(response.errors, "updateUserDetailForm", 'updateUser');
                        $(".edit-user-submit-btn").text('Update');
                    } else if (response.status == 200) {
                        clearErrors("updateUserDetailForm", "updateUser");

                        // Showing Success Message
                        triggerNotification('The User has been update successfully');
                        $(".edit-user-submit-btn").text('Update');
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "updateUserDetailForm", 'updateUser');
                    $(".edit-user-submit-btn").text('Update');
                }
            });
        });
    </script>

    {{-- Update Permission Script --}}
    <script>
        var userPrivacy = "{{ route('user.privacy.update') }}";
        // Get Data from Form and send with ajax.
        $("#updateUserPrivacyForm").submit(function(event) {
            var edit_user_data = $(this).serializeArray();

            var formData = new FormData();
            $.each(edit_user_data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".edit-user-submit-btn").text('Updating....');

            $.ajax({
                type: "POST",
                url: userPrivacy,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    // Showing Success Message
                    triggerNotification('The User has been update successfully');
                    $(".edit-user-submit-btn").text('Update');
                },
            });
        });
    </script>

    {{-- Update Notification Script --}}
    <script>
        var userNotification = "{{ route('user.notification.update') }}";
        // Get Data from Form and send with ajax.
        $("#updateNotificationForm").submit(function(event) {
            var edit_user_data = $(this).serializeArray();

            var formData = new FormData();
            $.each(edit_user_data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".update-user-notification-submit-btn").text('Updating....');

            $.ajax({
                type: "POST",
                url: userNotification,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    // Showing Success Message
                    triggerNotification('The User has been update successfully');
                    $(".update-user-notification-submit-btn").text('Update');
                },
            });
        });
    </script>

    <script>
        var userSecurity = "{{ route('user.security.update') }}";
        // Get Data from Form and send with ajax.
        $("#updateSecurityForm").submit(function(event) {
            var edit_user_data = $(this).serializeArray();

            var formData = new FormData();
            $.each(edit_user_data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".update-user-security-submit-btn").text('Updating....');

            $.ajax({
                type: "POST",
                url: userSecurity,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    // Showing Success Message
                    triggerNotification('The User has been update successfully');
                    clearErrors(this, "updateUser");

                    $(".update-user-security-submit-btn").text('Update');
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, this, 'updateSecurity');
                    $(".update-user-security-submit-btn").text('Update');
                }

            });
        });
    </script>
    <script>
        var userBilling = "{{ route('user.billing.update') }}";
        // Get Data from Form and send with ajax.
        $("#updateBillingForm").submit(function(event) {
            var edit_user_data = $(this).serializeArray();

            var formData = new FormData();
            $.each(edit_user_data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".update-user-billing-submit-btn").text('Updating....');

            $.ajax({
                type: "POST",
                url: userBilling,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    // Showing Success Message
                    triggerNotification('Payment detail Changed succesfully');
                    clearErrors(this, "updateUser");

                    $(".update-user-billing-submit-btn").text('Update');
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, this, 'updateBilling');
                    $(".update-user-billing-submit-btn").text('Update');
                }

            });
        });
    </script>
    {{-- Opction Add Script --}}
@endsection
