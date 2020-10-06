@extends('layouts.app')

@section('content')
    @foreach ($suite->highlights as $highlight)
        <h2>la promo {{ $highlight->name }} è stata attivata sull'appartamento {{ $suite->title }}</h2>
    @endforeach
@endsection
