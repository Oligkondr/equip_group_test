<li>
    @if(in_array($group->id, $path))
        <a href="{{ route('groups', $group->getPath()) }}" class="fw-bold">{{ $group->name }}</a>
        @if($group->childrenRecursive->isNotEmpty())
            <ul>
                @foreach($group->childrenRecursive as $child)
                    @include('tree', ['group' => $child])
                @endforeach
            </ul>
        @endif
    @else
        <a href="{{ route('groups', $group->getPath()) }}">{{ $group->name }}</a>
    @endif
</li>
