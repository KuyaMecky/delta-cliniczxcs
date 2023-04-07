<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <div>
            <img src="{{$row->doctor->doctorUser->image_url}}" alt=""
                 class="user-img rounded-circle image">
        </div>
    </div>
    <div class="d-flex flex-column">
        <span class="mb-1 text-decoration-none">{{$row->doctor->doctorUser->full_name}}</span>
        <span>{{$row->doctor->doctorUser->email}}</span>
    </div>
</div>
