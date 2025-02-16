<tr>
    <td>
    </td>
    <td>
        @for ($i = 1; $i < $loop->depth; $i++)
            -
        @endfor
        {{ $child_category->category_name }}
    </td>
    <td>{{ $child_category->slug }}</td>
    <td>{{ $child_category->order }}</td>
    <td>
        @if ($child_category->status)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>

    <td>
        <form class="form-inline" method="post" action="{{ route('admin.category.destroy', $child_category->id) }}">
            @csrf
            @method('delete')
            <a href="{{ route('admin.category.edit', $child_category->id) }}" class="btn btn-secondary btn-xs mx-1"><i
                    class="fa fa-edit"> </i></a>
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-xs">
                <i class="fa fa-trash"></i>
            </button>
            </form>
    </td>


</tr>
@if ($child_category->categories)
    @foreach ($child_category->categories as $child_category)
        @include('backend/pages/category/recursive_child_category', ['child_category' => $child_category])
    @endforeach
@endif
