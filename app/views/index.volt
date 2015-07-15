<!DOCTYPE html>
<html>
	<head>
		<title>Oorden prueba</title>
			{{ stylesheet_link('css/bootstrap.min.css') }}
			{{ assets.outputCss() }}		
			
	</head>
	<body>
		
				{{ content() }}

			{{ javascript_include("js/jquery-1.10.2.min.js") }}
			{{ javascript_include("js/bootstrap.min.js") }}
			{{ javascript_include("js/bootswatch.js") }}
			

			{{ assets.outputJs() }}

	</body>
</html>