<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<style>
	.item {
		float: left;
		margin-left: 10px;
		border:  1px solid #ccc;
		padding: 10px;
	}
	.item .text {
		margin-top: -20px;
	}
</style>
<body>
	<div class="container">
		
		@foreach ($data as $key => $value)
			<div class="item">
			<p>
				<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge(url('/logo.png'), .15, true)->size(100)->generate($value->title)) !!} ">
			</p>
			<p class="text">{{$value->description}}</p>
			</div>
		@endforeach
		
	</div>
</body>
</html>