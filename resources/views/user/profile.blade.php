{{-- Return Collection --}}
{{-- {{ dd($user->forums) }} --}}

{{-- Return hasMany --}}
{{-- {{ dd($user->forums()) }} --}}

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

<h2>Test querying relationship</h2>
<ul>
  @foreach($user->forums()->where('id', 1)->get() as $forum)
    <li>{{ $forum->title }}</li>
  @endforeach
</ul>

<h2>Mengeluarkan yang hanya memiliki Tag</h2>
<ul>
  @foreach($user->forums()->has('tags')->get() as $forum)
    <li>
      {{ $forum->title }}
      || Tag : 
      @foreach($forum->tags as $tag)
        {{ $tag->name }}
      @endforeach
    </li>
  @endforeach
</ul>

<h2>Output dengan lebih dari satu tag</h2>
<ul>
  @foreach($user->forums()->has('tags', '>', '1')->get() as $forum)
    <li>
      {{ $forum->title }}
      || Tag : 
      @foreach($forum->tags as $tag)
        {{ $tag->name }}
      @endforeach
    </li>
  @endforeach
</ul>

<h2>Output dengan kurang dari satu tag</h2>
<ul>
  @foreach($user->forums()->has('tags', '<', '1')->get() as $forum)
    <li>
      {{ $forum->title }}
      || Tag : 
      @foreach($forum->tags as $tag)
        {{ $tag->name }}
      @endforeach
    </li>
  @endforeach
</ul>

<h2>Output hanya jumlah count nya saja</h2>
<ul>
  @foreach($userForumCount as $ufc)
    <li> 
      {{-- Penulisan pemanggilan method count harus "$ufc->namaTable_count" --}}
      {{ $ufc->name.' : '.$ufc->forums_count }}
    </li>
  @endforeach
</ul>