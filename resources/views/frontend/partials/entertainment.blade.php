<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="entertainment-head">
                <div class="heading-1 text-center">
                    <h2>{{ $home_cms->entertainment_title }}<span class="dot">.</span></span></h2>
                    <p>
                        {{ $home_cms->entertainment_description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="entertainment-img-div">
        <div class="row justify-content-center align-items-center">
            @foreach($entertainments as $entertainment)
            <div class="col-lg-3 col-md-6">
                <div class="entertainment-img-wrap">
                    <div class="entertainment-img">
                        <img src="{{ Storage::url($entertainment->image) }}" alt="{{$entertainment->image_alt_tag ?? ''}}" />
                    </div>
                    <div class="entertainment-img-text">
                        <h4>{{ $entertainment->image_name }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
