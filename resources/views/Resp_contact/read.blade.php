@extends('layouts.app')
		@section('content')

		<table id="example" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>message</th>
                <th>name</th>
                <th>subject</th>
                <th>email</th>
                <th>insert</th>
                <th>changed</th>
                <th>Status</th>
            </tr>
        </thead>
		<tbody>


				@foreach ($arr as $arrmember)
		            <tr>
					   <td>{{$arrmember['msg']}} </td>
					   <td>{{$arrmember['yourname']}} </td>
					   <td>{{$arrmember['subject']}} </td>
					   <td>{{$arrmember['email']}} </td>
					   <td>{{$arrmember['insert_date']}} </td>
					   <td>{{$arrmember['altered_date']}} </td>
					   <td>{{$arrmember['current_status']}}</td>
				   </tr>
				@endforeach
		</tbody>
		</table>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times </span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection