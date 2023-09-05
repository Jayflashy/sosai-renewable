<span class="mt-1"></span>
@if(count($errors) > 0)
<div class="alert alert-danger alert-dismissible  validation fade show mb-0" role="alert">
	<ul class="text-left {{ count($errors) == 1 ? 'list-unstyled' : '' }}">
		@foreach($errors->all() as $error)
		<li>
            <b>{{$error}}</b>
        </li>
		@endforeach
	</ul>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(Session::get('success'))
<div class="w-100 alert bg-success alert-dismissible  validation fade show mb-0" role="alert">
	{{Session::get('success')}}
	{{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
</div>
@endif
@if(Session::get('error'))
<div class="w-100 alert bg-danger alert-dismissible  validation fade show mb-0" role="alert">
	{{Session::get('error')}}
	{{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
</div>
@endif