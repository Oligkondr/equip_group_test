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
            adwadw
        </div>
    </div>
@endsection
