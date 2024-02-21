@if(count($popular_shows) > 0)
@foreach($popular_shows as $show)
<div class="unbeatable-slider-wrap">
    <div class="unbeatable-slider-div">
        <div class="unbeatable-slider-img">
            <img src="{{ Storage::url($show->product_image) }}" alt="" />
        </div>
    </div>
</div>

@endforeach

@endif