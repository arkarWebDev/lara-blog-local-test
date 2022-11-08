@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Post Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Edit Post</span></li>
  </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h2 class=" fw-bold">Edit your post.</h2>
        <p class=" fw-lighter text-black-50">Hello <span class="text-dark">{{  \App\Models\User::find($post->user_id)->name }}</span><br> 
        What changes in your mind ?
        </p>
        <form action="{{ route("post.update",$post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="row mb-3">
              <div class="col-6">
                <label for="title" class="form-label">Write your post title here.</label>
                <input type="text" class=" form-control @error('title') is-invalid @enderror" name="title" value="{{ old("title",$post->title) }}" id="title">
                @error("title")
                    <p class=" invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="col-6">
                <label for="category" class="form-label">Choose an category here.</label>
                <select name="category" id="category" class=" form-select @error('category') is-invalid @enderror">
                  @foreach (\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" 
                      {{ old("category",$post->category_id) == $category->id ? "selected" : "" }}>
                      {{ $category->title }}</option>
                  @endforeach
                </select>
                 @error("category")
                    <p class=" invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <label for="subImgs" class="form-label">Sub Images</label>
            <div class="d-flex">
            @foreach ($post->subImgs as $img)
              <div class=" d-flex position-relative">
                <div class=" position-absolute w-100 h-100 text-center pt-5" style="background: rgba(255, 255, 255, .4)">
                  <i class="fa-regular fa-circle-xmark fs-2 text-dark"></i>
                </div>
                <img src="{{ asset("storage/" . $img->name) }}" style="width: 100px;height: 100px;" class="rounded me-1">
              </div>
            @endforeach
            </div>
            <input type="file" name="subImgs[]" class=" form-control mt-3 mb-3  
            @error('subImgs') is-invalid @enderror
            @error('subImgs.*') is-invalid @enderror" 
            id="subImgs"
            multiple>
            @error("subImgs.*")
                <p class=" invalid-feedback">{{ $message }}</p>
            @enderror
            @error("subImgs")
                <p class=" invalid-feedback">{{ $message }}</p>
            @enderror
            <label for="description" class="form-label">Write your post description here.</label>
            <textarea name="description" id="description" rows="10" class=" form-control @error('description') is-invalid @enderror">{{ old("description",$post->description) }}</textarea>
            @error("description")
                    <p class=" invalid-feedback">{{ $message }}</p>
            @enderror
            <div class="d-flex align-items-center mt-3 flex-column">
              <div class="w-100">
                <label for="feature_image" class="form-label">Feature Image</label>
                @if ($post->feature_image)
                  <img src="{{ asset("storage/".$post->feature_image) }}" class="w-100 mb-3">
                @else
                  <p class=" fw-bold">This post does not have feature image .</p>
                @endif
                <input type="file" name="feature_image" class=" form-control w-50  @error('feature_image') is-invalid @enderror" id="feature_image">
                @error("feature_image")
                    <p class=" invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="w-100">
                <input type="submit" value="Update Post" class=" btn btn-dark btn-lg mt-4 w-100">
              </div>
            </div>
        </form>
    </div>
</div>
@endsection