<div class="d-flex align-items-center">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->patient->patientUser->image_url}}" alt="user" class="user-img">
        </div>
    <div class="d-flex flex-column">
            {{$row->patient->patientUser->full_name}}
        <span class="fs-6">{{$row->patient->patientUser->email}}</span>
    </div>
</div>
