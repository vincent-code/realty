@extends('layouts.app')

@section('content')
    <div class="container pt-08">
        <div class="row">
            <div class="col-12">
                @if (!empty($complex->developer))
                    <div class="grey-500">
                        <img src="/storage/img/check.svg" class="img-check"> {{ $complex->developer }}
                    </div>
                @endif
            </div>

            <div class="col-12 col-lg-9">
                <div class="fw-500 fs-01 grey-900 d-inline-block me-3">{{ $complex->name }}</div>
                <div class="grey-500 d-inline-block">
                    {{ is_null($complex->address) ? $complex->region : "$complex->region, $complex->address" }}
                </div>
            </div>

            <div class="col-12 col-lg-3 favorite-block">
                <div class="flex flex-no-wrap items-center justify-center px-3 favorite-icon{{ $isFavorite ? ' active' : null }}"
                     id="favorite-item" data-id="{{ $complex->complex_id }}">
                    {!! file_get_contents(env('APP_URL') . '/storage/img/heart.svg') !!}
                    <span class="ms-2" id="favorite-text">
                        {{ $isFavorite ? 'В избранном' : 'В избранное' }}
                    </span>
                </div>
            </div>

            <div class="col-12">
                <nav class="nav mt-3 mb-3 bg-01 pt-01 h-01">
                    <a class="nav-link nav-cust @if(Route::currentRouteName() == 'complex_detail.description') active @endif"
                       href="{{ route('complex_detail.description', ['id' => $complex->complex_id]) }}">Описание</a>
                    <a class="nav-link nav-cust @if(Route::currentRouteName() == 'complex_detail.apartments') active @endif"
                       href="{{ route('complex_detail.apartments', ['id' => $complex->complex_id]) }}">Квартиры</a>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" id="detail-content">
            @yield('complex_detail')
        </div>
        {{--<div id="detail-preloader">
            <img src="/storage/img/eclipse.gif">
        </div>--}}
    </div>

    <script>
        window.addEventListener('load', (event) => {
            document.getElementById('detail-content').style.opacity = 1;
        });
    </script>
@endsection
