<div class="col-12 col-lg-3 complex-card" style="position: relative">
    <div class="complex-card__img" style="background: url({{ asset(json_decode($complex->image)[0]) }}) no-repeat center center; background-size: cover;">
        <a href="{{ route('complex_detail.description', ['id' => $complex->complex_id]) }}" class="complex-card__img-link"></a>
    </div>

    <div class="complex-card__favorite-icon{{ !is_null($favoriteIds) && in_array($complex->complex_id, $favoriteIds) ? ' active' : null }}"
         data-id="{{ $complex->complex_id }}">
        {!! file_get_contents(env('APP_URL') . '/storage/img/heart.svg') !!}
    </div>

    <div class="complex-card__body">
        <div class="grey-900 truncate">{{ $complex->developer }}</div>

        <div class="truncate">
            <a href="{{ route('complex_detail.description', ['id' => $complex->complex_id]) }}" class="complex-card__complex-name">
                {{ $complex->name }}
            </a>
        </div>

        <div class="grey-900 truncate">{{ $complex->address }}</div>

        <div class="complex-card__body-info">
            @foreach($apartmentTypes as $item)
                @php
                    $type = ($item->type_id == 8) ? 'studio' : $item->type_id;
                    $price = "min_price_$type";
                    $square = "min_square_$type";
                @endphp
                @if (!is_null($complex->$price))
                    <a href="{{ route('complex_detail.apartments', ['id' => $complex->complex_id]) }}">
                        <div class="complex-card__apartment-info">
                            <div class="d-inline-block grey-200">
                                {{ $item->name }} от {{ round($complex->$square) }} м<sup>2</sup>
                            </div>
                            <div class="d-inline-block float-end">
                                от {{ number_format(round($complex->$price / 10**6, 1), 1) }} млн ₽
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>

        <div class="complex-card__apartment-count">
            <a href="{{ route('complex_detail.apartments', ['id' => $complex->complex_id]) }}">
                {{ $complex->apartment_count . ' ' . declension($complex->apartment_count) }}
            </a>
        </div>
    </div>
</div>
