<section class="subscribe--newsletter">

    <div class="container">

        <div class="row subscribe--top--block">
            <div class="col-md-12 text-center subscribe--title">
                <h3>
                    @inlineEditor( 'sign-up-newsletter' )
                    Sign-Up To Our Newsletter
                    @endInlineEditor
                </h3>
            </div>
        </div>

        <div class="row subscribe--bottom--block">

            <div class="col-md-6 subscribe--content">
                <h5>
                    @inlineEditor( 'stay-up-date' )
                    Stay up to date with Funding Joint
                    @endInlineEditor
                </h5>

                <p>
                    @php
                        $website_data = \App\Model\Admin\WebsiteContents::where('id', 7)->first();
                        
                    @endphp
                    {{-- @inlineEditor( 'stay-up-date-leed' )
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam aspernatur consequatur corporis debitis error esse, eveniet exercitationem harum in molestiae natus omnis, pariatur quidem recusandae repellendus sed similique veniam.
                    @endInlineEditor --}}
                    {!!$website_data->content!!}
                </p>
            </div>


            <div class="col-md-6 form-block">
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->

                <!-- Begin Mailchimp Signup Form -->
                <div id="mc_embed_signup">
                <form action="https://fundingjoint.us19.list-manage.com/subscribe/post?u=3bfd9945a2b9ecaf975ad874a&amp;id=5df1642fc1"
                      method="post" id="mc-embedded-subscribe-form" class="validate text-center" target="_blank"
                      name="mc-embedded-subscribe-form"
                      novalidate>
                    <div id="mc_embed_signup_scroll">
                    <!-- Name -->
                    <div class="md-form m-t-5 subscribe-input">
                        <input type="text" id="materialSubscriptionFormPasswords" name="LNAME" class="form-control">
                        <label for="materialSubscriptionFormPasswords">Full Name</label>
                    </div>
                    <!-- E-mai -->
                    <div class="md-form m-t-5 subscribe-input">
                        <input type="email" id="mce-EMAIL" name="EMAIL" class="form-control">
                        <label for="materialSubscriptionFormEmail">E-mail Address</label>
                    </div>
                    <div class="md-form m-t-12">
                        <div style="display: inline-block;">

                        <label for="materialSubscriptionFormEmail"><input style="float: left; width: 15px;margin-right: 5px; margin-top: 5px; box-shadow: 0 0px 0 0 #fff;"  type="checkbox" id="mce-checkbox" name="checkbox1" class="form-control">My business is looking to release cash from invoices </label>
                        
                        </div>
                        
                    </div>
                    <div class="md-form m-t-12">
                        <div style="display: inline-block;">
                        <label for="materialSubscriptionFormEmail"><input style="float: left; width: 15px;margin-right: 5px; ; margin-top: 5px; box-shadow: 0 0px 0 0 #fff;"  type="checkbox"  name="checkbox1">I am an investor looking for returns from funding invoices </label>
                        
                        </div>
                        
                    </div>
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_3bfd9945a2b9ecaf975ad874a_5df1642fc1" tabindex="-1" value=""></div>
                    <!-- Sign in button -->
                    <button class="btn btn-outline-info float-left btn-rounded z-depth-0 waves-effect" type="submit">Subscribe now</button>
                    </div>
                </form>
                <!-- Form -->
                    @push('scripts')
                        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
                        <script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                    @endpush
                 <!--End mc_embed_signup-->
                </div>
            </div>

        </div>

    </div>
</section>
