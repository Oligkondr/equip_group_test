@extends('layout')

@section('content')
    @include('breadcrumbs')
    <div class="row mt-4">
        <div class="col">
            <h1>{{ $product->name }}</h1>
            <h3>Цена: {{ $product->price->price }} руб.</h3>
        </div>
    </div>
@endsection
