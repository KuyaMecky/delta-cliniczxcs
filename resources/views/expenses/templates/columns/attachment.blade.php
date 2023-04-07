@if($row->document_url !== '')
    <a data-turbo="false" href="{{ url('expense-download').'/'.$row->id }}" class="text-decoration-none">Download</a>
@else
    <samp>N/A</samp>
@endif

