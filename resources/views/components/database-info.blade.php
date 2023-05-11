<span class="fw-600">{{ $complexes }}</span> ЖК -
<span class="fw-600">{{ number_format($apartmentsCount, 0, '', '.') }}</span>
{{ declension($apartmentsCount) }}
<span class="data-upd">(обновлено {{ date_format($updatedAt, 'd.m.Y') }})</span>
