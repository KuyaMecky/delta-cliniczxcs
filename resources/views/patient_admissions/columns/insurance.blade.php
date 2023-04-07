<div class="d-flex justify-content-center mt-2">
    @if (empty($row->insurance_id))
        N/A
    @else
        <a href="{{ url('insurances').'/'.$row->insurance->id }}" class="text-decoration-none">{{ $row->insurance->name }}</a>
    @endif    
</div>

