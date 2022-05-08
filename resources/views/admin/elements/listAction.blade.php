@if(isset($data['view_url']) && $data['view_url'])
<a class="view-list" href="{{$data['view_url']}}"><i class="material-icons green-text">remove_red_eye</i></a>
@endif
@if(isset($data['edit_url']) && $data['edit_url'])
<a href="{{$data['edit_url']}}"><i class="material-icons">edit</i></a>
@endif
@if(isset($data['delete_url']) && $data['delete_url'])
<a class="delete-list" href="javascript:void(0)" data-src="{{$data['delete_url']}}"><i class="material-icons pink-text">delete_forever</i></a>
@endif
@if(isset($data['qr_url']) && $data['qr_url'])
<a href="{{$data['qr_url']}}">QR</a>
@endif