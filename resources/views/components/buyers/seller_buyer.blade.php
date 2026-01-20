<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 09/11/2018
 * Time: 16:29
 */
?>

<div class="card mt-3" >
  <div class="card-body p-0">
    <div class="row ">
      <div class="col-12 col-md-4 " onclick="window.location.href='{!! url('buyers/show/') !!}/{!! $buyer->id !!}'">
        <div class="px-3 pt-3 p-md-3">
          <h4 class="">{!! $buyer-> company_name !!}</h4>
          <p class="m-0 pb-1"><b>Company Registration Number</b> - {!! $buyer->company_registration !!}</p>
          <p class="m-0 pb-1"><b>Company Registration Date</b> - {!! $buyer->company_registration_date !!}</p>
          <p class="m-0 pb-1"><b>Company Website</b> -<a target="_blank" href="{!! $buyer->company_website !!}"> {!! $buyer->company_website !!}</a></p>
        </div>
      </div>
      <div class="col-12 col-md-4 border-left" onclick="window.location.href='{!! url('buyers/show/') !!}/{!! $buyer->id !!}'">
        <div class="px-3 pb-3 p-md-3">
          <h4 class="d-none"> </h4>
          <p class="m-0 pb-1" ><b>Business Type</b> : {!! $buyer-> business_type !!}</p>
          <p class="m-0 pb-1" ><b>Experian Rating</b> : {!! $buyer->experian_rating !!}
            <span class="experianrating__color {{strtolower($buyer->experian_rating)}}"></span>

          </p>

        </div>
      </div>
      <div class="col-12 col-md-4 py-2 py-md-100">
        <div class="btn-group w-100" role="group">


        </div>
      </div>

    </div>
  </div>

  <div class="card-footer">
    <p class="text-left m-0">
      @if ($buyer->approved == 1)
        {!! $buyer->updated_at->format('d/m/Y') !!} - Approved buyer
      @elseif ($buyer->approved == 2)
        {!! $buyer->updated_at->format('d/m/Y') !!} - Declined buyer
      @else
        {!! $buyer->updated_at->format('d/m/Y') !!} - Awaiting approval
      @endif
    </p>
  </div>

</div>
