@extends('layout.app')
@section('page_title', 'Edit Category')
@section('content')
    <div class="mx-auto" style="width: 80%">
        @method('PUT')
        <h1>Edit Category</h1>
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')
            @include('categories.partials.form')
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/categories" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection('content')
