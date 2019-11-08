<h1>
  Halo {{ $user->name }}, no. passport anda adalah {{ $user->passport->no_pass }}
</h1>

<h2>Daftar Forum</h2>

<ul>
  @foreach($user->forums as $forum)
    <li>{{ $forum->title }}</li>
  @endforeach
</ul>