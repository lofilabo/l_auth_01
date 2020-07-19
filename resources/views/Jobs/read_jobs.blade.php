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
        <h1 class="text-primary mr-auto">JOBS AVAILABLE</h1>
      </div>
    </div>
  </div>
  <!-- /heading -->
  <!-- table -->
  <!-- table -->
  <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
    <thead class="thead-dark">
            <tr>
                <th><a href='?action=idup'><i class="fa fa-arrow-up"></i></a><a href='?action=iddown'><i class="fa fa-arrow-down"></i></a>&nbsp; id</th>
                <th><a href='?action=fnameup'><i class="fa fa-arrow-up"></i></a><a href='?action=fnamedown'><i class="fa fa-arrow-down"></i></a>&nbsp; fname</th>
                <th><a href='?action=lnameup'><i class="fa fa-arrow-up"></i></a><a href='?action=lnamedown'><i class="fa fa-arrow-down"></i></a>&nbsp; lname</th>
                <th><a href='?action=emailup'><i class="fa fa-arrow-up"></i></a><a href='?action=emaildown'><i class="fa fa-arrow-down"></i></a>&nbsp; email</th>
                <th><a href='?action=telup'><i class="fa fa-arrow-up"></i></a><a href='?action=teldown'><i class="fa fa-arrow-down"></i></a>&nbsp; tel</th>
                <th><a href='?action=urlup'><i class="fa fa-arrow-up"></i></a><a href='?action=urldown'><i class="fa fa-arrow-down"></i></a>&nbsp; url</th>
                <th><a href='?action=createdup'><i class="fa fa-arrow-up"></i></a><a href='?action=createddown'><i class="fa fa-arrow-down"></i></a>&nbsp; Created</th>
                <th>Status</th>
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
          <td class="align-middle status">{{$stat[$arrmember['status']]}} </td>        

          <td class="align-middle"><button type="button" class="btn btn-success" id="edit-item" data-item-id="{{$arrmember['id']}}">edit</button>
          <a type="button" class="btn btn-danger" href="/jobs/del?id={{$arrmember['id']}}">del</a>
          </td>
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
        <h5 class="modal-title" id="edit-modal-label">Job Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="edit-form" class="form-horizontal" method="POST" action="/jobs/update?action={{$action}}">
          {{csrf_field()}}
          <div class="card text-white bg-dark mb-0">
            <div class="card-header">
              <h2 class="m-0">Edit</h2>
            </div>

            <div class="card-body">
                <input type="hidden" name="modal-input-id" class="form-control" id="modal-input-id" >
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-status">Status</label>
                    <select name="modal-input-status" class="form-control" id="modal-input-status">
                    @foreach ($stat as $statkey=>$statvalue)
                    <option value="{{$statkey}}"> 
                      {{$statvalue}}
                    </option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">FName</label>
                    <input type="text" name="modal-input-fname" class="form-control" id="modal-input-fname" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">LName</label>
                    <input type="text" name="modal-input-lname" class="form-control" id="modal-input-lname" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Email</label>
                    <input type="text" name="modal-input-email" class="form-control" id="modal-input-email" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Tel</label>
                    <input type="text" name="modal-input-tel" class="form-control" id="modal-input-tel" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Ketai</label>
                    <input type="text" name="modal-input-ketai" class="form-control" id="modal-input-ketai" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Person in Charge</label>
                    <input type="text" name="modal-input-personincharge" class="form-control" id="modal-input-personincharge" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">URL</label>
                    <input type="text" name="modal-input-url" class="form-control" id="modal-input-url" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Contact</label>
                    <input type="text" name="modal-input-contactother" class="form-control" id="modal-input-contactother" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">CV</label>
                    <textarea class="form-control" name="modal-input-cv" class="form-control" id="modal-input-cv" rows="12"></textarea>
                    
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Note 1</label>
                    <input type="text" name="modal-input-note1" class="form-control" id="modal-input-note1" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Note 2</label>
                    <input type="text" name="modal-input-note2" class="form-control" id="modal-input-note2" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Note 3</label>
                    <input type="text" name="modal-input-note3" class="form-control" id="modal-input-note3" >
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Note 4</label>
                    <input type="text" name="modal-input-note4" class="form-control" id="modal-input-note4" >

                </div>


            </div>

          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button id="save-button" type="button" class="btn btn-primary">Save</button>
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
            /*
            var name = row.children(".name").text();
            var description = row.children(".description").text();
            var ajaxtail = row.children(".ajaxtail").text();
            */
            $.ajax({
              url: "/jobs/job/" + id,
              context: document.body
            }).done(function(incm) {
                var jsonstat = JSON.parse('<?php echo(json_encode($stat, JSON_FORCE_OBJECT)); ?>');
                jncm = JSON.parse(incm);
                jncm = jncm[0];
                $("#modal-input-contactother").val(  jncm.contactother  );
                $("#modal-input-cv").val(  jncm.cv  );
                $("#modal-input-email").val(  jncm.email  );
                $("#modal-input-fname").val(  jncm.fname  );
                $("#modal-input-ketai").val(  jncm.ketai  );
                $("#modal-input-lname").val(  jncm.lname  );
                $("#modal-input-note1").val(  jncm.note1  );
                $("#modal-input-note1").val(  jncm.note2  );
                $("#modal-input-note1").val(  jncm.note3  );
                $("#modal-input-note1").val(  jncm.note4  );
                $("#modal-input-personincharge").val(  jncm.personincharge  );
                $("#modal-input-tel").val(  jncm.tel  );
                $("#modal-input-url").val(  jncm.url  );
                //$("#modal-input-status").val(  jsonstat[jncm.status]  );
                $("#modal-input-status").val(  jncm.status  );
                $("#modal-input-id").val( id );

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



