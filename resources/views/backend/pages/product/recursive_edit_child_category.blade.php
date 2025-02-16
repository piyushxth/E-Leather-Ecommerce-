<option value="{{ $child_category->id }}" @if ($product->category->contains($child_category->id))
    selected
    @endif
    >

    @for ($i = 0; $i < $loop->depth; $i++)
        -
    @endfor
    {{ $child_category->category_name }}
</option>
@if ($child_category->categories)
    @foreach ($child_category->categories as $child_category)
        @include('backend/pages/product/recursive_edit_child_category', [
        'child_category' => $child_category,
        'product' => $product
        ])
    @endforeach
@endif
