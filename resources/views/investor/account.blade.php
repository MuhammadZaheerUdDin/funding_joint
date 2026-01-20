<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 05/11/2018
 * Time: 08:39
 */

?>
@extends('layouts.admin.page')
@section('content')


    <div class="account">
        <h4 class="text-uppercase">My Account</h4>
        <hr>

        <div class="row">
            <div class="col-12">
                <div class="monies">
                    <div class="icon">
                        <img src="{{ asset('/assets/img/wallet-icon@2x.png') }}" alt="">
                    </div>
                    <div class="icon-right">
                        <p>Balance of Account</p>
                        <p>{{ \App\Helpers\FormattedDate::format(auth()->user()->balance->updated_at) }}</p>
                    </div>
                </div>
            </div>
            <div class="col text-right align-self-center">
                <h1>

                </h1>
            </div>
        </div>

        <div class="row py-3">
            @role('investor')
            <div class="col-12">
                <div class="btn-group w-100 " role="group" aria-label="Basic example">
                    <button type="button" class="btn w-25 btn-primary text-left" data-toggle="modal" data-target="#creditModal">Add
                        Funds
                    </button>&nbsp;&nbsp;
                    <button type="button" class="btn w-25 btn-primary  border-left border-white text-left" data-toggle="modal" data-target="#debitModal">Withdraw
                        Funds
                    </button>
                </div>
            </div>
            @endrole
            @role('seller')
            <div class="col">
                <button type="button" class="btn w-50 m-0 btn-primary" data-toggle="modal" data-target="#debitModal">Withdraw Funds
                </button>
            </div>
            @endrole
        </div>

        <span class="error_input">
            <strong>{{ $errors->first() }}</strong>
        </span>

        @include('components.users.transactions')

    </div>
    @role('investor')
    <!-- Credit Modal -->
    <div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content account__modal">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="modelTitleId">ADD FUNDS TO YOUR ACCOUNT</h4>
                   {{--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                    <hr>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <h8>You must have funds in your account before making investments. Enter an amount to add to your account and transfer this to Funding Joint's bank account below, ensuring you use the reference number given when making the bank transfer. We will credit your account when we receive funds. We cannot accept funds from any account other than the one you provided details of during registration</h8>
                            <br>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Account Balance</label>
                                    <input type="text" class="form-control" id="account_balance" readonly value="{{auth()->user()->balance->balance}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Proposed balance</label>
                                    <input type="text" class="form-control" id="proposed_balance" readonly value="{{auth()->user()->balance->balance}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <h5 class="account__modal__content__subtitle">Funding Joint Account details</h5>
                                <div class="form-group">
                                    <label for="">Account No.</label>
                                    <input type="text" class="form-control" readonly value="89908765">
                                </div>

                                <div class="form-group">
                                    <label for="">Sort Code</label>
                                    <input type="text" class="form-control" readonly value="89-90-87">
                                </div>

                                <div class="form-group">
                                    <label for="">Reference</label>
                                    <input type="text" class="form-control" readonly value="{{$newreference}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                {!! Form::open(['url'=>route('user.funds.deposit')]) !!}
                                <br>
                                <h5 class="account__modal__content__subtitle">Your BankAccount details</h5>
                                <div class="form-group">
                                    <label for="">Account No.</label>
                                    <input type="text" class="form-control"
                                           readonly value="{{$user->bankDetails->account_number}}">
                                </div>

                                <div class="form-group">
                                    <label for="">Sort Code</label>
                                    <input type="text" class="form-control" readonly value="{{$user->bankDetails->sort_code}}">
                                </div>

                                <div class="form-group">
                                    <label for="">Amount (£)</label>
                                    <input type="text" name="amount" id="amount" class="form-control" value="">
                                    <input type="hidden" name="reference" readonly value="{{$newreference}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endrole

    <!-- Debit Modal -->
    @if(count($user->bankDetails()->get()) > 0)
        <div class="modal fade" id="debitModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content account__modal">
                    <div class="modal-header">
                        <h4 class="modal-title text-center w-100" id="modelTitleId">WITHDRAW FUNDS FROM YOUR ACCOUNT</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <hr>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">

                                <div class="col-md-12">
                                    {!! Form::open(['url'=>route('user.funds.withdraw')]) !!}
                                    <h8>Enter the amount of funds you want to withdraw and we will transfer this to your bank account you provided during registration.  We cannot transfer funds to any other account.</h8>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="">Account Balance</label>
                                        <input type="text" class="form-control w-50" id="withdraw_balance" readonly value="{{auth()->user()->balance->balance}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Account No.</label>
                                        <input type="text" class="form-control w-50" readonly
                                               value="{{$user->bankDetails->account_number}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Sort Code</label>
                                        <input type="text" readonly class="form-control w-50" value="{{$user->bankDetails->sort_code}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Amount (£)</label>
                                        <input type="number" name="amount" id="withdraw_amount" class="form-control w-50" value="" min="1" required max="{{$user->balance_amount}}">
                                        <input type="hidden" name="reference" value="{{$newreference}}">
                                        <span class="error_input">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Proposed balance</label>
                                        <input type="text" class="form-control w-50" id="withdraw_proposed_balance" readonly value="{{auth()->user()->balance->balance}}">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="sumbit" class="btn btn-primary">Save</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="modal fade" id="debitModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content account__modal">
                    <div class="modal-body">
                        <p>
                            Please enter your <a href="{{url('enter-bank-details')}}">Bank Details</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        var withdraw_amount = document.getElementById('withdraw_amount');
        withdraw_amount.addEventListener('keyup', function(e)
        {   
            checkAmountWithdrawKeyup();
        }); 
        function checkAmountWithdrawKeyup(){
            account_balance = $("#withdraw_balance").val();
            amount = $("#withdraw_amount").val();
            
            if(amount > 0){
                $("#withdraw_proposed_balance").val(parseFloat(account_balance) - parseFloat(amount));
            }else{
                $("#withdraw_proposed_balance").val(parseFloat(account_balance));
            }
            
        }
      var amount = document.getElementById('amount');
      amount.addEventListener('keyup', function(e)
      {   
        checkAmountKeyup();
      }); 
      function checkAmountKeyup(){
        account_balance = $("#account_balance").val();
        amount = $("#amount").val();
        if(amount > 0){
            $("#proposed_balance").val(parseFloat(amount) + parseFloat(account_balance));
        }else{
            $("#proposed_balance").val(parseFloat(account_balance));
        }
        
          
      }

      

    </script>

@endsection
