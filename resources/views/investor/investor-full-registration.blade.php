@extends('layouts.admin.page')

@section('content')

<div class="profile">
  <div class="profile__content">

      {!! Form::model(array($investor), ['action' => 'Investor\InvestorController@store','class' => '']) !!}
      <div class="row mb-4 align-items-center">
        <div class="col-md-12 col-sm-12 edit-button">
          <h5 class="profile__content__heading">My Profile</h5>
          <hr>
        </div>
        <div class="col-md-8">
          <div class="icon">
            <img src="https://ui-avatars.com/api/?size=100&name=F+J&background=212121&color=fff"
            class="rounded-circle float-left" style="width:100px">
          </div>
          <div class="icon-text">
            <!-- <img src="http://placehold.it/100" alt="" class="rounded-circle float-left mr-3"> -->
            <h4 class="font-weight-bold">Registration</h4>
            <p class="profile-label">You can browse the marketplace, but will need to complete your profile before being able to make an investment.</p>
          </div>
        </div>
        <div class="col-md-4 edit-button">
          <!-- {!! Form::submit('Save',['class' => 'btn btn-dark float-right']) !!} -->
          <button type="submit" class="btn btn-dark float-right">
            {{ __('SAVE') }}
          </button>
        </div>
      </div>
      <div class="form-area mt-5">
        <div class="form-group pb-3">
            <h5 class="profile__content__heading">Personal Details</h5>
            <div class="row">
                <div class="col">
                    {!! Form::label('Title', 'Title') !!} <span class="required"></span>

                    <select class="form-control" name="title">
                        <option value="">Select</option>
                        <option @if (Input::old('title') == 'Mr') selected="selected" @endif value="Mr">Mr</option>
                        <option @if (Input::old('title') == 'Mrs') selected="selected" @endif value="Mrs">Mrs</option>
                        <option @if (Input::old('title') == 'Ms') selected="selected" @endif value="Ms">Ms</option>
                    </select>
                    <span class="error_input">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('First name','First name') !!} <span class="required"></span>
                    {!! Form::text('first_name','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                </div>
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Last name','Last name') !!} <span class="required"></span>
                    {!! Form::text('last_name','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Middle name','Middle name') !!}
                    {!! Form::text('middle_name','', ['class' => 'form-control']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('middle_name') }}</strong>
                    </span>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6 col-sm-12">
                    {!! Form::label('User name (visible to others)','User name (visible to others)') !!}<span class="required"></span>
                    {!! Form::text('user_name','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {!! Form::label('Date Of Birth','Date Of Birth') !!} <span class="required"></span>
                    {!! Form::date('dob',Input::old('dob'), ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('dob') }}</strong>
                    </span>
                </div>
                <div class="col">

                    {!! Form::label('Gender','Gender') !!} <span class="required"></span>
                    <br>
                    <select class="form-control" name="gender" required>
                        <option value="">Select</option>
                        <option @if (Input::old('gender') == 'male') selected="selected" @endif value="male">Male</option>
                        <option @if (Input::old('gender') == 'female') selected="selected" @endif value="female">Female</option>
                        <option <?php if(Input::old('gender')=='not_to_say'): ?> selected <?php endif; ?> value="not_to_say">Prefer not to say</option>

                    </select>
                     <span class="error_input">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Nationality','Nationality') !!} <span class="required"></span>
                    <select class="form-control" name="nationality" required>
                        <option value="">Select</option>
                        @if(count($nationalities))
                        @foreach($nationalities as $nationality)
                        <option @if (Input::old('nationality') == $nationality) selected="selected" @endif value="{{$nationality}}">{{$nationality}}</option>
                        @endforeach
                        @endif
                    </select>
                    <span class="error_input">
                        <strong>{{ $errors->first('nationality') }}</strong>
                    </span>
                </div>
                <div class="col">

                </div>
            </div>

        </div>
        <div class="form-group pb-3">
          <h5 class="profile__content__heading">Address Details</h5>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Country Of Residence','Country Of Residence') !!} <span class="required"></span>
                    <select class="form-control" name="country_residence" required>
                        <option value="">Select</option>
                        @if(count($countries))
                        @foreach($countries as $country)
                        <option @if (Input::old('country_residence') == $country) selected="selected" @endif value="{{$country}}">{{$country}}</option>
                        @endforeach
                        @endif
                    </select>
                    <span class="error_input">
                        <strong>{{ $errors->first('country_residence') }}</strong>
                    </span>
                </div>
                <div class="col">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Building Number Name','Building Number or Name') !!} <span class="required"></span>
                    {!! Form::text('building_no','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('building_no') }}</strong>
                    </span>
                </div>
                <div class="col"></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Address Line 1','Address Line 1') !!} <span class="required"></span>
                    {!! Form::text('address_1','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('address_1') }}</strong>
                    </span>
                </div>
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Address Line 2','Address Line 2') !!}
                    {!! Form::text('address_2','', ['class' => 'form-control']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('address_2') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Address Line 3','Address Line 3') !!}
                    {!! Form::text('address_3','', ['class' => 'form-control']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('address_3') }}</strong>
                    </span>
                </div>
                <div class="col"></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Town / City','Town / City') !!} <span class="required"></span>
                    {!! Form::text('town','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('town') }}</strong>
                    </span>
                </div>
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('County / Region','County / Region') !!} 
                    {!! Form::text('county','', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Post code','Post code') !!} <span class="required"></span>
                    {!! Form::text('post_code','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('post_code') }}</strong>
                    </span>
                </div>
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Country','Country') !!} <span class="required"></span>
                    <select class="form-control" name="country">
                        <option value="">Select</option>
                        @if(count($countries))
                        @foreach($countries as $country)
                        <option @if (Input::old('country') == $country) selected="selected" @endif  value="{{$country}}">{{$country}}</option>
                        @endforeach
                        @endif
                    </select>
                    <span class="error_input">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12">

                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            {!! Form::label('Phone Code','Phone Code') !!} <span class="required"></span>
                            {!! Form::text('phone_code','', ['class' => 'form-control','required']) !!}
                            <span class="error_input">
                                <strong>{{ $errors->first('phone_code') }}</strong>
                            </span>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            {!! Form::label('Phone Number','Phone Number') !!} <span class="required"></span>
                            {!! Form::text('phone','', ['class' => 'form-control','required']) !!}
                            <span class="error_input">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group pb-3">
          <h5 class="profile__content__heading pb-3">Declaration For Sophisticated Investors</h5>
          <h6><i>The content of this promotion has not been approved
                  by an authorised person within the meaning of the Financial Services Act 2000.
                  Reliance on this promotion for the purpose of engaging in any investment activity may
                  expose an individual to a significant risk of losing all of the property or other assets
                  invested.
              </i></h6>
          <h6>
            <p class="pt-1 pr-2 float-left">
                {{-- {!! Form::checkbox('read_investors_declaration',1,false) !!} --}}
                <input name=read_investors_declaration type="checkbox" required  value="1">
                <p>
                  <span class="required"></span> I have read the sophisticated <a href="" data-toggle="modal" data-target="#debitModal">Investor/High Net Worth individual declaration</a>
            form and declare that I ma a self-certified sophisticated investor for the purposes of the
            Financial Services and Markets Act (Financial Promotion) Order 2005.

          </h6>
            <span class="error_input">
              <strong>{{ $errors->first('read_investors_declaration') }}</strong>
          </span>
          <!-- <a href="high-net-worth-form">Read sophisticated investor / High Net Worth individual declaration form</a> -->
          {{--<iframe src="https://www.stellar-am.com/investor/wp-content/uploads/2017/01/Sophisticated-HNWI-Form.pdf"--}}
              {{--height="300" width="100%"></iframe>--}}
        </div>
        <div class="form-group pb-3">
          <h5 class="profile__content__heading">Further Details</h5>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Source of funds','Source of funds') !!}    <span class="required"></span>
                    <br>Please state the source from which you obtained the funds that you will invest
                    {!! Form::text('source_of_funds','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('source_of_funds') }}</strong>
                    </span>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Job title','Job title') !!} <span class="required"></span>
                    {!! Form::text('job_title','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('job_title') }}</strong>
                    </span>
                </div>
                {{-- <div class="col-md-6 col-sm-12">
                    {!! Form::label('Job title','Job title') !!}
                    <select class="form-control" name="job_title">
                        <option value="">Select</option>
                        @if(count($occupations))
                        @foreach($occupations as $occupation)
                        <option @if (Input::old('job_title') == $occupation) selected="selected" @endif value="{{$occupation}}">{{ucfirst($occupation)}}</option>
                        @endforeach
                        @endif
                    </select>
                </div> --}}
                <div class="col">
                    {!! Form::label('Employer name','Employer name') !!} <span class="required"></span>
                    {!! Form::text('employer_name','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('employer_name') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Nature of employers business','Nature of employers business') !!} <span class="required"></span>
                    {!! Form::text('nature_employers_business','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('nature_employers_business') }}</strong>
                    </span>
                </div>
                {{--  <div class="col-md-6 col-sm-12">
                    {!! Form::label('Nature of employers business','Nature of employers business') !!}
                    <select class="form-control" name="nature_employers_business">
                        <option value="">Select</option>
                        @if(count($professions))
                        @foreach($professions as $profession)
                            <option @if (Input::old('nature_employers_business') == $profession) selected="selected" @endif value="{{$profession}}">{{ucfirst($profession)}}</option>
                        @endforeach
                        @endif

                    </select>
                    <input type="text" class="d-none form-control" name="otherNatureOfEmployers" id="otherNatureOfEmployers">
                    <span class="error_input">
                        <strong>{{ $errors->first('nature_employers_business') }}</strong>
                    </span>
                </div> --}}
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('Location of business','Location of business') !!} <span class="required"></span>
                     {!! Form::text('business_location','', ['class' => 'form-control','required']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('business_location') }}</strong>
                    </span>
                </div>
               {{--  <div class="col-md-6 col-sm-12">
                    {!! Form::label('Location of business','Location of business') !!}
                    <select class="form-control" name="business_location">
                        <option value="">Select</option>
                        @if(count($professions))
                        @foreach($countries as $country)
                            <option @if (Input::old('country_residence') == $country) selected="selected" @endif value="{{$country}}">{{$country}}</option>
                        @endforeach
                        @endif
                    </select>
                </div> --}}

            </div>
    <!-- <div class="row">
        <div class="col-md-6 mt-4">
            <a href="/terms" target="_blank">Terms & Condidtions</a>
        </div>
    </div> -->
            <button type="submit" class="btn btn-dark mt-5">
              {{ __('SAVE') }}
            </button>
        </div>
      </div>
      {!! Form::close() !!}
  </div>
  <!--end card body-->
</div>
<!--end card-->

<!--end container-->

 <!-- Invester model-->
    <div class="modal fade" id="debitModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content account__modal">
                    <div class="modal-header">
                        <h4 class="modal-title text-center" id="modelTitleId">Sophisticated investor / HNW Individual Declaration</h4>
                        <button type="button" style="margin: -1rem -26rem -1rem auto !important;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <hr>
                    </div>
                    <div class="modal-body" style=" text-align: justify;text-justify: inter-word !important;">
                        <p>
                        The Funding Joint Platform is a new and innovative approach to the traditional factoring model. Consequently, there may arise certain risks which may not be suitable for retail investors. As such, any investment opportunities listed on the Platform (or associated services) are currently only available to sophisticated investors, high net worth (HNW) individuals and companies and institutions. 
                        <p>
                        <p>
                            For the avoidance of doubt, the Funding Joint Platform does not offer any investment of a specified kind or undertake any regulated activity under the Financial Services and Markets Act 2000. The specimen statements provided in the Financial Services and Markets Act (Financial Promotion) Order 2005 are being used as good industry practice and without prejudice to the above. 
                        </p>
                        <p>
                        <u><b>Declaration for sophisticated investors:</b></u>
                        <p><b>I declare that I am a self-certified sophisticated investor for the purposes of the Financial Services and Markets Act (Financial Promotion) Order 2005.</b></p>
                        <p>I understand that this means that:</p>
                        <p><b>a.</b>&nbsp;&nbsp;I can receive financial promotions that may not have been approved by a person authorised by the Financial Conduct Authority;<br>
                       <b>b.</b>&nbsp;&nbsp;The content of such financial promotions may not conform to the rules issued by the Financial Conduct Authority;<br>
                        <b>c.</b>&nbsp;&nbsp;By providing this statement I may lose significant rights;<br>
                        <b>d.</b>&nbsp;&nbsp;I may have no right to complain to either of the following:<br>
                        i.&nbsp;&nbsp;The Financial Conduct Authority; or<br>
                        ii.&nbsp;&nbsp;The Financial Ombudsman Scheme;<br>
                       <b>e.</b>&nbsp;&nbsp;I may have no right to seek compensation from the Financial Services Compensation Scheme.<br>
                        I also declare that I am a self-certified sophisticated investor because at least one of the following applies to me:<br>
                       <b>f.</b>&nbsp;&nbsp;I am a member of a network or syndicate of business angels and have been so for at least the last six months prior to today’s date;<br>
                       <b>g.</b>&nbsp;&nbsp;I have made more than one investment in an unlisted company in the two years prior to today’s date;<br>
                       <b>h.</b>&nbsp;&nbsp;I am working, or have worked in the two years prior to today’s date, in a professional capacity in the private equity sector, or in the provision of finance for small and medium enterprises;<br>
                       <b>i.</b>&nbsp;&nbsp;I am currently, or have been in the two years prior to today’s date, a director of a company with an annual turnover of at least £1 million.</p>
                        <p><b>
                            I accept that I can lose my property and other assets from making investment decisions based on financial promotions.<br>
                            I am aware that it is open to me to seek advice of someone who specialises in advising on investments.
                        </b></p>
                        <p><u><b>Declaration for high net worth individuals:</b></u></p>
                         <p><b>I declare that I am a self-certified high net worth individual for the purposes of the Financial Services and Markets Act (Financial Promotion) Order 2005.</b></p>
                        <p>I understand that this means that:</p>
                        <p>
                            <b>a.</b>&nbsp;&nbsp;I can receive financial promotions that may not have been approved by a person authorised by the Financial Conduct Authority;<br>
                            <b>b.</b>&nbsp;&nbsp;The content of such financial promotions may not conform to the rules issued by the Financial Conduct Authority;<br>
                            <b>c.</b>&nbsp;&nbsp;By providing this statement I may lose significant rights;<br>
                            <b>d.</b>&nbsp;&nbsp;I may have no right to complain to either of the following:<br>
                                i.&nbsp;&nbsp;The Financial Conduct Authority; or<br>
                                ii.&nbsp;&nbsp;The Financial Ombudsman Scheme;<br>
                            <b>e.</b>&nbsp;&nbsp;I may have no right to seek compensation from the Financial Services Compensation Scheme.<br>
                            I also declare that I am a high net worth individual because at least one of the following applies to me:<br>
                            <b>f.</b>&nbsp;&nbsp;I had, during the financial year immediately preceding today’s date, an annual income to the value of £100,000 or more;<br>
                            <b>g.</b>&nbsp;&nbsp;I held, throughout the financial year immediately preceding today’s date, net assets to the value of £250,000 or more. Net assets for these purposes do not include:<br>
                              i.&nbsp;&nbsp;The property which is my primary residence or any loan 
                                    secured on that residence;<br>
                             ii.&nbsp;Any rights of mine under a qualifying contract of 
                                    insurance within the meaning for the Financial 
                                    <span style="margin-left: 130px;">Services and Markets Act 200 (Regulated Activities) Order 2001; or</span><br>
                            <span style="margin-right: 45px;">iii.&nbsp;Any benefits (in the form of 
                                    pensions or otherwise) 
                                    which are payable on the termination</span><span style="margin-left: 127px;"> of my service or on my death or retirement and to which I am (or my dependants are), or may </span><span style="margin-left: 127px;"> be, entitled.</span><p>
                        <p><b>
                        I accept that I can lose my property and other assets from making investment decisions based on financial promotions.
                        I am aware that it is open to me to seek advice of someone who specialises in advising on investments.</b></p>
                    </div>
                     <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>




@endsection
