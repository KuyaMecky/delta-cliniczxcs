<div class="text-end pe-16">
    @if(!empty($row->selling_price))
        <p class="cur-margin">{{ getCurrencySymbol().' '.number_format($row->selling_price) }} </p>
    @else
        N/A
    @endif    
</div>

