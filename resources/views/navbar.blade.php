<div class="container-fluid database-info">
    <div class="row">
        <div class="col-12">
            <x-database-info/>
        </div>
    </div>
</div>

<header class="navbar-custom">
    <div class="container">
        <div class="row nav h-02">
            <div class="col-8 nav-desc">
                <div class="row justify-content-left align-items-center h-100"> {{--justify-content-center--}}
                    <div class="col-2 nav-item" style="width: 100px">
                        <a href="{{ route('home') }}" class="nav-links">Главная</a>
                    </div>
                    <div class="col-2 nav-item" style="width: 150px">
                        <a href="{{ route('complexes') }}" class="nav-links">Новостройки</a>
                    </div>
                </div>
            </div>
            <div class="col-4 nav-favorite" id="favorite">
                <a href="{{ route('favorite') }}" id="favorite-link" class="nav-links">
                    Избранное
                    {!! file_get_contents(env('APP_URL') . '/storage/img/heart-red.svg') !!}
                    <span class="fw-500" id="favorite-count">
                        @if(!is_null($favoriteIds = \App\Services\FavoriteService::getFavoriteIds()))
                            {{ count($favoriteIds) }}
                        @endif
                    </span>
                </a>
            </div>
            <div class="col-1 nav-mob ms-auto">
                <div class="row justify-content-end align-items-center h-100 me-5">
                    <div class="col-12 nav-mobile">
                        {!! file_get_contents(env('APP_URL') . '/storage/img/bars.svg') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu animate__animated animate__fadeInRight hide">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('home') }}" class="mobile-item">Главная</a>
                </div>
                <div class="col-12">
                    <a href="{{ route('complexes') }}" class="mobile-item">Новостройки</a>
                </div>
            </div>
        </div>
    </div>
</header>
