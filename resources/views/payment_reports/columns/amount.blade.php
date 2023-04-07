<div class="d-flex justify-content-end pe-25">
    @if(!empty($row->amount))
        <p class="cur-margin">{{ getCurrencySymbol().' '.number_format($row->amount) }}</p>
    @else
        N/A
    @endif    
</div>

