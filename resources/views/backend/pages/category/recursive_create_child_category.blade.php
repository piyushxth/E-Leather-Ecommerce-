<option value="{{$child_category->id}}">
  
  @for ($i = 0; $i < $loop->depth; $i=$i+2)
    -
  @endfor
  {{ $child_category->category_name }}</option>
@if ($child_category->categories)
  
        @foreach ($child_category->categories as $childCategory)
            @include('backend/pages/category/recursive_create_child_category', ['child_category' => $childCategory])
        @endforeach
    
@endif