
@if(count($top_10_shows) > 0)
@foreach($top_10_shows as $show)

<div class="shows-slider-wrap">
    <div class="shows-slider-box">
        <div class="shows-slider-img">
            <img src="{{ Storage::url($show->product_image) }}" alt="" />
            <div class="show-num">
                <h2>1</h2>
            </div>
        </div>
    </div>
</div>

@endforeach

@endif
