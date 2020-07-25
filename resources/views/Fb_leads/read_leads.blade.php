@extends('layouts.app')
		@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h1 class="text-primary mr-auto">Facebook NEW LEADS</h1>
      </div>
    </div>
  </div>		<table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>form</th>
                <th>lead</th>
                <th>made at</th>
                <th>page</th>
                <th>ad group</th>
                <th>logged at</th>
                
            </tr>
        </thead>
		<tbody>


				@foreach ($arr as $arrmember)
		            <tr>
             <td>{{$arrmember['ad_id']}} </td>
             <td>{{$arrmember['form_id']}} </td>
             <td>{{$arrmember['leadgen_id']}} </td>
             <td>{{date('r', $arrmember['created_time'])}} </td>
             <td>{{$arrmember['page_id']}} </td>
             <td>{{$arrmember['adgroup_id']}} </td>
             <td>{{$arrmember['created_at']}} </td>
					   
				   </tr>
				@endforeach
		</tbody>
		</table>

@endsection