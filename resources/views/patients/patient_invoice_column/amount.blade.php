<div class="d-flex justify-content-end pe-25">
    <span>{{ getCurrencySymbol() }}</span>
    &nbsp;
    <span> {{ number_format($row->amount - ($row->amount * $row->discount / 100), 2) }} </span>    
</div>

