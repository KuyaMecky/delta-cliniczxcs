@if(!empty($row->net_salary))
    {{ getCurrencySymbol().' '.number_format($row->net_salary) }}
@else
    N/A
@endif
