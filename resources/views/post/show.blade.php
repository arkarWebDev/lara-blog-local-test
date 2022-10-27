@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Post Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("post.index") }}" class="text-dark text-decoration-none">Post List</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Post Details</span></li>
  </ol>
</nav>
<div class="card">
    <div class="card-body">
      @if (isset($post->feature_image))
        <img src="{{ asset("storage/". $post->feature_image) }}" class="w-100 mb-3">
      @else
        <p class="w-100 bg-dark text-center text-white fs-5">This post is not included featue image .</p>
      @endif
        <div>
            <p class="m-0">
              <i class="fa-regular fa-folder"></i> |
              <span class="">{{ \App\Models\Category::find($post->category_id)->title }}</span>
            </p>
            <div></div>
            <p class="m-0">
              <i class="fa-regular fa-user"></i> |
              <span class="">{{ \App\Models\User::find($post->user_id)->name }}</span>
            </p>
            <p class="m-0">
              <i class="fa-regular fa-calendar"></i> |
              <span class="">{{ $post->created_at->format("d M o") }}</span>
              <div></div>
              <i class="fa-regular fa-clock"></i> |
              <span class="">{{ $post->created_at->format("g:h A") }}</span>
            </p>
        </div>
        <h2 class=" text-center my-3">{{ $post->title }}</h2>
        <p class=" text-black-50">{{ $post->description }}</p>
    </div>
</div>
@endsection