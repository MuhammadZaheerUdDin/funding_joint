<!--Footer-->
<footer class="page-footer">
    <!-- Footer Links -->
    <div class="container-fluid">
        <!-- Grid row-->
        <div class="row align-items-middle">
            <!-- Grid column -->
            <div class="col-12 col-md align-items-middle">
                <span class="footer-copyright">&copy; Funding Joint - Copyright 2018</span>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-12 col-md py-3 py-md-0 align-items-middle">

                <nav class="nav d-flex justify-content-between text-center">
                    <a class="nav-link" href="{{route('disclaimer')}}">Disclaimer</a>
                    <a class="nav-link" href="{{route('terms')}}">Terms of service</a>
                    <a class="nav-link" href="{{route('privacy')}}">Privacy Policy</a>
                    <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
                </nav>
            </div>
            <!-- Grid column -->

            <div class="col-12 col-md align-items-middle">
              <ul class="social-links p-0 d-flex justify-content-start justify-content-md-end">
                  <li><a href="https://business.facebook.com/Funding-Joint-Ltd-276202133226366/" target="_blank"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                  <li><a href="https://twitter.com/FundingJoint" target="_blank"><i class="fab fa-twitter fa-2x"></i></a></li>
                  <li><a href="https://www.instagram.com/fundingjoint/" target="_blank"><i class="fab fa-instagram fa-2x"></i></a></li>
                  <li><a href="https://linkedin.com/company/fundingjoint" target="_blank"><i class="fab fa-linkedin fa-2x"></i></a></li>
              </ul>
            </div>
        </div>


    </div>
    <!-- Footer Links -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="mt-2">
                    <small>
                        In the event of non-payment, the seller will be liable for any losses or costs incurred.
                        Investment opportunities offered may not be suitable for all investors and there is risk you may not get back your money.
                    </small>
                </p>
            </div>
        </div>
    </div>
</footer>

@if(isset($show_popup) && $show_popup == 1)
    <div class="loginOverlay"></div>
    <div class="login-popup-container">
        <span class="close-popup">x</span>
        <div class="login-popup-title">Coming soon!</div>
        <div class="login-popup-form">
            <p>Register for news and updates ahead of our launch</p>
            <form action="{{route('store.contactus')}}" method="POST">
                 {{ csrf_field() }}
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <!-- <input type="phone" name="" placeholder="Phone Number"> -->
                <p style="text-align: left;">I'm an interested:</p>
                <input class="safariSpecificMargin" type="radio" name="type" value="1" class="form-control" style="width: auto; float: left; text-align: left; margin-top: 0px;" checked><span style="display: block; text-align: left; margin-left: 20px; margin-top: -6px;" >Investor</span> 
                <input class="safariSpecificMargin" type="radio" name="type" value="2" class="form-control" style="width: auto; float: left; text-align: left;margin-top: 8px;"><span style="display: block; text-align: left; margin-left: 20px; margin-top: 3px;">Business</span> 
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
@endif




<!--/.Footer-->
