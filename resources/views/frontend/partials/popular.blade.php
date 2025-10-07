@if(count($popular_shows) > 0)
@foreach($popular_shows as $show)
<div class="unbeatable-slider-wrap">
    <div class="unbeatable-slider-div">
        <div class="unbeatable-slider-img">
             <a href="{{ Storage::url($show->product_image) }}" data-lightbox="homePortfolio">
            <img src="{{ Storage::url($show->product_image) }}" alt="{{$show->img_alt_tag ?? ''}}" />
            </a>
        </div>
    </div>
</div>

@endforeach

@endif
