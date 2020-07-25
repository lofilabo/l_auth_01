

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
        <h1 class="text-primary mr-auto">DOCUMENTS</h1>
      </div>
    </div>
  </div>
  <!-- /heading -->
  <!-- table -->
  <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
    <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Created</th>
                <th>action</th>
                
                
            </tr>
        </thead>
		<tbody>
      
				@foreach ($arr as $arrmember)


      <tr class="data-row">
        <td class="align-middle iteration">{{$arrmember['id']}}</td>
          <td class="align-middle fname">{{$arrmember['title']}} </td>
          <td class="align-middle created_at">{{$arrmember['created_at']}} </td>        
          <td class="align-middle">
            <a type="button" class="btn btn-danger" href="/documents/del/{{$arrmember['id']}}">del</a>
            <a type="button" class="btn btn-success" href="/documents/edit/{{$arrmember['id']}}">edit</a>
            <button type="button" class="btn btn-warning" id="edit-item" data-item-id="{{$arrmember['id']}}">quick view</button>
            <a type="button" class="btn btn-info" href="/documents/show/{{$arrmember['id']}}">fullpage show</a>
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
        <h5 class="modal-title" id="edit-modal-label">Read Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
      

      </div>
      <div class="modal-footer">
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
            var id = el.data('item-id');
            /*
            var name = row.children(".name").text();
            var description = row.children(".description").text();
            var ajaxtail = row.children(".ajaxtail").text();
            */
            $.ajax({
              url: "/documents/view/" + id,
              context: document.body
            }).done(function(incm) {
              console.log(incm);
                //jncm = JSON.parse(incm);
                //jncm = jncm[0];
                $("#attachment-body-content").html(  incm  );
                
            });
          })

          // on modal hide
          $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
          })

        });
</script>
@endsection



