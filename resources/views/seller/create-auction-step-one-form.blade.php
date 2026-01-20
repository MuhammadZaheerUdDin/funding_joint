@extends('layouts.admin.page')
@section('content')

<style type="text/css">
  .card.form .card-body input, .card.form .card-body select, .card.form .card-body textarea{
    margin-bottom: 0px !important;
  }
</style>
  <div class="card form">

      <div class="card-header">
          <h3 class="float-left">CREATE NEW AUCTION</h3>
                <a data-toggle="tooltip" title="{{$page->content}}"  class="pull-right text-right" id="myPopover"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
      </div>
      <div class="step-menu">
        <div class="row">
          <div class="col-3 active-step"><a href="#" style="cursor: default;">Step One</a></div>
          <div class="col-3"><a href="#" style="cursor: default;">Step Two</a></div>
          <div class="col-3"><a href="#" style="cursor: default;">Step Three</a></div>
          <div class="col-3"><a href="#" style="cursor: default;">Step Four</a></div>
        </div>
      </div>
      <div class="card-body">


          <div class="row">
              <div class="col add-a-buyer">
                  <p class="address-title">ADD A BUYER</p>
                  <p>Select a Buyer from the dropdown menu or create a new Buyer by clicking
                      on the button below and completing the registration process.</p>
              </div>
          </div>



              <div class="row">
                  <div class="col-md-6 col-12">
                    Buyer name:<br>
                      <select id="choose_buyer" class="form-control select-buyer" name="buyer">
                          <option value="0">Select a Buyer</option>
                          @foreach($buyers as $buyer)
                          <option value="{{$buyer->id}}">{{$buyer->company_name}} </option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-6">
                    <div id="mydiv">
                    </div>
                    <br>
                    <a type="button" id="new_buyer" class="btn btn-outline-dark create-button" href="{{url('buyers/create')}}">CREATE
                          NEW BUYER</a>
                      <!-- button type="button" id="new_buyer" class="btn btn-outline-dark create-button">CREATE
                          NEW BUYER</button> -->
                  </div>
              </div>




          {!! $form->header !!}

          {!! $form->message !!} <br/>

          {!! $form->render('user_id') !!}

          @if(!$form->message)

              <div class="profile__1">
                  <div class="profile__content__1">

                      <div class="form-area ">


                          <div class="form-group pb-3">
                              <div class="row">
                                  <div class="col">

                                      <p class="buyer-detail mt-0 mb-4">Please enter the details of your buyer (the
                                          company that has raised the purchase order and will purchase your
                                          goods or services). Your buyer must be a UK registered company
                                          having traded for at least 3 years.</p>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">Company name(as it appears on the company
                                      documents) <span class="required"></span>
                                  </div>
                                  <div class="col-md-6">Company Registration Number <span class="required"></span></div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="company_name">

                                      {!! $form->render('company_name') !!}
                                  </div>
                                  <div class="col-md-6" id="company_registration"> 
                                      {!! $form->render('company_registration') !!}
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                    Company Registration Date
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6" id="company_registration_date_id">
                                    {{-- {!! $form->render('company_registration_date') !!} --}}
                                    <input class="form-control form-control" type="date" id="company_registration_date" name="company_registration_date">
                                </div>

                              </div>
                             <!--  <div class="row">

                                  <div class="col-md-6">Annual Turnover (£)<span class="required"></span></div>
                                  <div class="col-md-6"></div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
{{--                                      {!! $form->render('turnover') !!}--}}
                                      <input type="text" class="form-control" id="turnover">
                                      {!! Form::hidden('turnover','', ['class' => 'form-control','id'=>'turnover_original']) !!}

                                  </div>
                                  <div class="col-md-6"></div>
                              </div> -->
                          </div>


                          <div class="form-group pb-3">

                              <div class="row">
                                  <div class="col-12">
                                      <p class="address-title mt-0">
                                          BUYER ADDRESS DETAILS
                                      </p>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">Address line 1 <span class="required"></span></div>
                                  <div class="col-md-6">Address line 2</div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="address_1">
                                      {!! $form->render('address_1') !!}
                                  </div>
                                  <div class="col-md-6" id="address_2">
                                      {!! $form->render('address_2') !!}
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">Address line 3</div>
                                  <div class="col-md-6"></div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="address_3">
                                      {!! $form->render('address_3') !!}
                                  </div>
                                  <div class="col-md-6"></div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">Town / City <span class="required"></span></div>
                                  <div class="col-md-6">County / Region</div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="town">
                                      {!! $form->render('town') !!}
                                  </div>
                                  <div class="col-md-6" id="county">
                                      {!! $form->render('county') !!}
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">Postcode <span class="required"></span></div>
                                  <div class="col-md-6">Company Website </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="post_code">
                                      {!! $form->render('post_code') !!}
                                  </div>
                                  <div class="col-md-6" id="company_website">
                                      {!! $form->render('company_website') !!}
                                  </div>
                              </div>
                          </div>

                          <div class="form-group pb-3">
                              <div class="row">
                                  <dic class="col-12">
                                      <p class="address-title mt-0">
                                          BUYER CONTACT DETAILS
                                      </p>
                                      <p>We will need to verify your Buyer, so please provide the details of
                                          the person in that company that we can contact to do this. We will
                                          not contact your Buyer without your prior permission.</p>
                                  </dic>
                              </div>
                              <!-- <div class="row">
                                  <div class="col-md-6">Title <span class="required"></span></div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="title">
                                      {!! $form->render('title') !!}
                                  </div>
                              </div> -->
                              <div class="row">
                                  <div class="col-md-6">First name <span class="required"></span></div>
                                  <div class="col-md-6">Last name <span class="required"></span></div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="first_name">
                                      {!! $form->render('first_name') !!}
                                  </div>
                                  <div class="col-md-6" id="last_name">
                                      {!! $form->render('last_name') !!}
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">Job title <span class="required"></span></div>
                                  <div class="col-md-6">Email address <span class="required"></span></div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6" id="job_title">
                                      {!! $form->render('job_title') !!}
                                  </div>
                                  <div class="col-md-6" id="email">
                                      {!! $form->render('email') !!}
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-2">Phone code <span class="required"></span></div>
                                  <div class="col-md-4">Telephone number <span class="required"></span></div>

                                  <div class="col-md-3">
                                      Business Type <span class="required"></span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-2" id="phone_code">
                                      {!! $form->render('phone_code') !!}
                                  </div>
                                  <div class="col-md-4" id="phone">
                                      {!! $form->render('phone') !!}
                                  </div>

                                  <div class="col-md-6" id="business_type">
                                      {!! $form->render('business_type') !!}
                                  </div>

                              </div>
                          </div>
                      </div>
                  </div>
                  @endif
                  <div class="submit">
                  {!! $form->footer !!}
                </div>

        </div>
    </div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script >
      $(function(){
          // Enables popover
          $("[data-toggle=tooltip]").tooltip();
      });
      var turnover = document.getElementById('turnover');
      var turnover_original = document.getElementById('turnover_original');

      turnover.addEventListener('keyup', function(e)
      {
          turnover.value = format_number(this.value);
          turnover_original.value = parseInt(this.value.replace(/,/gi, ""));
      });
  </script>

  <!-- <script type="text/javascript">
        $("#choose_buyer").on('change',(function(){
          var selectedValue = $("#choose_buyer").val();
          dd(selectedValue);
            console.log(selectedValue);
            $.ajax({ //<-- One . was missing before ajax
                type: "POST",
                dataType: 'json',
                url: '/step-1.php',
                data: { choose_buyer: selectedValue }, // <-- Comma was missing here
                success: function(data) {
                    console.log(data);
                }
            });
        });
    </script> -->



@endsection
