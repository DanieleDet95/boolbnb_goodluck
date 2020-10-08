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

  {{-- Bootstrap --}}
  <div class="container">
    <div class="row justify-content-center">

      {{-- Create suite --}}
      <div class="create_suite_wrapper common_form col-10 col-md-8 col-lg-6">

        {{-- Form title --}}
        <div class="form_title text-center">
          <div class="top_title">
            <h4>Create Suites</h4>
          </div>

          <div class="sub_title">
            <h3>Publish your suites</h3>
          </div>
        <div>
        {{-- end Form Title --}}

        {{-- Form Create --}}
        <form  action="{{route('admin.suites.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')

          {{-- Create Title --}}
          <div class="create_title form-group row">
            <div class="col-12">
              <div class="input_box">
                <input
                  type="text"
                  name="title"
                  value="{{old('title')}}"
                  class="form-control rounded-0"
                  required autocomplete="title"
                  autofocus
                  placeholder="Title">
              </div>
            </div>
          </div>
          {{-- end Create Title --}}

          {{-- Create Addresse --}}
          <div class="create_address form-group row">
            <div class="col-12">
              <div class="input_box">
                <input
                  type="text"
                  name="address"
                  value="{{old('address')}}"
                  class="form-control rounded-0"
                  required autocomplete="address"
                  autofocus
                  placeholder="Address">
              </div>
            </div>
          </div>
          {{-- end Create Addresse --}}

          {{-- Create Rooms-Beds --}}
          <div class="create_rooms_beds double_input form-group row">

            {{-- Create Rooms --}}
            <div class="create_rooms left_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="rooms"
                  value="{{old('rooms')}}"
                  class="form-control rounded-0"
                  required autocomplete="rooms"
                  autofocus
                  placeholder="Rooms">
              </div>
            </div>
            {{-- end Create Rooms --}}

            {{-- Create Beds --}}
            <div class="create_beds right_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="beds"
                  value="{{old('beds')}}"
                  class="form-control rounded-0"
                  required autocomplete="beds"
                  autofocus
                  placeholder="Beds">
              </div>
            </div>
            {{-- end Create Beds --}}

          </div>
          {{-- end Create Rooms-Beds --}}

          {{-- Create Baths-Square meters --}}
          <div class="create_baths_square_m double_input form-group row">

            {{-- Create Baths --}}
            <div class="create_baths left_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="baths"
                  value="{{old('baths')}}"
                  class="form-control rounded-0"
                  required autocomplete="baths"
                  autofocus
                  placeholder="Baths">
              </div>
            </div>
            {{-- end Create Baths --}}

            {{-- Create Square meters --}}
            <div class="create_square_m right_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="square_m"
                  value="{{old('square_m')}}"
                  class="form-control rounded-0"
                  required autocomplete="square_m"
                  autofocus
                  placeholder="Square Meteres">
              </div>
            </div>
            {{-- end Create Square meters --}}

          </div>
          {{-- end Create Baths-Square meters --}}

          {{-- Create Price-Cover meters --}}
          <div class="create_price_cover double_input form-group row">

            {{-- Create Baths --}}
            <div class="create_price left_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="price"
                  step="any"
                  value="{{old('price')}}"
                  class="form-control rounded-0"
                  required autocomplete="price"
                  autofocus
                  placeholder="Price">
              </div>
            </div>
            {{-- end Create Baths --}}

            {{-- Create Cover image --}}
            <div class="create_cover right_input col-6">
              <div class="input_box custom-file">
                <input
                  type="file"
                  name="main_image"
                  value="{{old('main_image')}}"
                  class="custom-file-input"
                  required>
                <label class="custom-file-label rounded-0">Choose file...</label>
              </div>
            </div>
            {{-- end Create Cover image --}}

          </div>
          {{-- end Create Price-Cover --}}

          {{-- Create Description --}}
          <div class="create_description form-group row">
            <div class="col-12">
              <div class="input_box">
                <textarea
                  type="text"
                  name="description"
                  rows="8" cols="80"
                  class="form-control rounded-0"
                  placeholder="Description">{{old('description')}}</textarea>
              </div>
            </div>
          </div>
          {{-- end Create Description --}}

          {{-- Create Services --}}
          <div class="create_services row">
            <div class="col-12">
              <div class="checkbox d-flex justify-content-between">
                {{-- <h3>Lista servizi</h3> --}}

                {{-- Checkbox --}}
                @foreach ($services as $service)
                <label class="container_checkbox">{{ $service->supplements }}
                  <input type="checkbox" name="services[]" value="{{ $service->id }}" {{ old('remember') ? 'checked' : '' }}>
                  <span class="checkmark"></span>
                </label>
                @endforeach
                {{-- end Checkbox --}}

              </div>
            </div>
          </div>
          {{-- end Create Services --}}

        </form>
        {{-- end Form Create --}}

        {{-- Submit Login --}}
        <div class="form_submit form-group justify-content-center row">
          <div class="col-12">
            <div class="button_submit">
              <button type="submit" class="custom_button">
                {{ __('Register') }}
              </button>
            </div>
          </div>
        </div>
      </div>
      {{-- end Create suite --}}

    </div>
    <div>
      <label>Indirizzo:</label>
      <input type="search" id="address_create" name="address" value="{{old('address')}}" placeholder="Dove si trova?" />
      <input class="d-none" id="latitude" type="text" name="latitude" value="{{old('latitude')}}">
      <input class="d-none" id="longitude" type="text" name="longitude" value="{{old('longitude')}}">
    </div>
    <div>
      <label>Stanze:</label>
      <input id="stanza" type="number" name="rooms" value="{{old('rooms')}}">
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

{{-- <div>
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
  <h3>Lista servizi</h3>
  @foreach ($services as $service)
      <input type="checkbox" name="services[]" value="{{ $service->id }}">
      <label>{{ $service->supplements }}</label>
  @endforeach
</div>
  <input type="submit" value="submit">
</div> --}}
