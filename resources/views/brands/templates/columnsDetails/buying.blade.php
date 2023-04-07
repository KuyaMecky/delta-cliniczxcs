<div class="d-flex justify-content-end pe-16">
    @if(!empty($row->buying_price))
        <p class="cur-margin">{{ getCurrencySymbol().' '.number_format($row->buying_price,2) }} </p>
    @else
        N/A
    @endif    
</div>

