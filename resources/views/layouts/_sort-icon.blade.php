@if ($sortBy !== $field)
    <i class="fas fa-sort float-right"></i>
@elseif ($sortDirection == 'asc')
    <i class="text-blue-700 fas fa-sort-alpha-up float-right"></i>
@else
    <i class="text-blue-700 fas fa-sort-alpha-down-alt float-right"></i>
@endif