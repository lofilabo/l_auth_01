@extends('layouts.app')
		@section('content')


  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h1 class="text-primary mr-auto">NEW RECRUITER</h1>
      </div>
    </div>
  </div>
        <form id="edit-form" class="form-horizontal" method="POST" action="/recruiters/create">
          {{csrf_field()}}


           
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

      <div class="modal-footer">
        <button id="save-button" type="button" class="btn btn-primary">Save</button>
        
        <script>
          
          $( "#save-button" ).click(function() {
            $( "#edit-form" ).submit();
          });

        </script>
      </div>

@endsection



