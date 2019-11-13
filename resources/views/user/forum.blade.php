<h2>Daftar Tag</h2>
<ul>
  @foreach($forum->tags as $tag)
    <li>{{ $tag->name }}</li>
  @endforeach
</ul>