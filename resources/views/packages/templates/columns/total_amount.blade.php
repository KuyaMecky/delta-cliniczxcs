<div class="text-end pe-25">
    @if(!empty($row->total_amount))
        <p class="cur-margin">  {{ getCurrencySymbol().' '.$row->total_amount }}</p>
    @else
        N/A
    @endif    
</div>

