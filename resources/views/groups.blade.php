@extends('layout')

@section('content')
    <div class="row">
        <div class="col-4">
            <ul>
                @foreach($groups as $group)
                    @include('tree')
                @endforeach
            </ul>
        </div>
        <div class="col-8">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">{{ $product->name }}</div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
