@extends('layout')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <ul>
                @foreach($groups as $group)
                    @include('groups.item')
                @endforeach
            </ul>
        </div>

        <div class="col-12 col-lg-9">
            @include('groups.actions')

            <div class="row mt-2">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <div>
                                <a href="{{ route('product', [$product->id]) }}">
                                    {{ $product->name }}
                                </a>
                            </div>
                            <div class="mt-2 border-top">{{$product->price->price}} руб.</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
