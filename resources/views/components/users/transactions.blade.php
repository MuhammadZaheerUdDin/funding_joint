<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 07/11/2018
 * Time: 12:16
 */
?>

<div class="profile__content">
  <div class="row">
    <div class="col-8">
      <h4 class="text-uppercase mt-2">Transactions</h4>
    </div>
      <div class="col-4">
          <form>
              <select name="SortBy" class="form-control pull-right float-right">
                  <option value="all">All</option>
                  <option value="oldest">Oldest</option>
                  <option value="recent">Newest</option>
              </select>
          </form>
      </div>
  </div>
  <hr>
    @if(count($transactions) > 0)
    <table class="table table-responsive-sm table-striped w-100">
        <thead>
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>ID Number / Reference</th>
            <th>Amount</th>
            <th>Balance</th>
        </tr>
        </thead>
        <tbody>
          <tr></tr><!--toget the right stripe-->
        @foreach($transactions as $transaction)
            <tr @if(  app('request')->input('id') == $transaction->id ) style="background-color: #99c9fa;" @endif>
                <td scope="row">{{ \App\Helpers\FormattedDate::format($transaction->created_at->format('d.m.Y'))}}</td>
                <td>{{$transaction->description}}</td>
                <td>{{$transaction->id}} / {{$transaction->reference}}</td>
                <td>
                  {{-- {{$transaction->type==\App\Model\Transaction::CREDIT ? '+': '-' }} {{ utf8_encode(money_format('%n', $transaction->amount)) }} --}}
                  {{$transaction->type==\App\Model\Transaction::CREDIT ? '+': '-' }}{{$transaction->amount}}</td>
                <td>
                    @if($transaction->confirmed)
                        £ @money( $transaction->new_balance)
                    @else
                        @if($transaction->status == 'Decline')
                          <span class="badge badge-danger">Decline</span>
                        @else
                          <span class="badge badge-info">Pending Approval</span>
                        @endif
                        
                    @endif
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="alert alert-warning" style="width:50%"; role="alert">
            <strong>No transactions</strong>
        </div>
    @endif
</div>
