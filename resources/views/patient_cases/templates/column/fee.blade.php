<div class="text-end pe-22">
    @if(!empty($row->fee))
        <p class="cur-margin">{{ getCurrencySymbol().' '.number_format($row->fee) }} </p>
    @else
        N/A
    @endif    
</div>

