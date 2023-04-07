<div class="d-flex justify-content-center mt-2">
    @if (empty($row->package_id))
        N/A
    @else
        <a href="{{ url('packages').'/'.$row->package->id }}" class="text-decoration-none">{{ $row->package->name }}</a>
    @endif    
</div>

