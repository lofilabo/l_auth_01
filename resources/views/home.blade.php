@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>USER Dashboard</h2></div>

                <div class="panel-body">
                  @component('components.who')
                  @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
