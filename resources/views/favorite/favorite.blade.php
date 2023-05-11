@extends('layouts.app')

@section('content')

    <div class="container pt-08">
        <div class="row">
            @foreach($complexes as $complex)
                @include('complexes.complexes-card')
            @endforeach
        </div>
    </div>

@endsection
