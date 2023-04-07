<div class="text-end pe-25">
    @if(!empty($row->hospital_rate))
        <p class="cur-margin">  {{ getCurrencySymbol().' '.$row->hospital_rate }}</p>
    @else
        N/A
    @endif    
</div>

