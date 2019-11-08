<h2>Daftar User</h2>
<ul>
  @foreach($lesson->users as $user)
    <li>{{ $user->name }} - {{ $user->pivot->created_at }} - {{ $user->pivot->data_lain }}</li>
  @endforeach
</ul>