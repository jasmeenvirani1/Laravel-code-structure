@extends('front.partial.app')
@section('content')
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 text-end account_left pl-0"></div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 my-3 mb-6">
            <form action="javascript:void(0);" id="createAccountFrom">
                <div class="billing-part">
                    <input type="hidden" value="provider" name="role">
                    <h1 class="billing-heading">1. Create your Account:</h1>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="email">
                            <span class="input-error" role="alert"> <strong
                                    add-data-input-error="email"></strong></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="name">
                            <span class="input-error" role="alert" add-data-input-error="name">
                                <strong></strong></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" name="password">
                            <span class="input-error" role="alert"> <strong
                                    add-data-input-error="password"></strong></span>
                        </div>
                    </div>

                    <div class="choose-plan">
                        <h1 class="billing-heading">2. Choose your Plan:</h1>
                        @foreach ($subscription_plans as $list)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="plan_id" value="{{ $list->id }}"
                                @if($list->id == $plan_id) checked @endif id="exampleRadios1">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ucwords($list->type)}} -
                                ₹{{$list->price}}/{{$list->type}}<span>{{$list->description}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>


                    <h1 class="billing-heading">3. Payment:</h1>

                    <div class="submit-btn">
                        <button type="submit" class="btn btn-primary create-account-submit-btn">submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script>
    $("#createAccountFrom").submit(function(event) {
            $(".create-account-submit-btn").text('Submiting....');
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
                url: "{{ route('front.post-create-account') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $(".create-account-submit-btn").text('Submit');
                    window.location.replace("{{ route('front.bill') }}")
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "addOptionForm", 'add');
                    $(".create-account-submit-btn").text('Submit');
                }
            });
        });
</script>
@endsection