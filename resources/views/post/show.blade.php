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
            <span class="m-0 bg-dark badge" style="font-size: 12px">
              <i class="fa-regular fa-folder"></i>
              <span class="">{{ $post->category->title }}</span>
            </span>
            <span class="m-0 bg-dark badge" style="font-size: 12px">
              <i class="fa-regular fa-user"></i>
              <span class="">{{ $post->user->name }}</span>
            </span>
            <p class="m-0 bg-dark badge" style="font-size: 12px">
              <i class="fa-regular fa-calendar"></i>
              <span class="">{{ $post->created_at->format("d M o") }}</span>
            </p>
        </div>
        <div class="text-center ">
          <h2 class="my-3 hv-ef">{{ $post->title }}</h2>
        </div>
        <p class=" text-black-50">{{ $post->description }}</p>
    </div>
</div>
@endsection