<div class="d-flex justify-content-end pe-22">
    @if(!empty($row->net_salary))
        {{ getCurrencySymbol().' '.$row->net_salary }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>
