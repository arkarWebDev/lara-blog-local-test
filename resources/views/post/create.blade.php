@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Post Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("post.create") }}" class="text-dark text-decoration-none">Add Post</a></li>
  </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h2 class=" fw-bold">Create a new post.</h2>
        <p class=" fw-lighter text-black-50">Hello user. <br> 
        What happen in your mind ?
        </p>
        <form action="{{ route("post.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <div class="col-6">
                <label for="title" class="form-label">Write your post title here.</label>
                <input type="text" class=" form-control @error('title') is-invalid @enderror" name="title" value="{{ old("title") }}" id="title">
                @error("title")
                    <p class=" invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="col-6">
                <label for="category" class="form-label">Choose an category here.</label>
                <select name="category" id="category" class=" form-select @error('category') is-invalid @enderror">
                  @foreach (\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ old("category") == $category->id ? "selected" : "" }}>{{ $category->title }}</option>
                  @endforeach
                </select>
                 @error("category")
                    <p class=" invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <label for="description" class="form-label">Write your post description here.</label>
            <textarea name="description" id="description" rows="10" class=" form-control @error('description') is-invalid @enderror">{{ old("description") }}</textarea>
            @error("description")
                    <p class=" invalid-feedback">{{ $message }}</p>
            @enderror
            <div class="d-flex align-items-center justify-content-between mt-3">
              <div class="w-50">
                <label for="feature_image" class="form-label">Feature Image</label>
                <input type="file" name="feature_image" class=" form-control  @error('feature_image') is-invalid @enderror" id="feature_image">
                @error("feature_image")
                    <p class=" invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="w-25">
                <input type="submit" value="Post" class=" btn btn-dark btn-lg mt-4 w-100">
              </div>
            </div>
        </form>
    </div>
</div>
@endsection