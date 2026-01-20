<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 29/10/2018
 * Time: 17:26
 */
?>
@section('fixed-content')
<!-- <div class="bg-dark sticky-bar">
      <div class="profile__admin__actions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 text-center text-sm-left">
                    <a href="{{ url('users/export')  }}/{{$profile->user->id}}" class="btn btn-outline-white">
                        <i class="fa fa-download"></i> Export
                    </a>

                    <a href="{{url('admin/edit/seller')}}/{!! $profile->id !!}" class="btn btn-outline-white"><i class="fa fa-edit"></i> Edit </a>

                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="text-center float-sm-right" role="group" aria-label="Basic example">
                        <a href="{{ route('approve-user',[$profile->user->id,2] ) }}"
                           class="btn btn-outline-white {{  $profile->user->approved == 2   ? 'disabled' : '' }}">Decline</a>
                          @php
                          $i = 1;
                          @endphp
                        <a href="{{ route('approve-user',[$profile->user->id,$i] ) }}"
                           class="btn btn-white {{ ( $profile->user->approved === 1) ? 'disabled' : '' }}">Approve</a>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group d-md-inline-block">
                        {!! Form::open(['url' =>route('admin.editUser.ER',['UserType'=>'investor','id'=>$profile->id])])!!}
                        {!! Form::label('','Set Experian Rating',['class'=>'text-white d-block d-md-none']) !!}
                        <select name="experian_rating" class="custom-select mb-2 mr-sm-2 mb-sm-0" onchange="this.form.submit();">
                            <option value="">Experian rating</option>
                            <option @if( $profile->experian_rating==="Excellent") selected @endif value="Excellent">
                                Excellent
                            </option>
                            <option @if( $profile->experian_rating==="Good") selected @endif value="Good">Good</option>
                            <option @if( $profile->experian_rating==="Fair") selected @endif value="Fair">Fair</option>
                            <option @if( $profile->experian_rating==="Poor") selected @endif value="Poor">Poor</option>
                            <option @if( $profile->experian_rating==="Very Poor") selected @endif value="Very Poor">Very
                                Poor
                            </option>
                        </select>
                        <span class="error_input">
                          <strong>{{ $errors->first('experian_rating') }}</strong>
                      </span>
                        {!! Form::close() !!}

                    </div>
                    <div class="form-group d-md-inline-block">
                        {!! Form::open(['url' =>route('admin.editUser.CL',['UserType'=>'seller','id'=>$profile->id])])!!}
                        {!! Form::label('','Set Credit Limit',['class'=>'text-white d-block d-md-none']) !!}
                        <select name="credit_limit" class="custom-select mb-2 mr-sm-2 mb-sm-0" onchange="this.form.submit();">
                            <option value="">Credit Limit</option>
                            <option @if( $profile->credit_limit==="£0 - 1000") selected @endif value="£0 - 1000">
                                £0 - 1000
                            </option>
                            <option @if( $profile->credit_limit==="£1000 - 10,000") selected @endif value=" £1000 - 10,000">
                                £1000 - 10,000
                            </option>
                            <option @if( $profile->credit_limit==="£10,000 - 50,000") selected @endif value="£10,000 - 50,000">£10,000 - 50,000</option>
                            <option @if( $profile->credit_limit==="50,000+") selected @endif value="50,000+">£50,000+</option>
                        </select>
                        <span class="error_input">
                          <strong>{{ $errors->first('credit_limit') }}</strong>
                      </span>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
      </div>
</div> -->
@endsection
