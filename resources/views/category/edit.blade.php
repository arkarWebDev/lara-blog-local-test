@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Category Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("category.create") }}" class="text-dark text-decoration-none">Edit Category</a></li>
  </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h2 class=" fw-bold">Edit your category.</h2>
        <p class=" fw-lighter text-black-50">Hello admin. <br> 
        Now you can edit your category now.
        </p>
        <form action="{{ route("category.update",$category->id) }}" method="post">
            @csrf
            @method("put")
            <input type="text" class=" form-control @error('title') is-invalid @enderror" name="title" value="{{ old("title",$category->title) }}">
            @error("title")
                <p class=" invalid-feedback">{{ $message }}</p>
            @enderror
            <input type="submit" value="Update Category" class=" btn btn-dark mt-3">
        </form>
    </div>
</div>
@endsection