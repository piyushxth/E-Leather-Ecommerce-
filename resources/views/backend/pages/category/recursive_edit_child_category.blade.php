<option value="{{ $child_category->id }}"
  {{ ($edit_category->parent_id == $child_category->id)?'selected':'' }}>

  @for ($i = 0; $i < $loop->depth; $i++)
    -
    @endfor
    {{ $child_category->category_name }}
</option>
@if ($child_category->categories)
@foreach ($child_category->categories as $child_category)
@include('backend/pages/category/recursive_edit_child_category', [
'child_category' => $child_category,
'edit_category' => $editcategory
])
@endforeach
@endif