{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form  action="{{route('admin.suites.update', $suite->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
      <label>Titolo:</label>
      <input type="text" name="title" value="{{ old('title') ? old('title') : $suite->title }}">
    </div>
    <div>
      <label>Indirizzo:</label>
      <input type="text" name="address" value="{{ old('address') ? old('address') : $suite->address }}">
    </div>
    <div>
      <label>Stanze:</label>
      <input type="number" name="rooms" value="{{ old('rooms') ? old('rooms') : $suite->rooms }}">
    </div>
    <div>
      <label>Letti:</label>
      <input type="number" name="beds" value="{{ old('beds') ? old('beds') : $suite->beds }}">
    </div>
    <div>
      <label>Bagni:</label>
      <input type="number" name="baths" value="{{ old('baths') ? old('baths') : $suite->baths }}">
    </div>
    <div>
      <label>Metri quadri:</label>
      <input type="number" name="square_m" value="{{ old('square_m') ? old('square_m') : $suite->square_m }}">
    </div>
    <div>
      <label>Copertina:</label>
      <input type="file" name="main_image" accept="image/*">
    </div>
    <div>
      <label>Prezzo:</label>
      <input type="number" step="any" name="price" value="{{ old('price') ? old('price') : $suite->price }}">
    </div>
    <div>
      <label>Descrizione:</label>
      <textarea name="description" rows="8" cols="80">{{ old('description') ? old('description') : $suite->description }}</textarea>
    </div>
    <div>
      <input type="submit" value="Modifica">
    </div>
  </form>
  <div>
    <a href="{{ route("suites.index")}}"> Torna a Index</a>
  </div>
@endsection
