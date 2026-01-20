@extends('layouts.frontPage.page')


@section('content')
    <div class="container faq-container">

    <h1>FAQ</h1>

    <div class="accordion" id="accordionExample">
        @foreach($faqs as $key =>  $fq)
        <div class="card" style="margin-bottom: 1vh">
            <div class="card-header" id="heading{!! $fq->id !!}">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{!! $fq->id !!}"
                            aria-expanded="true" aria-controls="collapse{!! $fq->id !!}">
                        {!! $fq->title !!}
                    </button>
                </h5>
            </div>

            <div id="collapse{!! $fq->id !!}" class="collapse <?php if($key == 0): echo 'show'; endif?>" aria-labelledby="heading{!! $fq->id !!}" data-parent="#accordionExample">
                <div class="card-body">
                    {!! $fq->content !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection