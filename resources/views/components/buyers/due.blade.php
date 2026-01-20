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
   @foreach($allBuyer as $buyer)
       <tr>
        @if(auth()->user()->user_type === 1 || auth()->user()->user_type === 3)
          <td style="padding: 10px;">{{$buyer->auction->seller->company_name}}</td>
        @endif
          <td> {{$buyer->auction_id}}  </td>
          <td>{!! $buyer->auction->buyer->company_name !!}</td>
          <td>{!! $buyer->auction->buyer->email !!}</td>
          <td>{!! $buyer->auction->buyer->phone !!}</td>
          <td>{{ \App\Helpers\FormattedDate::format($buyer->invoice_repayment_due_date)}} </td>
          <td>{{$buyer->outstanding_balance}}</td>
          <td>{{$buyer->overdue_days}}</td>
         

       </tr>
    </tbody>
       @endforeach

</table>