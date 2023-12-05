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
	<div id="inputarea" class="rounded">
	input:
	<textarea id="jsoninput" rows="35" cols="24">{"name":"jane","employed":false,"husband":null,"items":["haro",23,{"brand":"Duca"},true],"pets":[{"name":"chopper","color":"blue"},{"name":"yoshi","color":"green"},{"name":"mame","color":"&#38738;&#12356;"}],"height":170.4,"car":{"color":"red","model":"mini","clean":false}}</textarea>
	</div>
	<div id="toolarea" class="rounded">tools:
		<a href="#" onclick="javascript:load_from_box(); " title="import into workspace">&gt;&gt;</a><br/>
		<a href="#" onclick="javascript:extract_json('json_editor');"  title="export json">&lt;0</a><br/>
		<a href="#" onclick="javascript:extract_json('json_editor', 2); "  title="export json with 2 space indent">&lt;2</a><br/>
		<a href="#" onclick="javascript:extract_json('json_editor', '\t'); "  title="export json with tab indent">&lt;\t</a><br/>
		<a href="#" onclick="javascript:save_ws('json_editor'); " title="save as a mock web service">ws</a>

	</div>
	<div id="editarea" class="rounded">
		workspace:
		<div id="json_editor" data-role="myjson"></div>
	</div>
	<!-- END visible area//-->
	<div style="display:none"><div data-type="object"></div><div data-type="array"></div></div>
	<div id="boxes">
		<div id="dialog" class="window">
			<b>Your JSON can be fetched at this url:</b>
			<div id="past_ws">
			</div>
			<a href="#" class="close" onclick="javascript: $('#mask, .window').fadeOut(500); ">Close</a>
		</div>
		<div id="mask"></div>
	</div>
</body>
</html>