
@foreach($products as $product)

<div class="unbeatable-slider-wrap">
    <div class="unbeatable-slider-div">
        <div class="unbeatable-slider-img">
            <a href="{{ Storage::url($product->product_image) }}" data-lightbox="homePortfolio">
                <img src="{{ Storage::url($product->product_image) }}" alt="" />
            </a>
        </div>
    </div>
</div>

@endforeach



    
 