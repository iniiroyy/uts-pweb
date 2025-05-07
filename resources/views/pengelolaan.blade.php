@extends('layouts.app')

@section('content')
<h2>Daftar Tugas & Deadline</h2>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Judul Tugas</th>
            <th>Deadline</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tugas as $item)
        <tr
            @if ($item['status'] === 'overdue') class="table-danger"
            @elseif ($item['status'] === 'today') class="table-warning"
            @endif
        >
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['judul'] }}</td>
            <td>{{ \Carbon\Carbon::parse($item['deadline'])->format('d M Y') }}</td>
            <td>{{ $item['sisa'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
