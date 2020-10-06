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

  <form  action="{{route('admin.suites.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div>
      <label>Titolo:</label>
      <input type="text" name="title" value="{{old('title')}}">
    </div>
    <div>
      <label>Indirizzo:</label>
      <input type="search" id="address" name="address" value="{{old('address')}}" placeholder="Dove si trova?" />
      <input class="d-none" id="latitude" type="text" name="latitude" value="{{old('latitude')}}">
      <input class="d-none" id="longitude" type="text" name="longitude" value="{{old('longitude')}}">
    </div>
    <div>
      <label>Stanze:</label>
      <input type="number" name="rooms" value="{{old('rooms')}}">
    </div>
    <div>
      <label>Letti:</label>
      <input type="number" name="beds" value="{{old('beds')}}">
    </div>
    <div>
      <label>Bagni:</label>
      <input type="number" name="baths" value="{{old('baths')}}">
    </div>
    <div>
      <label>Metri quadri:</label>
      <input type="number" name="square_m" value="{{old('square_m')}}">
    </div>
    <div>
      <label>Copertina:</label>
      <input type="file" name="main_image" accept="image/*">
    </div>
    <div>
      <label>Prezzo:</label>
      <input type="number" step="any" name="price" value="{{old('price')}}">
    </div>
    <div>
      <label>Descrizione:</label>
      <textarea name="description" rows="8" cols="80">{{old('description')}}</textarea>
    </div>
    <div>
      <input type="submit" value="submit">
    </div>
  </form>

  <div>
    <a href="{{ route("suites.index")}}"> Torna a Index</a>
  </div>
@endsection
