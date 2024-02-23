
@foreach($products as $product)

<div class="unbeatable-slider-wrap">
    <div class="unbeatable-slider-div">
        <div class="unbeatable-slider-img">
            <img src="{{ Storage::url($product->product_image) }}" alt="" />
        </div>
    </div>
</div>

@endforeach