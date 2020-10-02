<h2>Mail arrivata:</h2>
@foreach ($messages as $message)

  <table border="1" class="mt-3 m-1">
    <tr>
      <td>Nome</td>
      <td>Mail</td>
      <td>Messaggio</td>
    </tr>
    <tr>
      <td>{{$message->name ? $message->name : $message->email }}</td>
      <td>{{$message->email}}</td>
      <td>{{ $message->body }}</td>
    </tr>
  </table>

@endforeach
