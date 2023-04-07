<div class="dropdown">
    <a href="#" class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">{{ __('messages.common.actions') }}
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="{{ route('receptionists.create') }}"
               class="dropdown-item  px-5">{{ __('messages.receptionist.new_receptionist') }}</a>
        </li>
        <li>
            <a href="{{ route('receptionists.excel') }}"
               data-turbo="false" class="dropdown-item  px-5">{{ __('messages.common.export_to_excel') }}</a>
        </li>
    </ul>
</div>

