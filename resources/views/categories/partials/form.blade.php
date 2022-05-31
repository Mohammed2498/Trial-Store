<div class="mb-3">
    <label for="name" class="form-label">Category Name</label>
    <input value="{{ old('name', $category->name ?? '') }}" type="text" name="name" class="form-control"
        id="exampleInputName">
</div>
{{-- @error('name')
    {{ $message }}
@enderror --}}
<div class="mb-3">
    <label for="description">Category Description</label>
    <textarea type="text" value="{{ old('description', $category->description ?? '') }}" class="form-control"
        name="description" id="floatingTextarea2" style="height: 150px"></textarea>
</div>
<div class="mb-3">
    <label for="image" class="form-label">Add Image</label>
    <input value="{{ old('image', $category->image ?? '') }}" type="file" name="image" class="form-control"
        id="exampleInputPassword1">
</div>
<div class="mb-3">
    <label for="parent_id" class="form-label"> Parent</label>
    <select class="form-select" aria-label="Default select example" name="parent_id">
        <option value="">Select Category</option>
        @foreach ($categories as $parent)
            <option value="{{ $parent->id }}" @if ($category->parent_id == $parent->id) selected @endif>
                {{ $parent->name }}</option>
        @endforeach
    </select>
</div>
