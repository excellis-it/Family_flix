@if (count($products) == 0)
    <tr>
        <td colspan="5" class="text-center">No Product found</td>
    </tr>
@else
    @foreach ($products as $key => $product)
        <tr class="tableRow" data-id="{{ $product->id }}">
            <td>{{ $product->type }}</td>
            <td>
                <img src="{{ Storage::url($product->product_image) }}" alt="{{ $product->name }}"
                    class="img-fluid" style="max-width: 100px;">
            </td>
            <td>
                <div class="button-switch">
                    <input type="checkbox" id="switch-orange" class="switch toggle-class" data-id="{{ $product->id }}"{{ $product->top_10_status ? 'checked' : ''}}/>
                    <label for="switch-orange" class="lbl-off"></label>
                    <label for="switch-orange" class="lbl-on"></label>
                </div>
            </td>
            <td>
                <div class="button-switch">
                    <input type="checkbox" id="switch-orange" class="switch toggle-class-popular" data-id="{{ $product->id }}"{{  $product->popular_status ? 'checked' :''}}>
                    <label for="switch-orange" class="lbl-off"></label>
                    <label for="switch-orange" class="lbl-on"></label>
                </div>
            </td>
            <td>
                <div class="button-switch">
                    <input type="checkbox" id="switch-orange" class="switch toggle-class-unbeatable" data-id="{{ $product->id }}"{{ $product->unbeatable_status ? 'checked': ''}} />
                    <label for="switch-orange" class="lbl-off"></label>
                    <label for="switch-orange" class="lbl-on"></label>
                </div>
            </td>
            
            <td>
                <a href="{{ route('products.edit', $product->id) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                <a title="Delete Product" data-route="{{ route('delete.products', $product->id) }}" class="delete_acma"
                    href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>

            </td>
        </tr>
    @endforeach
 
<tr class="toxic">
    <td colspan="6" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $products->links() !!}
            </div>
            <div>(Showing {{ $products->firstItem() }} – {{ $products->lastItem() }} products of
                {{ $products->total() }} products)</div>
        </div>
    </td>
</tr>
@endif


