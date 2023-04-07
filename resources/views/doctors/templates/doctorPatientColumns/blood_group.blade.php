@if(!empty($row->patient->user->blood_group))
<span
        class="badge fs-6 bg-light-{{ !empty($row->patient->user->blood_group) ? 'success' : 'danger'  }}"> {{ $row->patient->user->blood_group }} </span>
@else
    <span
            class="fw-bolder fs-6 text-gray-800 me-2">{{ __('messages.common.n/a')}}</span>
@endif
