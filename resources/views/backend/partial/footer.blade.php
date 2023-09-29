<link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">

<div class="footer-bg headerpos-fixed" style="padding-top: 24px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="social-icon">
                    <ul class="s-icon">
                        <li><a href="#"><img src="http://127.0.0.1:8000/frontend/img/fb.png"></a></li>
                        <li><a href="#"><img src="http://127.0.0.1:8000/frontend/img/insta.png"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="footer-menu">
                    <ul class="ftr-menu">
                        @if (Session::get('UserSession')['role_id'] == '2')
                            <li><a href="{{ route('front.get-pages', ['slug' => 'flit-home']) }}">FLIT HOME</a></li>
                            <li><a href="{{ route('front.explore-fitness') }}">EXPLORE</a></li>
                            <li><a href="{{ route('front.get-pages', ['slug' => 'faq']) }}">FAQ</a></li>
                            <li><a href="{{ route('front.support') }}">SUPPORT</a></li>
                            <li><a href="{{ route('front.get-pages', ['slug' => 'privacy-policy']) }}">PRIVACY
                                    POLICY</a></li>
                        @elseif(Session::get('UserSession')['role_id'] == 3)
                            <li><a href="{{ route('front.get-pages', ['slug' => 'flit-home']) }}">FLIT HOME</a></li>
                            <li><a href="{{ route('front.support') }}">SUPPORT</a></li>
                            <li><a href="{{ route('front.pricing') }}">PRICING</a></li>
                            <li><a href="{{ route('front.get-pages', ['slug' => 'faq']) }}">FAQ</a></li>
                            <li><a href="{{ route('front.get-pages', ['slug' => 'privacy-policy']) }}">PRIVACY
                                    POLICY</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="copyright">
                    <p id="RightsText" style="font-size: 13px;">FLIT 2023 © ALL RIGHTS RESERVED</p>
                </div>
            </div>
        </div>
    </div>
</div>
