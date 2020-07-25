@extends('layouts.app')
		@section('content')

<?php //dd($arr); ?>
<div class="main-container container-fluid">
  <!-- heading -->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h1 class="text-primary mr-auto">{{$arr[0]['title']}}</h1>
      </div>
    </div>
  </div>

  <div class="modal-content">
		<form id="edit-form" action="{{route('documentUpdate')}}" method="POST">
			<input type='text' name='id' id='id' value="{{$arr[0]['id']}}">
			{{ csrf_field() }}
			Title: <input type='text' id='title' name='title' value="{{$arr[0]['title']}}" required />
			<textarea name="summernoteInput" class="summernote">{{$arr[0]['content']}}</textarea>
			<!--
			<br>
			<button type="submit">Submit</button>
		    -->
		</form>

		<div class="modal-footer">
			<button id="save-button" type="button" class="btn btn-primary">Save</button>
		</div>
  </div>

	<script>
	        $(document).ready(function() {
	            $('.summernote').summernote();
	        });

	        $( "#save-button" ).click(function() {
            	$( "#edit-form" ).submit();
          	});
	</script>
</div>
@endsection