<div class="d-flex justify-content-end pe-25">
    @if(!empty($row->amount))
        {{ getCurrencySymbol().' '.number_format($row->amount) }}
            @else
                N/A
    @endif    
</div>

