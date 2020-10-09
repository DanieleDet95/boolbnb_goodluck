{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  {{-- Container-fluid --}}
  <div class="container-fluid container-md">
    {{-- Row Title Images --}}
    <div class="row flex-column flex-nowrap mt-3 row_title_img">
      {{-- Prima riga fatta da titolo e indirizzo --}}
      <div class="mx-3 title_show">
        <h2>{{$suite->title}}</h2>
        <h6>{{$suite->address}}</h6>
      </div>
      <hr>
      {{-- Seconda riga fatta dalle immagini e dalla main image --}}
      <div class="img_show d-flex flex-wrap">
        {{-- Immagine copertina --}}
        <div class="main_image_show col-5">
          @if (isset($suite->main_image))
            @if (strpos($suite->main_image, 'lorempixel') == false)
              <img class="rounded mx-auto d-block" src="{{ asset('storage') . "/" . $suite->main_image}}" alt="{{$suite->title}}">
             @else
             <img class="rounded mx-auto d-block" src="{{ $suite->main_image }}" alt="{{ $suite->title }}">
            @endif
          @endif
        </div>
        {{-- Immagini di supporto --}}
        <div class="images_show d-flex flex-wrap col-7">
          @foreach ($suite->images as $image)
            <div class="col-6">
              @if (isset($image->path))
                @if (strpos($image->path, 'lorempixel') == false)
                  <img class="rounded mx-auto d-block" src="{{ asset('storage') . "/" . $image->path}}" alt="{{$suite->title}}">
                 @else
                  <img class="rounded mx-auto d-block" src="{{ $image->path }}" alt="{{ $suite->title }}">
                @endif
              @endif
            </div>
          @endforeach
        </div>
      </div>
      {{-- Fine seconda riga di immagini --}}
      <hr>
    </div>
    {{-- Fine Row Tile Images --}}
    {{-- Row Details --}}
    <div class="row row_info">
      <div class="col-12 my_suite_description">
        <p>{{$suite->description}}</p>
      </div>

      <div class="col-6 my_suite_info">
        <h4>Suite Infos</h4>
        <ul class="list_infos mb-0">
          <li>Rooms: {{$suite->rooms}}</li>
          <li>Beds: {{$suite->beds}}</li>
          <li>Baths: {{$suite->baths}}</li>
          <li>Square Meters: {{$suite->square_m}}</li>
          <li>Price: {{$suite->price}} €/night</li>
        </ul>
      </div>

      <div class="col-6 my_suite_services">
        @if (!$suite->services->isEmpty())
          <h4>Suite Services</h4>
          <ul class="list_services mb-0">
          @foreach ($suite->services as $service)
            <li><i class="{{ $service->icon }}"></i> {{ $service->supplements }}</li>
          @endforeach
          </ul>
        @endif
      </div>
      <hr class="w-100">
    </div>
    {{-- Fine Row Details --}}
    {{-- Row Message --}}
    <div class="row row_message">
      <div class="mb-3 message_to_landowner">
        <div class="mx-3 my_landowner_info">
          <h3>Write to owner
            <span>
              @if (!empty($suite->user->name))
                {{$suite->user->name}}
              @endif
              @if (!empty($suite->user->lastname))
                {{$suite->user->lastname}}
              @endif
            </span>
          </h3>
        </div>
      </div>
    </div>
    {{-- Fine Row Message --}}
    {{-- Row Form --}}
    <div class="row row_form">
      <div class="col-6">
        @if (!is_null($user))

          @if (!($suite->user_id === $user->id))

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="list-group">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{route("suites.store_message", $suite)}}" method="post">
              @csrf
              @method("POST")

              <div class="form-group input_box email_message">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{ old("email") }}" placeholder="name@example.com">
              </div>
              <div class="form-group input_box name_message">
                <label for="exampleFormControlInput1">Insert your name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ old("name") }}" placeholder="Mario Rossi">
              </div>
              <div class="mb-3 input_box body_message">
                <label for="validationTextarea">Write your email</label>
                <textarea class="form-control" id="validationTextarea" name="body" rows="4" cols="80" placeholder="..." required>{{ old("body") }}</textarea>
              </div>

              <div class="submit_message mail">
                <input class="send_message" id="submit" type="submit" value="Send">
              </div>

            </form>

          @endif

        @else

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

            {{-- <div> --}}
            <form action="{{route("suites.store_message", $suite)}}" method="post">
              @csrf
              @method("POST")

              <div class="form-group input_box email_message">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{ old("email") }}" placeholder="name@example.com">
              </div>
              <div class="form-group input_box name_message">
                <label for="exampleFormControlInput1">Insert your name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ old("name") }}" placeholder="Mario Rossi">
              </div>
              <div class="mb-3 input_box body_message">
                <label for="validationTextarea">Write your email</label>
                <textarea class="form-control" id="validationTextarea" name="body" rows="4" cols="80" placeholder="..." required>{{ old("body") }}</textarea>
              </div>

              <div class="submit_message mail">
                <input class="send_message" id="submit" type="submit" value="Send">
              </div>

            </form>

        @endif
      </div>
      <div class="col-6">
        <div id="map"></div>
      </div>

    </div>
    {{-- Fine Row Form --}}
  </div>
  {{-- Fine Container-fluid --}}
@endsection
