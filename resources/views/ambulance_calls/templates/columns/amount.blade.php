<div class="text-end pe-25">
    @if($row->amount)
        <p class="cur-margin">{{ getCurrencySymbol().' '.$row->amount }}</p>
    @else
        N/A
    @endif    
</div>

