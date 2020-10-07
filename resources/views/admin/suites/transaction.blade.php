@extends('layouts.app')

@section('content')
    @foreach ($suite->highlights as $highlight)
      <div class="messaggio">
        <h2>La promo {{ $highlight->name }} è stata attivata sull'appartamento {{ $suite->title }}</h2>
      </div>
    @endforeach
@endsection
