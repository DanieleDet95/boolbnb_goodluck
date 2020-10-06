{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

      <h2 class="titolo_mail">Mail arrivate per i tuoi appartamenti:</h2>
      @foreach ($messages as $message)
        @if (!is_null($message->suite))

          @if ($message->suite->user_id == $user->id)
            <!-- Apertura lista mail -->
            <div class="lista_mail">
              <!-- Singola mail -->
              <div class="mail">

                <a href="#" data-toggle="modal" data-target="{{"#".$message->name}}">
                  <div class="nome_mail">
                    <span><strong>{{$message->email}}</strong></span>
                  </div>

                  <div class="body_mail">
                    <?php $testo = substr($message->body,0,130); ?>
                    <span class="chiaro">{{ $testo }}...</span>
                  </div>
                </a>

                <span><a href="{{route('suites.show',  $message->suite_id)}}">Suite id: {{$message->suite_id}}</a></span>

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

                  <!-- Modal -->
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
      
      <div>
        <a href="{{ route("suites.index")}}"> Torna a Index</a>
      </div>

      </div>
    </div>
  </div>
@endsection
