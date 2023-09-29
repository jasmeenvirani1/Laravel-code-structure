@extends('front.partial.app')
@section('content')
<div class="support-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="support-left">
                    <h1 class="support-heading">Support & Contact</h1>
                    <p class="s-heading">{{GetSetting('contact-email')}}</p>
                    <p class="s-heading">{{GetSetting('contact-phone')}}</p>
                    <p class="s-titile">Please feel free to reach out directly through rhe website contact form.
                        <span>Our support team will do their best to respond within 24 hours</span>
                    </p>

                    <h4 class="qs-heading">Question?</h4>
                    <p class="qs-title">Review <a href="{{route('front.get-pages',['slug' => 'faq'])}}">our FAQ
                            Section</a> to help assist you.</p>

                </div>
            </div>
            <div class="col-lg-7">
                <div class="support-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Name*</label>
                                <input type="email" class="form-control" id="firstname">
                                <label for="inputEmail4">First Name*</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">&nbsp;</label>
                                <input type="text" class="form-control" id="lastname">
                                <label for="text">Last Name*</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="text" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Message*</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn custom-btn">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection