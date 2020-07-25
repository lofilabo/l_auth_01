<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $document[0]['title'] }}</title>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/style4.css">
    <script src="https://use.fontawesome.com/590b1878e3.js"></script>
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">


<style>

    .doctext{
      
    }
</style>

</head>

<body>
<div>
  <a href="javascript:history.back()"><i class="fa fa-arrow-left"></i>BACK</a> 
</div>
<div class="main-container container-fluid">
  <!-- heading -->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h1 class="text-primary mr-auto">{{$document[0]['title']}}</h1>
      </div>
    </div>
  </div>
  <div class="doctext">
	{!! $document[0]['content'] !!}
  </div>
</div>
</body>
</html>