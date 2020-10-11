{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 p-0">

      {{-- Controllo se ci sono messaggi presenti per gli appartamenti dell'utente --}}
      @php
        $presenti = false;
      @endphp

      @foreach ($messages as $message)
        @if ($message->suite->user_id == $user->id)
          @php
            $presenti = true;
          @endphp
        @endif
      @endforeach

      {{-- Visualizzo i messaggi ricevuti --}}
      @if ($presenti)
        <h2 class="titolo_mail">Mail arrivate per i tuoi appartamenti:</h2>
        @foreach ($messages->reverse() as $message)
          @if (!is_null($message->suite))

            @if ($message->suite->user_id == $user->id)

              <!-- Apertura lista mail -->
              <div class="lista_mail">
                <!-- Singola mail -->
                <div class="mail">

                  <a href="#" data-toggle="modal" data-target="{{"#".$message->name}}">
                    {{-- Email --}}
                    <div class="nome_mail">
                      <span><strong>{{$message->email}}</strong></span>
                    </div>

                    {{-- Body --}}
                    <div class="body_mail">
                      <?php $testo = substr($message->body,0,110); ?>
                      <span class="chiaro">{{ $testo }}...</span>
                    </div>
                  </a>

                  {{-- Collegamento alla suite --}}
                  <span><a href="{{route('suites.show',  $message->suite_id)}}">Link suite</a></span>

                  {{-- Orario/data ricevuto messaggio --}}
                  <div class="orario">
                    @php
                    $ore = '';
                    $mese = '';
                    $giorno = '';
                    $mese = '';
                    $now->subDays(1);

                    if ($now > $message->created_at) {
                      $giorno = $message->created_at->day;
                      $mese = $message->created_at->month;
                    }else {
                      $ore = $message->created_at->hour;
                      $minuti = $message->created_at->minute;
                      if ($minuti < 10) {
                        $minuti = '0' . $minuti;
                      }
                    }
                    @endphp
                    <span>
                      @if ($ore != '')
                        {{$ore}}:{{$minuti}}
                      @else
                        {{$giorno}}/{{$mese}}
                      @endif
                    </span>

                    <!-- Modal visualizzato al click del messaggio -->
                    <div class="modal fade" id="{{$message->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$message->email}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body p-3">
                            {{$message->body}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Fine singola mail -->
              </div>

            @endif
          @endif
        @endforeach
      @else

        {{-- Se non ci sono messaggi per l'utente --}}
        <h2 class="titolo_mail">Non ci sono mail per i tuoi appartamenti</h2>
        <!-- Apertura lista mail -->
        <div class="lista_mail">
          <!-- Singola mail -->
          <div class="mail">

            <div class="nome_mail">
              <span><strong>{{$user->email}}</strong></span>
            </div>

            <div class="body_mail">
              Non ci sono messaggi
            </div>
            <br>
            <div class="orario">
              <span>{{$now}}</span>
            </div>

          </div>
        </div>
      @endif

      </div>
    </div>
  </div>
@endsection
