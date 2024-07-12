<li>
    {{ $category->name }}
    
    @if ($category->children)
        <ul>
            @foreach ($category->children as $child)
                @include('categories.partials.category', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>
