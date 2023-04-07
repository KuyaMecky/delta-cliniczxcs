@if(Auth::user()->hasRole('MedTech'))
    <div class="d-flex align-items-center">
        <a href="{{ url('employee/doctor') . '/' .$row->id }}">
            <div class="image image-mini me-3">
                <img src="{{ $row->doctor->doctorUser->image_url }}" alt="user" class="user-img image object-contain image-circle">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{ url('employee/doctor') . '/' .$row->id }}" class="mb-1 text-decoration-none fs-6">
                {{ $row->doctor->doctorUser->full_name }}
            </a>
            <span class="fs-6">{{ $row->doctor->doctorUser->email }}</span>
        </div>
    </div>
@else
    <div class="d-flex align-items-center">
        <a href="{{url('doctors'.'/'.$row->doctor->id) }}">
            <div class="image image-mini me-3">
                <img src="{{ $row->doctor->doctorUser->image_url }}" alt="user" class="user-img image object-contain image-circle">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{ url('doctors'.'/'.$row->doctor->id) }}" class="mb-1 text-decoration-none fs-6">
                {{ $row->doctor->doctorUser->full_name }}
            </a>
            <span class="fs-6">{{ $row->doctor->doctorUser->email }}</span>
        </div>
    </div>
@endif
