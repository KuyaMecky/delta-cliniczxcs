<div class="text-end pe-4">
    @if(!empty($row->standard_charge))
        <p class="cur-margin">{{ getCurrencySymbol().' '.number_format($row->standard_charge) }}</p>
    @else
        {{ __('messages.common.n/a') }}
    @endif    
</div>

