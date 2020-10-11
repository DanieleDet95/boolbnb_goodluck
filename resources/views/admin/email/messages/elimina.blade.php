<h2>Mail arrivata:</h2>
@foreach ($messages as $message)

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Hai eliminato le suite: {{ $eliminated->title }}</h1>
      </div>
    </div>
  </div>

@endforeach
