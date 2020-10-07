{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Error --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {{-- Error --}}


  <form  action="{{route('admin.suites.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div>
      <label>Titolo:</label>
      <input type="text" name="title" value="{{old('title')}}">
    </div>
    <div>
      <label>Indirizzo:</label>
      <input type="text" name="address" value="{{old('address')}}">
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
    <div class="chekboxes">
      <table border="1" class="text-center">
        <tr>
          <th colspan="6">Lista servizi</th>
        </tr>
        <tr>
          @foreach ($services as $service)
            <td class="pt-2">
              <i class="{{ $service->icon }}"></i>
              <label>{{ $service->supplements }}</label>
              <input type="checkbox" name="services[]" value="{{ $service->id }}">
            </td>
          @endforeach
        </tr>
      </table>
    </div>
    <div class="invia">
      <input type="submit" class="btn" value="Crea">
    </div>
  </form>

@endsection
