@extends('complex_detail.complex')

@section('complex_detail')
    @foreach($apartments as $apartment)
        @include('complex_detail.apartment-card')
    @endforeach
    {{ $apartments->links() }}
@endsection
