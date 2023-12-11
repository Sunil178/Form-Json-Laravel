@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/json.css') }}">
@endsection

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="container">
		<div id="editarea" class="rounded">
			<h3>Page Content:</h3>
			<div id="json_editor" data-role="myjson"></div>
		</div>
		<!-- END visible area//-->
		<div style="display:none"><div data-type="object"></div><div data-type="array"></div></div>
	</div>
	<form action="{{ route('pages.content_update', $page->id) }}" method="POST" id="page_form">
		@csrf
		@method('PUT')
		<input type="hidden" name="content" id="json-schema" autocomplete="off" value="{{ $page->schema }}">
		<button class="btn" id="content_btn" type="button">Submit</button>
	</form>
@endsection

@section('scripts')
	<script src="{{ asset('assets/js/content.js') }}"></script>
	<script src="{{ asset('assets/js/schema.js') }}"></script>
@endsection
