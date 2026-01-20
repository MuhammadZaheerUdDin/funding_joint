<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 09/11/2018
 * Time: 16:29
 */
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
.btn {
  background-color: #33b5e5;
  border: none;
  color: white;
  padding: 0px 4px;
  font-size: 16px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: DodgerBlue;
}
</style>
   @foreach($buyers as $buyer)
       <tr>
         <td style="padding: 10px;">{{$buyer->id}}</td>
         <td><a href="{!! url('buyers/show/') !!}/{!! $buyer->id !!}">{!! $buyer->first_name !!}&nbsp;{!! $buyer->last_name !!}</a>  </td>
         <td>{!! $buyer->email !!}</td>
         <td>{!! $buyer->phone !!}</td>
         <td>{!! $buyer->company_name !!}</td>
         <td>{!! $buyer->business_type !!}</td>
         @if($buyer->approved == 0)
           <td>Declined</td>
         @elseif($buyer->approved == 1)
           <td>Approved</td>
         @else
         <td>Pending</td>
         @endif
         @if(auth()->user()->user_type === 1)
         <td style="float: right;">
            <button class="btn" data-toggle="modal" data-target="#approveBuyer-{{$buyer->id}}" ><i class="fa fa-check" aria-hidden="true"></i></button>
            <button class="btn" data-toggle="modal" data-target="#declineBuyer-{{$buyer->id}}" ><i class="fa fa-close"></i></button>
            <!-- <button class="btn"><i class="fa fa-close"></i></button> -->
            <a class="btn" href="{{ url("/buyers/export/")  }}/{!! $buyer->id !!}" >
            <i class="fa fa-download"></i>
          </a>
          <!--  <button style="width: 117px!important;" data-toggle="modal" data-target="#declineBuyer-{{$buyer->id}}" class="declineBuyer btn {{  $buyer->approved == 2   ? 'btn-darkred disabled' : 'btn-darkred' }} decline-button m-0 w-50 waves-effect waves-light">Decline</button>
            <button style="width: 122px!important;" data-toggle="modal" data-target="#approveBuyer-{{$buyer->id}}" class="approveBuyer btn {{  $buyer->approved == 1   ? 'btn-primary disabled' : 'btn-primary' }}  approve-button m-0 w-50 waves-effect waves-light">Approve</button>
            <a style="width: 135px!important;" href="{{ url("/buyers/export/")  }}/{!! $buyer->id !!}" class="btn btn-outline-secondary m-0 w-100 export-button waves-effect waves-light">
            <i class="fa fa-download"></i>
            Export
          </a> -->
         </td>
         @endif

       </tr>
    </tbody>
       @endforeach

</table>

<br>

{!! $buyers->links() !!}

 @foreach($buyers as $buyer)
<!-- Approve Modal -->
<div class="modal fade" id="approveBuyer-{!! $buyer->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Approve Buyer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p class="text-center">
          Are you sure you want to approve {{$buyer->company_name ?: ' this buyer '}}?
        </p>

      </div>
      <div class="modal-footer">


        <button type="button" class="btn btn-secondary" style="background-color:transparent !important;color: black !important" data-dismiss="modal">
          Cancel
        </button>


        <form action="{{ url("buyers/approve/{$buyer->id}") }}" method="POST">
          @csrf

          <input type="hidden" name="id" value="{!! $buyer->id !!}">

          <button type="submit" class="btn btn-primary">
            Approve Buyer
          </button>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- Decline Modal -->
<div class="modal fade" id="declineBuyer-{!! $buyer->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for declining </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url("buyers/decline/{$buyer->id}") }}" method="POST">
        <div class="modal-body">


          <textarea name="message" class="form-control"></textarea>

          @csrf
          <input type="hidden" name="id" value="{!! $buyer->id !!}">
        </div>

        <div class="modal-footer">

          <button type="button" class="btn pull-left" style="background-color:transparent !important;color: black !important" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary ">Decline</button>

        </div>
      </form>
    </div>
  </div>
</div>
@endforeach