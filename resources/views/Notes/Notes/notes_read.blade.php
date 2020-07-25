

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
        <h1 class="text-primary mr-auto">NOTES: {{$noteType}}</h1>
      </div>
    </div>
  </div>
  <!-- /heading -->
  <!-- table -->
  <table class="table table-bordered" id="myTable" cellspacing="0" width="100%">
    <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>note</th>
                <th>created</th>
                <th>pid</th>
                <th>pnid</th>
                <th>User</th>
                <th>action</th>
                
                
            </tr>
        </thead>
		<tbody>
      
				@foreach ($arr as $arrmember)


      <tr class="data-row">
        <td class="align-middle iteration">{{$arrmember['id']}}</td>
          <td class="align-middle fname">{{$arrmember['note']}} </td>
          <td class="align-middle lname">{{$arrmember['created_at']}} </td>
          <td class="align-middle tel">{{$arrmember['parent_id']}} </td>
          <td class="align-middle url">{{$arrmember['parent_note_id']}} </td>
          <td class="align-middle created_at">{{$arrmember['user_id']}} </td>        
          <td class="align-middle">
            <button type="button" class="btn btn-success" id="edit-item" data-item-id="{{$arrmember['id']}}">view</button>
          </td>
      </tr>



				@endforeach
		</tbody>
		</table>



<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">Note Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="edit-form" class="form-horizontal" method="POST" action="/notes/{{$noteType}}/update">
          {{csrf_field()}}
          <div class="card text-white bg-dark mb-0">
<!--
            <div class="card-header">
              <h2 class="m-0">Edit</h2>
            </div>
-->
            <div class="card-body">
                <input type="hidden" name="modal-input-id" class="form-control" id="modal-input-id" >
                <div class="form-group">
                    <!--<label class="col-form-label" for="modal-input-note">Note</label>-->
                    <textarea class="form-control" name="modal-input-note" class="form-control" id="modal-input-note" rows="12"></textarea>
                </div>
            </div>
          </div>
        </form>
      </div>


<div class="main-container container-fluid">

                              <div class="main-container container-fluid">
                                    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>    
                                          <form action="{{route('documentPersist')}}" method="POST">
                                            {{ csrf_field() }}
                                            <textarea name="summernoteInput" class="summernote"  id="modal-input-note-2"></textarea>
                                            <br>
                                            <button type="submit">Submit</button>
                                          </form>
                                    <script>
                                        $(document).ready(function() {
                                            $('.summernote').summernote();
                                        });
                                    </script>
                              </div>

      <div class="modal-footer">
        <!--<button id="save-button" type="button" class="btn btn-primary">Save</button>-->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <script>
          
          $( "#save-button" ).click(function() {
            $( "#edit-form" ).submit();
          });

        </script>


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
            var id = el.data('item-id');

            $.ajax({
              url: "/notes/{{$noteType}}/note/" + id,
              context: document.body
            }).done(function(incm) {
                console.log(incm);
                jncm = JSON.parse(incm);
                jncm = jncm[0];
                $("#modal-input-note").val(  jncm.note  );
                $('.summernote').summernote('code', jncm.note );
            });
          })

          $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
          })

        });
</script>












@endsection



