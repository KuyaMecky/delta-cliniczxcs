<div class="d-flex justify-content-end pe-4">
    @if(!empty($row->applied_charge))
        <p class="cur-margin">{{ getCurrencySymbol().' '.number_format($row->applied_charge) }}</p>
    @else
        {{ __('messages.common.n/a') }}
    @endif    
</div>

