<div class="row">
    <div class="col">
        <a href="{{ route('groups') }}">Главная</a>
        @foreach($product->group->getParents() as $group)
            → <a href="{{ route('groups', $group->getPath()) }}">{{ $group->name }}</a>
        @endforeach
    </div>
</div>
