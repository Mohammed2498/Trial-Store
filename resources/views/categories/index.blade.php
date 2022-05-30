@extends('layout.app')
@section('page_title', 'Categories')
@section('content')
    <div class="mx-auto" style=" width: 80%">
        <div class="d-grid gap-2">
            <a href="{{ route('categories.create') }}"><button type="button" class="btn btn-primary btn-lg">Add
                    Category</button></a>
        </div>
        {{-- @if (session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                {{ session()->get('success') }}
            </div>
        </div>
    @endif --}}
        <x-flash.message />
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Catgory Name</th>
                    <th scope="col">Category Description</th>
                    <th scope="col">Category Slug</th>
                    <th scope="col">Edit Category</th>
                    <th scope="col">Delete Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->slug }}</td>
                        <td><a href="{{ route('categories.edit', $category->id) }}"><button type="button"
                                    class="btn btn-primary">Edit</button></a></td>

                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="sumbit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection('content')
