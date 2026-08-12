<li>
    @if(in_array($group->id, $path))
        <span>{{ $group->name }}</span>
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
