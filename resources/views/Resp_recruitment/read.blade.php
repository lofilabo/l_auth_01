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
             <td colspan=50>        
            {{implode($arrmember)}}
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>


@endsection