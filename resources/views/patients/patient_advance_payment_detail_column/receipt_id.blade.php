@if(!Auth::user()->hasRole('Patient|Nurse|Case Manager|Secretary|Doctor|Receptionist'))
    <a href="{{url('advanced-payments', $row->id)}}"><span
                class="badge bg-light-info">{{ $row->receipt_no }}</span></a>
@else
    <span
            class="badge bg-light-info">{{ $row->receipt_no }}</span>
@endif
