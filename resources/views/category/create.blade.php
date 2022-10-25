@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Category Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("category.create") }}" class="text-dark text-decoration-none">Add Category</a></li>
  </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h2 class=" fw-bold">Create a new category.</h2>
        <p class=" fw-lighter text-black-50">Hello admin. <br> 
        Now you can add a new category now.
        </p>
        <form action="{{ route("category.store") }}" method="post">
            @csrf
            <input type="text" class=" form-control @error('title') is-invalid @enderror" name="title" value="{{ old("title") }}">
            @error("title")
                <p class=" invalid-feedback">{{ $message }}</p>
            @enderror
            <input type="submit" value="Add Category" class=" btn btn-dark mt-3">
        </form>
    </div>
</div>
@endsection