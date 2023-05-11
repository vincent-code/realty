<form action="{{ route('complexes') }}" method="POST">
    <div class="row">
        @csrf

        <div class="col-12 col-lg-6 mb-3">
            <label for="selectPage" class="form-label">Название ЖК</label>
            <input type="text" id="selectPageComplex" name="complex_or_developer[complex_id]" class="form-control"
                   value="{{ $filters['complex_or_developer']['complex_id'] ?? '' }}">
        </div>

        <div class="col-12 col-lg-6 mb-3">
            <label for="selectPage" class="form-label">Название Застройщика</label>
            <input type="text" id="selectPageDeveloper" name="complex_or_developer[developer_id]" class="form-control"
                   value="{{ $filters['complex_or_developer']['developer_id'] ?? '' }}">
        </div>

        <div class="col-12 col-lg-3">
            <div class="btn-group mb-3 w-100" role="group" aria-label="Basic checkbox toggle button group">
                @foreach($apartmentTypes as $item)
                    <input type="checkbox" class="btn-check filters" name="apartment_exists[]" autocomplete="off"
                           value="{{ $item->type_id }}" id="btncheck{{ $item->type_id }}"
                           @if(isset($filters['apartment_exists']) &&
                                array_search($item->type_id, $filters['apartment_exists']) !== false)
                               {{ 'checked' }}
                           @endif>
                    <label class="btn btn-outline-secondary" for="btncheck{{ $item->type_id }}">
                        {{ $item->type_id == 8 ? $item->name : ($item->type_id == 3 ? $item->type_id . '+' : $item->type_id) }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="input-group mb-3">
                <span class="input-group-text">Площадь, м<sup>2</sup></span>
                <input type="text" name="square_from" class="form-control filters" placeholder="от"
                       value="{{ $filters['square_from'] ?? '' }}">
                <input type="text" name="square_to" class="form-control filters" placeholder="до"
                       value="{{ $filters['square_to'] ?? '' }}">
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="input-group mb-3">
                <span class="input-group-text">Стоимость, ₽</span>
                <input type="text" name="price_from" class="form-control filters" placeholder="от"
                       onblur="this.value = this.value.replace(/[^\d]/g, '').replace(/\B(?=(?:\d{3})+(?!\d))/g, ' ')"
                       onfocus="this.value = this.value.replace(/\s/g, '')"
                       value="{{ $filters['price_from'] ?? '' }}">
                <input type="text" name="price_to" class="form-control filters" placeholder="до"
                       onblur="this.value = this.value.replace(/[^\d]/g, '').replace(/\B(?=(?:\d{3})+(?!\d))/g, ' ')"
                       onfocus="this.value = this.value.replace(/\s/g, '')"
                       value="{{ $filters['price_to'] ?? '' }}">
            </div>
        </div>

        <div class="col-6 col-lg-2">
            <button type="submit" class="btn btn-primary mb-3" disabled>
                Показать <span class="fw-500" id="search-count"></span>
            </button>
            <div id="filter-clear" class="{{ ! empty($filters) ?: 'disabled' }}">очистить</div>
        </div>

    </div>
</form>
