<h2>Daftar User</h2>
<ul>
  @foreach($lesson->users as $user)
    <li>{{ $user->name }} - {{ $user->pivot->created_at }} - {{ $user->pivot->data_lain }}</li>
  @endforeach
</ul>

<h2>Daftar User</h2>
<ul>
  @foreach($lesson->likes as $like)
    <li>{{ $like->likeable_type }}</li>
  @endforeach
</ul>
<h3>Jumlah Like : {{ $lesson->likes->count() }}</h3>

<h2>Daftar Tag</h2>
<ul>
  @foreach($lesson->tags as $tag)
    <li>{{ $tag->name }}</li>
  @endforeach
</ul>