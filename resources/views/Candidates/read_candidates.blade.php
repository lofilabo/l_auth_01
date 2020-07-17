@extends('layouts.app')
		@section('content')

<style>
    .ajaxtail{
      display: none;
    }
</style>


<div class="main-container container-fluid">
  <!-- heading -->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h3 class="text-primary mr-auto">Candidates</h3>
      </div>
    </div>
  </div>
  <!-- /heading -->
  <!-- table -->
  <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
    <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>fname</th>
                <th>lname</th>
                <th>email</th>
                <th>tel</th>
                <th>url</th>
                <th>Created</th>
                <th>action</th>
                
                
            </tr>
        </thead>
		<tbody>
				@foreach ($arr as $arrmember)


      <tr class="data-row">
        <td class="align-middle iteration">{{$arrmember['id']}}</td>
          <td class="align-middle fname">{{$arrmember['fname']}} </td>
          <td class="align-middle lname">{{$arrmember['lname']}} </td>
          <td class="align-middle email">{{$arrmember['email']}}</td>
          <td class="align-middle tel">{{$arrmember['tel']}} </td>
          <td class="align-middle url">{{$arrmember['url']}} </td>
          <td class="align-middle created_at">{{$arrmember['created_at']}} </td>        
          <td class="align-middle"><button type="button" class="btn btn-success" id="edit-item" data-item-id="{{$arrmember['id']}}">edit</button></td>
      </tr>



				@endforeach
		</tbody>
		</table>




{{--
<div class="main-container container-fluid">
  <!-- heading -->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h3 class="text-primary mr-auto">Candidates</h3>
      </div>
    </div>
  </div>
  <!-- /heading -->
  <!-- table -->
  <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th> Name</th>
        <th> Description</th>
        <th> Action</th>
        <th class='ajaxtail'> AJAX</th>
      </tr>
    </thead>
    <tbody>
      <tr class="data-row">
        <td class="align-middle iteration">1</td>
        <td class="align-middle name">Name 1</td>
        <td class="align-middle word-break description">Description 1</td>
        <td class="align-middle">
          <button type="button" class="btn btn-success" id="edit-item" data-item-id="1">edit</button>
        </td>
        <td class="align-middle word-break ajaxtail">Candidate/47/76</td>
        
      </tr>
    </tbody>
  </table>
  <!-- /table -->
</div>
--}}



<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="edit-form" class="form-horizontal" method="POST" action="">
          <div class="card text-white bg-dark mb-0">
            <div class="card-header">
              <h2 class="m-0">Edit</h2>
            </div>

            <div class="card-body">
                <!-- id -->
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-id">Id (just for reference not meant to be shown to the general public) </label>
                    <input type="text" name="modal-input-id" class="form-control" id="modal-input-id" required>
                </div>
                <!-- /id -->
                <!-- name -->
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-name">Name</label>
                    <input type="text" name="modal-input-name" class="form-control" id="modal-input-name" required autofocus>
                </div>
                <!-- /name -->
                <!-- description -->
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Email</label>
                    <input type="text" name="modal-input-description" class="form-control" id="modal-input-description" required>
                </div>
                <!-- /description -->
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /Attachment Modal -->

<script type="text/javascript">
        $(document).ready(function () {
          $(document).on('click', "#edit-item", function() {
            $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
              'backdrop': 'static'
            };
            $('#edit-modal').modal(options)
          })

          // on modal show
          $('#edit-modal').on('show.bs.modal', function() {
            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var id = el.data('item-id');
            var name = row.children(".name").text();
            var description = row.children(".description").text();
            var ajaxtail = row.children(".ajaxtail").text();

            // fill the data in the input fields
            $("#modal-input-id").val(id);
            $("#modal-input-name").val(name);
            $("#modal-input-description").val(description);
            $("#modal-input-ajaxtail").val(ajaxtail);

          })

          // on modal hide
          $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
          })

        });
</script>
@endsection



