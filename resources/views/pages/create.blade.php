<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSON Generator</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jeditable.js/1.7.3/jeditable.min.js"></script>
    <script src="{{ asset('assets/js/jquery.contextMenu.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</head>
<body>
	<form action="{{ route('pages.store') }}" method="POST">
		@csrf
		<input type="hidden" name="schema" autocomplete="off">
	</form>
	<div class="container">
		<div id="editarea" class="rounded">
			<h3>Page Schema:</h3>
			<button class="btn" id="schema_btn">Submit</button>
			<div id="json_editor" data-role="myjson"></div>
		</div>
		<!-- END visible area//-->
		<div style="display:none"><div data-type="object"></div><div data-type="array"></div></div>
	</div>
</body>
</html>