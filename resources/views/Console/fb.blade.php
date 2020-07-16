@extends('layouts.app')
		@section('content')

{{ @json($nuf) }}
<hr/>
{!! @json($lit) !!}

@endsection