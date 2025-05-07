@extends('layouts.app')

@section('content')
<h2>Profile</h2>
<p>Halo <strong>{{ $username }}</strong>, ini adalah profil kamu .</p>

<ul class="list-group">
    <li class="list-group-item">Username: {{ $username }}</li>
    <li class="list-group-item">Status: Mahasiswa</li>
    <li class="list-group-item">Semester: 4</li>
</ul>
@endsection
