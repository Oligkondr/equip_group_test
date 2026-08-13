<li>
    @if(in_array($group->id, $pathList))
        <a href="{{ route('groups', $group->getPath()) }}" class="fw-bold">
            {{ $group->name }} ({{ $group->getCount() }})
        </a>
        @if($group->childrenRecursive->isNotEmpty())
            <ul>
                @foreach($group->childrenRecursive as $child)
                    @include('tree', ['group' => $child])
                @endforeach
            </ul>
        @endif
    @else
        <a href="{{ route('groups', $group->getPath()) }}">
            {{ $group->name }} ({{ $group->getCount() }})
        </a>
    @endif
</li>
