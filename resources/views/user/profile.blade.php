<h1>
  Halo {{ $user->name }}, no. passport anda adalah {{ $user->passport->no_pass }}
</h1>

<h2>Daftar Forum</h2>

<ul>
  @foreach($user->forums as $forum)
    <li>{{ $forum->title }}
      {{-- Nested eager loading --}}
      || Tag : 
      @foreach($forum->tags as $tag)
        {{ $tag->name }}
      @endforeach
    </li>
  @endforeach
</ul>

<h2>Daftar Kelas</h2>
<ul>
  @foreach($user->lessons as $lesson)
    <li>{{ $lesson->title }}</li>
  @endforeach
</ul>