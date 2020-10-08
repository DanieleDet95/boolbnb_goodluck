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

      {{-- Edit suite --}}
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

        {{-- Form Edit --}}
        <form  action="{{route('admin.suites.update', $suite->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Edit Title --}}
          <div class="create_title form-group row">
            <div class="col-12">
              <div class="input_box">
                <input
                  type="text"
                  name="title"
                  value="{{ old('title') ? old('title') : $suite->title }}"
                  class="form-control rounded-0"
                  required autocomplete="title"
                  autofocus
                  placeholder="Title">
              </div>
            </div>
          </div>
          {{-- end Edit Title --}}

          {{-- Edit Addresse --}}
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
          {{-- end Edit Addresse --}}

          {{-- Edit Rooms-Beds --}}
          <div class="create_rooms_beds double_input form-group row">

            {{-- Edit Rooms --}}
            <div class="create_rooms left_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="rooms"
                  value="{{ old('rooms') ? old('rooms') : $suite->rooms }}"
                  class="form-control rounded-0"
                  required autocomplete="rooms"
                  autofocus
                  placeholder="Rooms">
              </div>
            </div>
            {{-- end Edit Rooms --}}

            {{-- Edit Beds --}}
            <div class="create_beds right_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="beds"
                  value="{{ old('beds') ? old('beds') : $suite->beds }}"
                  class="form-control rounded-0"
                  required autocomplete="beds"
                  autofocus
                  placeholder="Beds">
              </div>
            </div>
            {{-- end Edit Beds --}}

          </div>
          {{-- end Edit Rooms-Beds --}}

          {{-- Edit Baths-Square meters --}}
          <div class="create_baths_square_m double_input form-group row">

            {{-- Edit Baths --}}
            <div class="create_baths left_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="baths"
                  value="{{ old('baths') ? old('baths') : $suite->baths }}"
                  class="form-control rounded-0"
                  required autocomplete="baths"
                  autofocus
                  placeholder="Baths">
              </div>
            </div>
            {{-- end Edit Baths --}}

            {{-- Edit Square meters --}}
            <div class="create_square_m right_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="square_m"
                  value="{{ old('square_m') ? old('square_m') : $suite->square_m }}"
                  class="form-control rounded-0"
                  required autocomplete="square_m"
                  autofocus
                  placeholder="Square Meteres">
              </div>
            </div>
            {{-- end Edit Square meters --}}

          </div>
          {{-- end Edit Baths-Square meters --}}

          {{-- Edit Price-Cover meters --}}
          <div class="create_price_cover double_input form-group row">

            {{-- Edit Baths --}}
            <div class="create_price left_input col-6">
              <div class="input_box">
                <input
                  type="number"
                  name="price"
                  step="any"
                  value="{{ old('price') ? old('price') : $suite->price }}"
                  class="form-control rounded-0"
                  required autocomplete="price"
                  autofocus
                  placeholder="Price">
              </div>
            </div>
            {{-- end Edit Baths --}}

            {{-- Edit Cover image --}}
            <div class="create_cover right_input col-6">
              <div class="input_box custom-file">
                <input
                  id="create_main_image"
                  type="file"
                  name="main_image"
                  onchange="loadFile(event)"
                  value="{{old('main_image')}}"
                  class="custom-file-input">
                <label class="custom-file-label rounded-0">Choose file...</label>
              </div>
            </div>

            <div class="col-12">
              <div class="anteprima m-3">
                <p>Immagine caricata per la cover: </p>
                @if (strpos($suite->main_image, 'lorempixel') == false)
                  <img id="output" src="{{ asset('storage') . "/" . $suite->main_image}}" alt="{{$suite->title}}">
                 @else
                 <img id="output" src="{{ $suite->main_image }}" alt="{{ $suite->title }}">
                @endif
              </div>
            </div>
            {{-- end Edit Cover image --}}

            {{-- Create images --}}
            <div class="create_images left_input col-4">
              <div class="input_box custom-file">
                <input
                  id="create_image1"
                  type="file"
                  accept="image/*"
                  name="image1"
                  onchange="loadFile1(event)"
                  class="custom-file-input">
                <label class="custom-file-label rounded-3">Image 1</label>
              </div>
            </div>

            <div class="create_images center_input col-4">
              <div class="input_box custom-file">
                <input
                  id="create_image2"
                  type="file"
                  accept="image/*"
                  name="image2"
                  onchange="loadFile2(event)"
                  class="custom-file-input">
                <label class="custom-file-label rounded-0">Image 2</label>
              </div>
            </div>

            <div class="create_images right_input col-4">
              <div class="input_box custom-file">
                <input
                  id="create_image1"
                  type="file"
                  accept="image/*"
                  name="image3"
                  onchange="loadFile3(event)"
                  class="custom-file-input">
                <label class="custom-file-label rounded-0">Image 3</label>
              </div>
            </div>

            <div class="col-4">
              <div class="anteprima m-3">
                @if (isset($images[0]))
                  @if (strpos($suite->main_image, 'lorempixel') == false)
                    <img id="output1" src="{{ asset('storage') . "/" . $images[0]->path}}" alt="{{$suite->title}}">
                   @else
                   <img id="output1" src="{{ $images[0]->path }}" alt="{{ $suite->title }}">
                  @endif
                @endif
              </div>
            </div>
            <div class="col-4">
              <div class="anteprima m-3">
                @if (isset($images[1]))
                  @if (strpos($suite->main_image, 'lorempixel') == false)
                    <img id="output2" src="{{ asset('storage') . "/" . $images[1]->path}}" alt="{{$suite->title}}">
                   @else
                   <img id="output2" src="{{ $images[1]->path }}" alt="{{ $suite->title }}">
                  @endif
                @endif
              </div>
            </div>
            <div class="col-4">
              <div class="anteprima m-3">
                @if (isset($images[2]))
                  @if (strpos($suite->main_image, 'lorempixel') == false)
                    <img id="output3" src="{{ asset('storage') . "/" . $images[2]->path}}" alt="{{$suite->title}}">
                   @else
                   <img id="output3" src="{{ $images[2]->path }}" alt="{{ $suite->title }}">
                  @endif
                @endif
              </div>
            </div>

            <script>
            var loadFile = function(event) {
            	var image = document.getElementById('output');
            	image.src = URL.createObjectURL(event.target.files[0]);
            };
            var loadFile1 = function(event) {
            	var image = document.getElementById('output1');
            	image.src = URL.createObjectURL(event.target.files[0]);
            };
            var loadFile2 = function(event) {
            	var image = document.getElementById('output2');
            	image.src = URL.createObjectURL(event.target.files[0]);
            };
            var loadFile3 = function(event) {
            	var image = document.getElementById('output3');
            	image.src = URL.createObjectURL(event.target.files[0]);
            };
            </script>
            {{-- end Edit images --}}

          </div>
          {{-- end Edit Price-Cover --}}

          {{-- Edit Description --}}
          <div class="create_description form-group row">
            <div class="col-12">
              <div class="input_box">
                <textarea
                  type="text"
                  name="description"
                  rows="8" cols="80"
                  class="form-control rounded-0"
                  placeholder="Description">{{ old('description') ? old('description') : $suite->description }}</textarea>
              </div>
            </div>
          </div>
          {{-- end Edit Description --}}

          {{-- Edit Services --}}
          <div class="create_services row">
            <div class="col-12">
              <div class="checkbox">
                <div class="row">
                  {{-- <h3>Lista servizi</h3> --}}

                  {{-- Checkbox --}}
                  @foreach ($services as $service)
                  <div class="col-4 col-lg-2 text-center">
                    <label class="container_checkbox"><i class="{{ $service->icon }}"></i>
                      <input type="checkbox" name="services[]" value="{{ $service->id }}" {{ ($suite->services->contains($service)) ? "checked" : '' }}>
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  @endforeach
                  {{-- end Checkbox --}}

                </div>
              </div>
            </div>
          </div>
          {{-- end Edit Services --}}

          {{-- Submit Login --}}
          <div class="form_submit form-group justify-content-center row">
            <div class="col-12">
              <div class="button_submit">
                <button type="submit" class="custom_button">Modifica</button>
              </div>
            </div>
          </div>
        </div>
        {{-- end Edit suite --}}

      </form>
      {{-- end Form Edit --}}

    </div>
  </div>
  {{-- end Bootstrap --}}

      <input type="search" id="address_create" name="address" value="{{old('address')}}" placeholder="Dove si trova?" />
      <input class="d-none" id="latitude" type="text" name="latitude" value="{{old('latitude')}}">
      <input class="d-none" id="longitude" type="text" name="longitude" value="{{old('longitude')}}">

@endsection
