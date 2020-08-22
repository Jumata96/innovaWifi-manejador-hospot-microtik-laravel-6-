<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Campaña</title>
</head>
<body>
<table>
	<thead>
		<th>
			{{$data->asunto}}
		</th>
	</thead>
	<tbody>
		<tr>
			@if($tipo == '1')
				<td>
					<img src="{{$url_imagen}}" alt="imagen" width="400" height="450">									
				</td>
			@else
				<td>							
					<video width="640" height="360" controls>
					  	<source src="{{$url_imagen}}" type="video/mp4">
					  	Link de Video: {{$url_imagen}}
					</video>		
				</td>
			@endif				
		</tr>
		<tr>
			<td>
				{!!$data->contenido!!}
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>

