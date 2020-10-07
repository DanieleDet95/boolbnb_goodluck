{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>Le mie suites</h1>
  {{-- Cicliamo le suites del database per stampare le suite create dall'utente loggato --}}
  @if (is_array($my_suites))
    <h4>Questi sono i tuoi appartamenti</h4>
    <table border="1" class="text-center">
      <tr>
        <th>Copertina</th>
        <th>Titolo</th>
        <th>Indirizzo</th>
        <th>Prezzo</th>
        <th>Messaggi</th>
        <th>Sponsorizzazione</th>
        <th>Controlli</th>
      </tr>
    @foreach ($my_suites as $my_suite)
      <tr>
        <td>
          @if (strpos($my_suite->main_image, 'lorempixel') == false)
           <img src="{{asset('storage').'/'.$my_suite->main_image}}" alt="{{$my_suite->title}}">
          @else
           <img src="{{ $my_suite->main_image }}" alt="{{ $my_suite->title }}">
         @endif
        </td>
        <td><a href="{{route('suites.show', $my_suite)}}">{{$my_suite->title}}</a></td>
        <td>{{$my_suite->address}}</td>
        <td>{{$my_suite->price}}€</td>
        {{-- Messaggi --}}
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
            Nessuna
          @endif
        </td>
        {{-- Controlli --}}
        <td class="controlli">
          <div>
            <button type="button" class="btn">
              <a href="{{ route("admin.suites.edit", $my_suite)}}"> Modifica</a>
            </button>
          </div>

          <div>
            <button type="button" class="btn">
              <a href="{{ route("admin.suites.static", $my_suite)}}"> Statistiche</a>
            </button>
          </div>
          <div>
            <button type="button" class="btn">
              <a href="{{ route("admin.promotion", $my_suite)}}"> Sponzorizza</a>
            </button>
          </div>
          <form action="{{ route('admin.suites.destroy', $my_suite)}}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger left m-1" type="submit" value="Elimina">
          </form>


        </td>

      </tr>
    @endforeach
    </table>
    <div>
      <a href="{{ route("suites.index")}}"> Torna a Index</a>
    </div>
  @else
    <h4>Non hai appartamenti registrati</h4>
  @endif
@endsection
