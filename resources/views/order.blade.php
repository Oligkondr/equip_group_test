<div class="row">
    <div class="col">
        Сортировать:
        <a href="{{ route('groups', [$path, 'order' => 'price_asc']) }}"
           class="{{ $order == 'price_asc' ? 'fw-bold' : '' }}"
        >
            По цене ↑
        </a>

        <span class="text-black-50">|</span>

        <a href="{{ route('groups', [$path, 'order' => 'price_desc']) }}"
           class="{{ $order == 'price_desc' ? 'fw-bold' : '' }}"
        >
            По цене ↓
        </a>

        <span class="text-black-50">|</span>

        <a href="{{ route('groups', [$path, 'order' => 'name_asc']) }}"
           class="{{ $order == 'name_asc' ? 'fw-bold' : '' }}"
        >
            По названию ↑
        </a>

        <span class="text-black-50">|</span>

        <a href="{{ route('groups', [$path, 'order' => 'name_desc']) }}"
           class="{{ $order == 'name_desc' ? 'fw-bold' : '' }}"
        >
            По названию ↓
        </a>
    </div>
</div>
