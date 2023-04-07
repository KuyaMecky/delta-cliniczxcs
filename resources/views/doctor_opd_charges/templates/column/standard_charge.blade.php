<div class="d-flex justify-content-end pe-25 mt-4">
    @if(!empty($row->standard_charge))
        <p class="cur-margin">
            <span>{{getCurrencySymbol()}}</span> {{ number_format($row->standard_charge) }}
        </p>
    @else
        {{ __('messages.common.n/a')}}
    @endif    
</div>

