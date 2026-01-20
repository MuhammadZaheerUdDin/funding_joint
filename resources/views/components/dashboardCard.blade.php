<div class="dashboard__card h-100">


    @if( strlen($link) > 0  )

        <a href="{{$link!='#'?url('').$link:'#'}}">
            <div class="card pr-4 pl-4 pb-4 h-100">
                <span class="text-center dashboard__card__title">
                {{$title or 'Card Title'}}
                </span>
                <div class="dashboard__card__content text-center">
                    {{$content or 'Content'}}
                </div>
            </div>
        </a>
    @else
        <div class="card pr-4 pl-4 pb-4 h-100">
       <span class="text-center dashboard__card__title">
           {{$title or 'Card Title'}}
       </span>
            <div class="dashboard__card__content text-center">
                {{$content or 'Content'}}
            </div>
        </div>
    @endif
</div>
