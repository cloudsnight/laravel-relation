<h2>Daftar User</h2>
<ul>
  @foreach($lesson->users as $user)
    <li>{{ $user->name }}</li>
  @endforeach
</ul>