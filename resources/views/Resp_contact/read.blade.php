@extends('layouts.app')
		@section('content')



  <!-- heading -->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h3 class="text-primary mr-auto">Contact</h3>
      </div>
    </div>
  </div>
  <!-- /heading -->
  <!-- table -->
  <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
    <thead class="thead-dark">
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

@endsection