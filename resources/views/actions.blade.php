<div class="row">
    <div class="col-9">
        Сортировать:
        <a href="{{ route('groups', [$path, 'order' => 'price_asc', 'size' => $size]) }}"
           class="{{ $order == 'price_asc' ? 'fw-bold' : '' }}"
        >
            По цене ↑
        </a>

        <span class="text-black-50">|</span>

        <a href="{{ route('groups', [$path, 'order' => 'price_desc', 'size' => $size]) }}"
           class="{{ $order == 'price_desc' ? 'fw-bold' : '' }}"
        >
            По цене ↓
        </a>

        <span class="text-black-50">|</span>

        <a href="{{ route('groups', [$path, 'order' => 'name_asc', 'size' => $size]) }}"
           class="{{ $order == 'name_asc' ? 'fw-bold' : '' }}"
        >
            По названию ↑
        </a>

        <span class="text-black-50">|</span>

        <a href="{{ route('groups', [$path, 'order' => 'name_desc', 'size' => $size]) }}"
           class="{{ $order == 'name_desc' ? 'fw-bold' : '' }}"
        >
            По названию ↓
        </a>
    </div>
    <div class="col-3 text-end">
        Выводить:
        @foreach([6, 12, 18] as $s)
            <a href="{{ route('groups', [$path, 'order' => $order, 'size' => $s]) }}"
               class="{{ $size == $s ? 'fw-bold' : '' }}"
            >
                {{ $s }}
            </a>
        @endforeach
    </div>
</div>
