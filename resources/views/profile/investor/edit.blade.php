@extends('layouts.admin.page')
<?php //echo "<pre>";print_r($profile);exit();?>
@section('content')
    <div class="profile">
        <div class="profile__content">
            {!! Form::model(array($profile), ['action' => 'Profile\UserProfileController@postProfile','class' => '','files'=>true]) !!}
            <div class="row align-items-center">
                <div class="col-12  col-md-12 col-sm-12 edit-button">
                    <h5 class="profile__content__heading">My Profile</h5>
                    <hr>
                </div>
                <div class="col-12  col-md-8">
                    <div class="icon">
                        <img src="https://ui-avatars.com/api/?size=100&name={{$profile->first_name}}+{{$profile->last_name}}&background=212121&color=fff"
                             class="rounded-circle float-left" style="width:100px">
                    </div>
                    <div class="icon-text">
                        <!-- <img src="http://placehold.it/100" alt="" class="rounded-circle float-left mr-3"> -->
                        <h4 class="font-weight-bold">Edit Profile</h4>
                        <p class="profile-label">Certain changes might require us to re-evaluate your access to
                            investment opportunities</p>
                    </div>
                </div>
                <div class="col-12  col-md-4 edit-button">
                    <button type="submit" class="btn btn-dark float-right">
                        {{ __('SAVE') }}
                    </button>
                </div>
            </div>

            <div class="form-area  mt-5">
                <div class="form-group pb-3">
                    <i class="zmdi zmdi-check-circle"></i>
                    <h5 class="profile__content__heading">Login Details</h5>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Email address', 'Email address') !!}
                            {!! Form::text('',$profile->user->email,['class'=>'form-control','readonly']) !!}
                            <span class="error_input">
                        <strong>{{ $errors->first('email') }}</strong>
                </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label for="">
                                If you wish to change your login details please click <a
                                        href="{{route('profile.password.change')}}">here</a>.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                    <i class="zmdi zmdi-check-circle"></i>
                    <h5 class="profile__content__heading">Personal Details</h5>

                    <div class="row">
                        <div class="col">
                            {!! Form::label('Title', 'Title') !!}
                            {!! Form::text('',$profile->title,['class'=>'form-control','readonly']) !!}
                            <span class="error_input">
                        <strong>{{ $errors->first('title') }}</strong>
                </span>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('First name','First name') !!}
                            {!! Form::text('',$profile->first_name,['class'=>'form-control','readonly']) !!}
                            <span class="error_input">
                       <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Last name','Last name') !!}
                            {!! Form::text('',$profile->last_name,['class'=>'form-control','readonly']) !!}
                            <span class="error_input">
                       <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Middle name','Middle name') !!}
                            {!! Form::text('',$profile->middle_name,['class'=>'form-control','readonly']) !!}
                            <span class="error_input">
                       <strong>{{ $errors->first('middle_name') }}</strong>
                    </span>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Username','Username (visible to other users)') !!}
                            {!! Form::text('user_name',$profile->user_name,['class'=>'form-control']) !!}
                            <span class="error_input">
                       <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('','Date Of Birth') !!}
                            {!! Form::text('',\App\Helpers\FormattedDate::format($profile->dob),['class'=>'form-control','readonly']) !!}
                            <span class="error_input">
                       <strong>{{ $errors->first('job_title') }}</strong>
                    </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('','Gender') !!}
                            {!! Form::text('',$profile->gender,['class'=>'form-control','readonly']) !!}
                            <span class="error_input">
                        <strong>{{ $errors->first('gender') }}</strong>
                </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('nationality','Nationality') !!}
                            {!! Form::text('',ucfirst($profile->nationality),['class'=>'form-control']) !!}
                            <span class="error_input">
                       <strong>{{ $errors->first('nationality') }}</strong>
                    </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>


                <div class="form-group pb-3">
                    <i class="zmdi zmdi-check-circle"></i>
                    <h5 class="profile__content__heading">Address Details</h5>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('country_residence','Country of Residence'.$profile->country_of_residence) !!}
                            {!! Form::text('',$profile->country_residence, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('country_residence') }}</strong>
                      </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('building_no',' Building No') !!}
                            {!! Form::text('',$profile->building_no, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('building_no') }}</strong>
                      </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('address_1','Address 1') !!}
                            {!! Form::text('address_1',$profile->address_1, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('address_1') }}</strong>
                      </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('address_2','Address 2') !!}
                            {!! Form::text('address_2',$profile->address_2, ['class' => 'form-control']) !!}
                            <span class="error_input">
                          <strong>{{ $errors->first('address_2') }}</strong>
                          </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('address_3','Address 3') !!}
                            {!! Form::text('address_3',$profile->address_3, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('address_3') }}</strong>
                      </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('town','Town / City') !!}
                            {!! Form::text('town',$profile->town, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('town') }}</strong>
                      </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('county','County / Region') !!}
                            {!! Form::text('county',$profile->county, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('county') }}</strong>
                      </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('post_code','Post Code') !!}
                            {!! Form::text('post_code',$profile->post_code, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('post_code') }}</strong>
                      </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-4">
                            {!! Form::label('code','Code') !!}
                            {!! Form::text('phone_code',$profile->phone_code, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('code') }}</strong>
                      </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('telephone','Telephone') !!}
                            {!! Form::text('telephone',$profile->phone, ['class' => 'form-control']) !!}
                            <span class="error_input">
                         <strong>{{ $errors->first('telephone') }}</strong>
                      </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>


                <div class="form-group pb-3">
                    <i class="zmdi zmdi-check-circle"></i>
                    <h5 class="profile__content__heading">Declaration for Sophisticated Investors</h5>
                    <p class="declaration">
                        The content of this promotion has not been approved by an authorised person within the
                        meaning of the Financial Services and Markets Act 2000. Relience on this promotion for
                        the purpose of engaging in any investment activity may expose an individual to a
                        significant risk of losing all of the property or othe assets invested.
                    </p>
                    <div class="row">
                        <div class="col">
                            <p>
                                <input type="checkbox" name="read_investors_declaration"
                                       value="1" {{$profile->read_investors_declaration ? 'checked' : ''}}>

                                I have read the sophisticated investor/ High Net Worth individual declaration form
                                and declare that I am a self-certified sophisticated investor for the purposes of
                                the Financial Services and Markets Act (Financial Promotion) Order 2005.<br>
                                <a href="" data-toggle="modal" data-target="#debitModal">Read sophistaceted investor / High Net Worth individual declaraton
                                    form.</a>
                            </p>
                            <span class="error_input">
                              <strong>{{ $errors->first('read_investors_declaration') }}</strong>
                          </span>
                        </div>
                    </div>
                </div>


                <div class="form-group pb-3">
                    <i class="zmdi zmdi-check-circle"></i>
                    <h5 class="profile__content__heading">Further details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Source of Funds') !!}
                            {!! Form::text('source_of_funds',$profile->source_of_funds, ['class' => 'form-control']) !!}
                            <span class="error_input">
                              <strong>{{ $errors->first('source_of_funds') }}</strong>
                          </span>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Job Title') !!}
                            {!! Form::text('job_title',$profile->job_title, ['class' => 'form-control']) !!}
                            <span class="error_input">
                              <strong>{{ $errors->first('job_title') }}</strong>
                      </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Employer name') !!}
                            {!! Form::text('employer_name',$profile->employer_name, ['class' => 'form-control']) !!}
                            <span class="error_input">
                              <strong>{{ $errors->first('employer_name') }}</strong>
                      </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Nature of employers business') !!}
                            {!! Form::text('nature_employers_business',$profile->nature_employers_business, ['class' => 'form-control']) !!}
                                
                            <!-- <select class="form-control" name="nature_employers_business">
                                <option value="">Select</option>
                                @foreach($professions as $profession)
                                    <option @if($profile->nature_employers_business) == $profession) selected="selected" @endif value="{{$profession}}">{{ucfirst($profession)}}</option>
                                @endforeach
                            </select> -->
                            <input type="text" class="d-none form-control" name="otherNatureOfEmployers" id="otherNatureOfEmployers">
                            <span class="error_input">
                        <strong>{{ $errors->first('nature_employers_business') }}</strong>
                    </span>

                        </div>
                        
                    </div>
                </div>

                

                <div class="form-group pb-3">
                    <i class="zmdi zmdi-check-circle"></i>

                    <h5 class="profile__content__heading">Identity Verification</h5>
                    Upload ID (Passport, Driver's license or other acceptable form of Photo ID)

                    @if($profile->user->identities()->exists())
                        <ul class="list-group mt-1">
                            @forelse($profile->user->identities as $identity)
                                <li class="list-group-item">
                                    <a href="{{route('download',['id'=>$identity->id,'action'=>'view'])}}" target="_blank">{{$identity->file_name}}</a>
                                    <a class="float-right" href="{{route('download',['id'=>$identity->id])}}">
                                        <span class="badge badge-primary badge-pill"><i class="fa fa-download"></i></span>
                                    </a>
                                </li>
                            @empty
                                No Identity uploaded
                            @endforelse
                        </ul>
                    @endif
                    <div class="input-group mb-3">
                        <div class="row ">
                            <div class="col-12">
                                {!! Form::label('','Identity') !!}
                            </div>
                            <div class="col-12">
                                {!! Form::file('identity') !!}
                            </div>
                            <span class="error_input">
                              <strong>{{ $errors->first('identity') }}</strong>
                          </span>
                        </div>
                    </div>
                    Upload proof of address (utility bill, council tax statement or bank or credit card
                    statement all of which must not be more than 3 months old).

                    @if($profile->user->proof_of_address()->exists())
                        <ul class="list-group">
                            @forelse($profile->user->proof_of_address as $address)
                                <li class="list-group-item">
                                    <a href="{{route('download',['id'=>$address->id,'action'=>'view'])}}" target="_blank">{{$address->file_name}}</a>
                                    <a class="float-right" href="{{route('download',['id'=>$address->id])}}">
                                        <span class="badge badge-primary badge-pill"><i class="fa fa-download"></i></span>
                                    </a>
                                </li> 
                            @empty
                                No Proof of Address uploaded
                            @endforelse
                        </ul>
                    @endif
                    <div class="input-group mb-3">
                        <div class="">

                            {!! Form::label('','Proof of Address') !!}
                            <br>
                            {!! Form::file('proof') !!}
                            <span class="error_input">
                              <strong>{{ $errors->first('location_of_business') }}</strong>
                      </span>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group pb-3">
                    <i class="zmdi zmdi-check-circle"></i>
                    <h5 class="profile__content__heading">Terms of Service</h5>
                    <div class="row">
                        <div class="col-md-1">
                            <input type="checkbox" name="agree" value="1"{{$profile->agree ? 'checked' : ''}}>
                        </div>
                        <div class="col">
                            I have read and agree to the terms and conditions of service<br>
                            <a href={{url('/terms')}}>Read Terms and Conditions and Agency Agreement.</a>
                            <span class="error_input">
                              <strong>{{ $errors->first('agree') }}</strong>
                      </span>
                        </div>
                    </div>

                    <button type="submit" class="float-right btn btn-dark btn-lg btn-danger">
                        {{ __('SAVE') }}
                    </button>
                </div>


            </div><!--end card body-->
            {!! Form::close() !!}
        </div> <!--end card-->
    </div>
    </div>

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
