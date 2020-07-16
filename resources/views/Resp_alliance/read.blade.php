@extends('layouts.app')
    @section('content')
  <!-- heading -->
  <!-- heading -->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h3 class="text-primary mr-auto">Alliance</h3>
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
             <td colspan=50>        
            {{implode($arrmember)}}
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>


@endsection