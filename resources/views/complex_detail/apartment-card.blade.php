<div class="col-12 col-lg-3 text-center mb-3">
    <div class="apartment-card rounded">
        <div class="container-img p-3">
            <img src="{{ $apartment->plan }}" class="d-block apartment-img">
        </div>

        <div class="fs-02 fw-500">{{ $apartment->apartment_type . ' ' . $apartment->square }} м<sup>2</sup></div>
        <div>
            {{ number_format($apartment->price, 0, '', ' ') }} ₽ •
            {{ number_format($apartment->price / $apartment->square, 0, '', ' ') }} ₽/м<sup>2</sup>
        </div>
        <div>
            {{ $apartment->building_queue }} оч., корп. {{ $apartment->building_name }},
            {{ $apartment->floor }} этаж из {{ $apartment->floors }}
        </div>
    </div>
</div>
