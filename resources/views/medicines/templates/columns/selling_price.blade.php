<div class="text-end pe-25">
    @if($row->selling_price)
        <p class="cur-margin"> {{getCurrencySymbol() . " " . $row->selling_price}}
    @else
        {{__('messages.common.n/a')}}
    @endif    
</div>

