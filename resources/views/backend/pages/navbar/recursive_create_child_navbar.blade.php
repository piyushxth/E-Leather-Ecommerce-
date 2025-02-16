<option value="{{ $child_navbar->id }}">

    @for ($i = 0; $i < $loop->depth; $i = $i + 2)
        -
    @endfor
    {{ $child_navbar->name }}
</option>
@if ($child_navbar->navbars)

    @foreach ($child_navbar->navbars as $childNavbar)
        @include('backend/pages/navbar/recursive_create_child_navbar', ['child_navbar' => $childNavbar])
    @endforeach

@endif
