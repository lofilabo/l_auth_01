@extends('layouts.app')
		@section('content')


<div class="main-container container-fluid">
  <!-- heading -->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h1 class="text-primary mr-auto">Edit Document</h1>
      </div>
    </div>
  </div>

	<form id="edit-form" action="{{route('documentPersist')}}" method="POST">
		{{ csrf_field() }}
		<textarea name="summernoteInput" class="summernote">{!! $document->content !!}</textarea>
		<br>
		<button type="submit">Submit</button>
	</form>

      <div class="modal-footer">
        <button id="save-button" type="button" class="btn btn-primary">Save</button>
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
