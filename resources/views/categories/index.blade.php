<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Categories</title>
</head>
<body>
    <div class="mx-auto" style="width: 1100px;">
        <h1>Categories</h1>
        @if (session()->has('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                {{ session()->get('success') }}
            </div>
        @endif
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
                        <td><button type="button" class="btn btn-primary">Edit</button></td>
                        <td> <button type="button" class="btn btn-danger">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
