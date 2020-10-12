{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="wrapper_mysuites my-5">

        {{-- Se sono presenti appartamenti all'utente --}}
        @if (is_array($my_suites))
          <h4>These are your suites.</h4>
          <div class="container_table d-flex justify-content-center">
            <table border="1" class="text-center">
              <tr>
                <th>Cover</th>
                <th>Title</th>
                <th>Address</th>
                <th>Price</th>
                <th>Messages</th>
                <th>Sponsorship</th>
                <th>Controls</th>
              </tr>
            @foreach ($my_suites as $my_suite)
              <tr>
                {{-- Immagine copertina --}}
                <td>
                  @if (strpos($my_suite->main_image, 'lorempixel') == false)
                   <img src="{{asset('storage').'/'.$my_suite->main_image}}" alt="{{$my_suite->title}}">
                  @else
                   <img src="{{ $my_suite->main_image }}" alt="{{ $my_suite->title }}">
                 @endif
                </td>
                {{-- Titolo --}}
                <td><a href="{{route('suites.show', $my_suite)}}">{{$my_suite->title}}</a></td>

                {{-- Address --}}
                <td>{{$my_suite->address}}</td>

                {{-- Price --}}
                <td>{{$my_suite->price}}€</td>

                {{-- Messaggi ricevuti --}}
                <td>
                  <a href="{{route('admin.email.messages.index', $my_suite)}}">
                    <?php $messagges = []; ?>
                    @foreach ($my_suite->messages as $message)
                      <?php $messagges[] = $message->suite_id; ?>
                    @endforeach
                    <div>
                      <span>{{count($messagges)}}</span>
                      <i class="far fa-envelope"></i>
                    </div>
                  </a>
                </td>

                {{-- Highlights --}}
                <td>
                  @if (!$my_suite->highlights->isEmpty())
                    @foreach ($my_suite->highlights as $highlight)
                      {{$highlight->name}}
                      <i class="far fa-money-bill-alt"></i>
                    @endforeach
                  @else
                    <div class="controlli">
                      Nessuna
                      <div>
                        <button type="button" class="btn">
                          <a href="{{ route("admin.promotion", $my_suite)}}"> Sponsor</a>
                        </button>
                      </div>
                    </div>
                  @endif
                </td>

                {{-- Controlli --}}
                <td class="controlli">
                  <div>
                    <button type="button" class="btn">
                      <a href="{{ route("admin.suites.edit", $my_suite)}}"> Change</a>
                    </button>
                  </div>

                  <div>
                    <button type="button" class="btn">
                      <a href="{{ route("admin.suites.static", $my_suite)}}"> Statistics</a>
                    </button>
                  </div>

                  <form action="{{ route('admin.suites.destroy', $my_suite)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger left m-1" type="submit" value="Delete">
                  </form>
                </td>

              </tr>
            @endforeach
            </table>
          </div>

        @else

          {{-- Se non ci sono appartamenti all'utente --}}
          <div class="vuoto">
            <h3 class="mb-0">You have not suites</h3>
          </div>
        @endif

        </div>
      </div>
    </div>
  </div>
@endsection
