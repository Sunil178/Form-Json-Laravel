@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $page->page_name }}</h2>
        <p>Page Number: {{ $page->page_no }}</p>

        <form method="post" action="{{ url("/pages/{$page->id}") }}">
            @csrf
            <div class="mb-3">
                <label for="page_content" class="form-label">Page Content</label>
                <textarea class="form-control" id="page_content" name="page_content">{{ $page->page_content }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save Content</button>
            </div>
        </form>
    </div>
@endsection
