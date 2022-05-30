@extends('layout.app')
@section('page_title', 'Add Category')
@section('content')
    <div class="mx-auto" style="width: 80%">
        <h1>Add Category</h1>
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            @include('categories.partials.form')
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/categories" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection('content')
