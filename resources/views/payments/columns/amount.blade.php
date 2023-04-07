<div class="text-end pe-22">
    @if(!empty($row->amount))
        {{ getCurrencySymbol().' '.number_format($row->amount) }}
    @else
    @endif    
</div>

