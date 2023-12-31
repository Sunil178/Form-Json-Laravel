@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
@endsection
@section('content')

@if (session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<h1>All page list <a href="{{ route('pages.create') }}" class="btn btn-secondary btn-add"></a></h1>
<table class="rwd-table">
    <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Name</th>
            <th>Number</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $page->name }}</td>
                <td>{{ $page->number }}</td>
                <td>
                    <a href="{{ route('pages.schema_edit', $page->id) }}" class="btn btn-green"><span>&#9998;</span>Schema</a>
                    <a href="{{ route('pages.content_edit', $page->id) }}" class="btn btn-blue"><span>&#x270e;</span>Content</a>
                    <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-blue delete-btn" type="button"><span>&#128465;</span>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $('.delete-btn').on('click', function (event) {
        if (confirm("Are you sure to delete this page?") == true) {
            $(this).closest('form').submit();
        }
    });
</script>

@endsection
