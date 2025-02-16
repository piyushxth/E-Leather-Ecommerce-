<tr>
    <td>
    </td>
    <td>
        @for ($i = 1; $i < $loop->depth; $i++)
            -
        @endfor
        {{ $child_navbar->name }}
    </td>
    <td>{{ $child_navbar->route }}</td>
    <td>{{ $child_navbar->ordering }}</td>
    <td>
        @if ($child_navbar->status)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>

    <td>
        <form class="form-inline" method="post" action="{{ route('admin.navbar.destroy', $child_navbar->id) }}">
            @csrf
            @method('delete')
            <a href="{{ route('admin.navbar.edit', $child_navbar->id) }}" class="btn btn-secondary btn-xs mx-1"><i
                    class="fa fa-edit"> </i></a>
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-xs">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>


</tr>
@if ($child_navbar->navbars)
    @foreach ($child_navbar->navbars as $child_navbar)
        @include('backend/pages/navbar/recursive_child_navbar', ['child_navbar' => $child_navbar])
    @endforeach
@endif
