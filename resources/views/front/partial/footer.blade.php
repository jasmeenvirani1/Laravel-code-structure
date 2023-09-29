<!-- FOOTER PART START -->
<div class="footer-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="social-icon">
                    <ul class="s-icon">
                        <li><a href="#"><img src="{{asset('/frontend/img/fb.png')}}"></a></li>
                        <li><a href="#"><img src="{{asset('/frontend/img/insta.png')}}"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer-menu">
                    <ul class="ftr-menu">
                        @php
                        $footerData = GetFooter();
                        @endphp
                        @foreach ($footerData as $footer)
                        <li><a href="{{route('front.get-pages',['slug' => $footer->slug])}}">{{$footer->title}}</a></li>
                        @endforeach
                        {{-- <li><a href="{{route('front.explore-fitness')}}">FLIT HOME</a></li> --}}
                        <li><a href="{{route('front.support')}}">SUPPORT</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="copyright">
                    <p id="RightsText"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FOOTER PART END -->