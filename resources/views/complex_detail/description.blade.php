@extends('complex_detail.complex')

@section('complex_detail')
    <div class="col-12 col-lg-7 text-center">
        @if ($complex->image = json_decode($complex->image))
            <div class="f-carousel carousel-h" id="complex-carousel">
                @foreach ($complex->image as $key => $path)
                    <div class="f-carousel__slide" data-thumb-src="{{ $path }}">
                        <img src="{{ $path }}" class="carousel-h">
                    </div>
                @endforeach
            </div>
        @else
            <img src="/storage/img/camera-solid.svg" width="120">
        @endif
    </div>

    @if ($complex->coordinates = json_decode($complex->coordinates))
        <div class="col-12 col-lg-5 text-center mx-auto mb-auto">
            <div id="map" class="h-05" data-x="{{ $complex->coordinates[1] }}"
                 data-y="{{ $complex->coordinates[0] }}"
                 data-name="{{ $complex->name }}"></div>
        </div>
    @endif

    <div class="col-12 col-lg-7 mt-3 mb-3">
        {!! $complex->description !!}
    </div>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    @vite('resources/js/fancybox.js')
    @vite('resources/js/yandex_maps.js')
@endsection
