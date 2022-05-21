<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Add Category</title>
</head>

<body>
    <div class="mx-auto" style="width: 1000px;">
        <h1>Add Category</h1>
        <form method="POST" action="/categories/create">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName">
            </div>
            <div class="mb-3">
                <label for="description">Category Description</label>
                <textarea class="form-control" name="description" placeholder="Leave a description here" id="floatingTextarea2"
                    style="height: 200px"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Add Image</label>
                <input type="file" name="image" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label"> Parent</label>
                <select class="form-select" aria-label="Default select example" name="parent_id">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>
