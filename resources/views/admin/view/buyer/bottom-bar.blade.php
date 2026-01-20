<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 29/10/2018
 * Time: 17:26
 */
?>
@section('fixed-content')

    <div class="profile__admin__actions bg-dark sticky-bar">

        <div class="row">
            <!-- <a href="{{ url("/buyers/export/")  }}/{!! $buyer->id !!}" class="btn btn-outline-primary"> -->
            <a href="{{route('buyers.export',$buyer->id) }}" class="btn btn-outline-primary">
                <i class="fa fa-download"></i>
                Export
            </a>

            <a href="{{route('buyers.edit',$buyer->id)}}" type="submit" class="btn btn-outline-primary"><i class="fa fa-edit"></i>
            <!-- <a href="/buyers/edit/{!! $buyer->id !!}" type="submit" class="btn btn-outline-primary"><i class="fa fa-edit"></i> -->
                Edit</a>
            <div class="float-right" role="group" aria-label="Basic example">
                <a data-toggle="modal" data-target="#declineBuyer-{{$buyer->id}}" href="/buyers/decline/{{$buyer->id}}"
                   class="btn btn-darkred {{  $buyer->approved == 2   ? 'disabled' : '' }}">Decline</a>
                <a data-toggle="modal" data-target="#approveBuyer-{{$buyer->id}}" href="/buyers/approve/{{$buyer->id}}"
                   class="btn btn-primary {{ ( $buyer->approved === 1) ? 'disabled' : '' }}">Approve</a>
            </div>

            <div class="form--group float-right">
                {!! Form::open(['url' =>route('buyers.edit-rating',['id'=>$buyer->id])])!!}
                <select name="experian_rating" class="custom-select mb-2 mr-sm-2 mb-sm-0" onchange="this.form.submit();">
                    <option value="">Experian rating</option>
                    <option @if( $buyer->experian_rating==="Excellent") selected @endif value="Excellent">
                        Excellent
                    </option>
                    <option @if( $buyer->experian_rating==="Good") selected @endif value="Good">Good</option>
                    <option @if( $buyer->experian_rating==="Fair") selected @endif value="Fair">Fair</option>
                    <option @if( $buyer->experian_rating==="Poor") selected @endif value="Poor">Poor</option>
                    <option @if( $buyer->experian_rating==="Very Poor") selected @endif value="Very Poor">Very
                        Poor
                    </option>
                </select>
                <span class="error_input">
                    <strong>{{ $errors->first('experian_rating') }}</strong>
                </span>
                {!! Form::close() !!}

            </div>
        </div>
    </div>


@endsection