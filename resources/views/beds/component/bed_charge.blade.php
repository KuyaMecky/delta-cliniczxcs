<div class="d-flex justify-content-end pe-25">
    @if(!Empty($row->charge))
        {{getCurrencySymbol().' '.number_format($row->charge)}}
    @else
        N/A
    @endif    
</div>

