<div class="text-end pe-25">
    @if($row->purchase_price)
        <p class="cur-margin"> {{getCurrencySymbol() . " " . $row->purchase_price}}
    @else
        {{__('messages.common.n/a')}}
    @endif    
</div>

