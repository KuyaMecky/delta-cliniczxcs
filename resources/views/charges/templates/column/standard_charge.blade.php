<div class="text-end pe-25">
    @if(!empty($row->standard_charge))
        <p class="cur-margin">
            <span>{{getCurrencySymbol()}}</span> {{ number_format($row->standard_charge) }}
        </p>
    @else
        {{ __('messages.common.n/a')}}
    @endif    
</div>


