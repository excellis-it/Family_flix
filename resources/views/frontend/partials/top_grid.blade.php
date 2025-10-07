
@foreach($top_grids as $top_grid)
<div class="col-lg-3 col-md-6">
    <div class="access-div-img-wrap">
        <div class="access-div-img">
            <img src="{{ Storage::url($top_grid->icon) }}" alt="{{$top_grid->img_alt_tag ?? ''}}" />
        </div>
        <div class="access-div-text">
            <h4>{{ $top_grid->title }}</h4>
            <p>
                {{  $top_grid->description }}
            </p>
        </div>
    </div>
</div>
@endforeach
