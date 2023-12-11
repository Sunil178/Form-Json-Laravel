@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/json.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
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
			<h3>Page Schema:</h3>
			<div id="json_editor" data-role="myjson"></div>
		</div>
		<!-- END visible area//-->
		<div style="display:none"><div data-type="object"></div><div data-type="array"></div></div>
	</div>
	<form action="{{ route('pages.schema_update', $page->id) }}" method="POST" id="page_form">
		@csrf
		@method('PUT')
		<input type="hidden" name="schema" id="json-schema" autocomplete="off" value="{{ $page->schema }}">
		
		<label>Page No.:</label>
		<div class="row">
			<input type="text" placeholder="Page No." name="number"  value="{{ $page->number }}" required />
		</div>
		<div class="error-message"></div>

		<label>Page Name:</label>
		<div class="row">
			<input type="text" placeholder="Page Name" name="name" value="{{ $page->name }}" required />
		</div>
		<div class="error-message"></div>
		<button class="btn" id="schema_btn" type="button">Submit</button>
	</form>
@endsection

@section('scripts')
	<script src="{{ asset('assets/js/json.js') }}"></script>
	<script src="{{ asset('assets/js/schema.js') }}"></script>
    <script>
        $(function () {
            load_from_box();
        });
    </script>
@endsection
