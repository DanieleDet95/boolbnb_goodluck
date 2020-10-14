{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        @if (is_array($my_suites))
          <div class="pieno mt-4">
            <h4>These are your suites.</h4>
          </div>

          <table class="table my-4">
            <thead class="thead my_thead">
              <tr>
                <th class="border-0" scope="col">Cover</th>
                <th class="border-0" scope="col">Title</th>
                <th class="border-0 d-none d-lg-block d-xl-block" scope="col">Address</th>
                <th class="border-0" scope="col">Price</th>
                <th class="border-0" scope="col">Messages</th>
                <th class="border-0" scope="col">Sponsorship</th>
                <th class="border-0" scope="col">Controls</th>
              </tr>
            </thead>
            <tbody class="border-0">
              @foreach ($my_suites as $my_suite)
                <tr class="border-top-0 border-bottom">
                  {{-- Immagine copertina --}}
                  <td class="border-0">
                    @if (strpos($my_suite->main_image, 'lorempixel') == false)
                     <img src="{{asset('storage').'/'.$my_suite->main_image}}" alt="{{$my_suite->title}}">
                    @else
                     <img src="{{ $my_suite->main_image }}" alt="{{ $my_suite->title }}">
                   @endif
                  </td>
                  {{-- Titolo --}}
                  <td class="border-0"><a href="{{route('suites.show', $my_suite)}}">{{$my_suite->title}}</a></td>

                  {{-- Address --}}
                  <td class="border-0 d-none d-lg-block d-xl-block">{{$my_suite->address}}</td>

                  {{-- Price --}}
                  <td class="border-0">{{$my_suite->price}}$</td>

                  {{-- Messaggi ricevuti --}}
                  <td class="border-0">
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
                  <td class="border-0">
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
                  <td class="border-0 controlli">
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
            </tbody>
          </table>
      @else

        {{-- Se non ci sono appartamenti all'utente --}}
        <div class="vuoto my-4">
          <h3 class="mb-0">You have not suites</h3>
        </div>
      @endif


      </div>
    </div>
  </div>
@endsection
