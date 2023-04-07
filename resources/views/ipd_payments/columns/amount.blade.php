<div class="d-flex justify-content-end pe-25">
    @if($row->amount)
        <p class="cur-margin">{{ getCurrencySymbol().' '.number_format($row->amount )}}</p>
    @else
    {{ __('messages.common.n/a') }}
    @endif
</div>
