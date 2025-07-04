    <footer class="footer_2">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                    <div class="wsus__footer_content">
                        <a class="wsus__footer_2_logo" href="#">
                            <img src="{{ asset(@$footer->logo) }}" alt="logo">
                        </a>
                        <a class="action" href="callto:+8896254857456"><i class="fas fa-phone-alt"></i>
                            {{ @$footer->phone }}</a>
                        <a class="action" href="mailto:example@gmail.com"><i class="far fa-envelope"></i>
                            {{ @$footer->email }}</a>
                        <p><i class="fal fa-map-marker-alt"></i> {!! @$footer->address !!}</p>
                        <ul class="wsus__footer_social">
                            @if (@$footer->fb_link !== null)
                            <li><a class="facebook" href="{{ @$footer->fb_link }}"><i class="fab fa-facebook-f"></i></a>
                            </li>      
                            @endif

                            @if (@$footer->twitter_link !== null)
                            <li><a class="twitter" href="{{ @$footer->twitter_link }}"><i
                                        class="fab fa-twitter"></i></a></li>        
                            @endif
                          
                        
                            @if (@$footer->whatsapp_link !== null)
                            <li><a class="whatsapp" href="{{ @$footer->whatsapp_link }}"><i
                                        class="fab fa-whatsapp"></i></a></li>      
                            @endif
                          
                            @if (@$footer->pinterest_link !== null)
                            <li><a class="pinterest" href="{{ @$footer->pinterest_link }}"><i
                                        class="fab fa-pinterest-p"></i></a></li>       
                            @endif

                            @if (@$footer->instagram_link !== null)
                            <li><a class="instagram" href="{{ @$footer->instagram_link }}"><i
                                        class="fab fa-instagram"></i></a></li>        
                            @endif
                         
                        
                            @if (@$footer->youtube_link !== null)
                            <li><a class="youtube" href="{{ @$footer->youtube_link }}"><i
                                        class="fab fa-youtube"></i></a></li>       
                            @endif

                            @if (@$footer->linkedin_link !== null)
                            <li><a class="linkedin" href="{{ @$footer->linkedin_link }}"><i
                                        class="fab fa-linkedin-in"></i></a></li>         
                            @endif

                            @if (@$footer->tiktok_link !== null)
                            <li><a class="tiktok" href="{{ @$footer->tiktok_link }}"><i class="fab fa-tiktok"></i></a>
                            </li>     
                            @endif
                         
                       
                           
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                    <div class="wsus__footer_content">
                        <h5>Company</h5>
                        <ul class="wsus__footer_menu">
                            <li><a href="{{ route('about-page.index') }}"><i class="fas fa-caret-right"></i> About Us</a></li>
                             <li><a href="{{ route('term-page.index') }}"><i class="fas fa-caret-right"></i> Terms & Conditions</a></li>
                              <li><a href="{{ route('contact-page.index') }}"><i class="fas fa-caret-right"></i> Contact Us</a></li>
                               <li><a href="{{ route('order-track') }}"><i class="fas fa-caret-right"></i> Order Track</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Team Member</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Career</a></li>
                           
                            <li><a href="#"><i class="fas fa-caret-right"></i> Affilate</a></li>
                           
                            <li><a href="#"><i class="fas fa-caret-right"></i> Team Member</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                    <div class="wsus__footer_content">
                        <h5>Company</h5>
                        <ul class="wsus__footer_menu">
                            <li><a href="#"><i class="fas fa-caret-right"></i> About Us</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Team Member</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Career</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Contact Us</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Affilate</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Order History</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Team Member</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                    <div class="wsus__footer_content wsus__footer_content_2">
                        <h3>Subscribe To Our Newsletter</h3>
                        <p>Get all the latest information on Events, Sales and Offers.
                            Get all the latest information on Events.</p>
                        <form class="newsletter_form">
                        
                            <input type="email" placeholder="email..." name="email">
                            <button type="submit" class="common_btn">subscribe</button>
                        </form>
                       @if (@$footer->gateway_logo !== null)
                            <div class="footer_payment">
                            <p>We're using safe payment for :</p>
                            <img src="{{ asset(@$footer->gateway_logo) }}" alt="card" class="img-fluid">
                        </div>
                       @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="wsus__footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__copyright d-flex justify-content-center">
                            <p>{{ @$footer->copyright }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
