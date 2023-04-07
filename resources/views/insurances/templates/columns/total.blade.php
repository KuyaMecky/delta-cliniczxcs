<div class="text-end pe-25">
    @if(!empty($row->total))
        <p class="cur-margin">  {{ getCurrencySymbol().' '.$row->total }}</p>
    @else
        N/A
    @endif    
</div>

