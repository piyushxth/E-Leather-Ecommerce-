<option value="{{ $child_navbar->id }}" {{ $navbar->parent_id == $child_navbar->id ? 'selected' : '' }}>

    @for ($i = 0; $i < $loop->depth; $i++)
        -
    @endfor
    {{ $child_navbar->name }}
</option>
@if ($child_navbar->navbars)
    @foreach ($child_navbar->navbars as $child_navbar)
        @include('backend/pages/navbar/recursive_edit_child_navbar', [
        'child_navbar' => $child_navbar,
        'navbar' => $navbar
        ])
    @endforeach
@endif
