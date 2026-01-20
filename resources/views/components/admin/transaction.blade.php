<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 05/11/2018
 * Time: 10:47
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

  .newColor{
    background-color: #af2c8a;
  }
  </style>
<div class="transaction card mb-3">
    <div class="card-body">
        <div class="container-fluid">
            <table style="width: 100%; margin-left: 16px;">
        <thead>
          <tr>
            <th style="width: 15%;"><strong>Date / Time</strong></th>
            <th style="width: 10%;"><strong>Name</strong></th>
           {{--  <th style="width: 15%;"><strong>Email</strong></th> --}}
            <th style="width: 8%;"><strong>Type</strong></th>
            <th style="width: 10%;"><strong>Amount</strong></th>
            <th style="width: 10%;"><strong>Auction Id</strong></th>
            <th style="width: 10%;"><strong>Remarks</strong></th>
            <th style="width: 10%;"><strong>Status</strong></th>
            <th style="width: 15%;"><strong>Reference</strong></th>
            <th style="text-align: center;width: 10%"><strong>Actions</strong></th>
          </tr>
      </thead>

      <tbody>
             @foreach($transactions as $transaction)     
            <tr class="{{  $transaction->user_id == 1 ? "newColor" : "" }}">
                
                <td style="padding-top: 0.7rem;padding-bottom: 0.7rem;">{{$transaction->created_at->format('d/m/Y H:i:s')}}</td>
                <td>{{optional($transaction->user)->full_name != '' ? optional($transaction->user)->full_name : 'Buyers Payout'}}</td>
                {{-- <td>{{$transaction->user->email}}</td> --}}
                <td>{{ucfirst($transaction->type)}}</td>
                <td> £ @money($transaction->amount)</td>  
                <td> {{$transaction->auction_id}}</td> 
                <td> {{$transaction->remarks}}</td>                
                <td>{{ $transaction->status? ($transaction->status == 'Decline') ? 'Declined' : 'Complete'  :'Pending' }}</td>
                <td> {{$transaction->reference}}</td>
                <td style="text-align: center;">
                    @if($transaction->status == 'Complete' || $transaction->status == 'Decline' )
                        {{-- <a class="btn waves-effect waves-light" href="#"><i class="fa fa-check"></i></a>
                        <a class="btn waves-effect waves-light" href="#"><i class="fa fa-close"></i></a> --}}
                    @else
                        <a class="btn waves-effect waves-light" href="{{route('admin.transaction.confirm',['id'=>$transaction->id])}}"><i class="fa fa-check"></i></a>
                        <a class="btn waves-effect waves-light" href="{{route('admin.transaction.decline',['id'=>$transaction->id])}}"><i class="fa fa-close"></i></a>
                    @endif
                    
                    {{-- <a class="btn" href=""><i class="fa fa-download"></i></a> --}}
                    {{-- @if($transaction->confirmed ==0)
                    <a style="text-decoration:underline;color:#007bff;" data-toggle="modal" data-target="#transaction->{{$transaction->id}}">
                        Approve
                    </a>
                    @else
                        @if($transaction->type == \App\Model\Transaction::CREDIT)
                            <a style="text-decoration:underline;color:#007bff;" data-toggle="modal" data-target="#transaction->{{$transaction->id}}">
                                Details
                            </a>
                        @else
                            <a style="text-decoration:underline;color:#007bff;" data-toggle="modal" data-target="#transaction->{{$transaction->id}}" style="width: 150px !important;">
                                Details      
                            </a>
                        @endif
                    @endif --}}
                </td>
            <tr>           
    @endforeach
      </tbody>
</table>  
<br> 
            
        </div>
    </div>
   
</div>

 @foreach($transactions as $transaction)     

<!-- Modal -->
<div class="modal fade" id="transaction->{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="text-center">
                        <h3>
                            @if($transaction->type == 'credit')
                                Credit
                            @elseif($transaction->type == 'debit')
                                Debit
                            @else
                                {{camel_case($transaction->type)}}
                            @endif
                        </h3>
                        {{$transaction->created_at->format('d/m/Y H;i:s')}}
                    </div>

                    <div class="text-center">
                        {{-- <h3>{{$transaction->user->email}}</h3> --}}
                        {{-- {{$transaction->user->email}} --}}
                    </div>
                    {{-- <ul class="list-group list-group-flush">
                        <li class="list-group-item">Amount: £ @money($transaction->amount)</li>
                        <li class="list-group-item">Account No: {{$transaction->user->bankDetails->account_number}}</li>
                        <li class="list-group-item">Sort Code: {{$transaction->user->bankDetails->sort_code}}</li>
                        <li class="list-group-item">Reference: <strong>{{$transaction->reference}}</strong></li>
                    </ul> --}}
                    {{-- @if($transaction->confirmed ==0)
                        {!! Form::open(['url'=>route('admin.transaction.confirm',['id'=>$transaction->id])])!!}
                        <button type="submit" class="btn btn-block btn-primary mb-1">Approve</button>
                    {!! Form::close() !!}
                    @endif --}}
                    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

