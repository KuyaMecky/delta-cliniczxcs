<div class="d-flex align-items-center">
    <a href="{{route('patients.show', $row->id)}}">
        <div class="image image-mini me-3">
            <img src="{{$row->patientUser->image_url}}" alt="user" class="user-img image rounded-circle object-contain">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="{{route('patients.show', $row->id)}}" class="mb-1 text-decoration-none fs-6">
            {{$row->patientUser->full_name}}
        </a>
        <span class="fs-6">{{$row->patientUser->email}}</span>
    </div>
</div>
