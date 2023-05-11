@extends('layouts.app')

@section('content')

    <div class="container pt-08 d-none" id="complexes-content">
        @include('complexes.filter')

        <div class="mb-3">
            Найдено: <span class="fw-500">{{ $complexes->total() }}</span>
        </div>
        <div class="row">
            @foreach($complexes as $complex)
                @include('complexes.complexes-card')
            @endforeach
        </div>

        <div class="row mt-02 mb-02">
            <div class="col-12">
                {{ $complexes->links() }}
            </div>
        </div>
    </div>

    <div id="complexes-preloader">
        <img src="/storage/img/eclipse.gif">
    </div>

    <script>
        let complexes = {!! $complexesForFilter !!};
        let developers = {!! $developersForFilter !!};
    </script>
@endsection
