@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">User Management</span></li>
    <li class="breadcrumb-item"><a href="{{ route("user.index") }}" class=" text-decoration-none text-dark">User List</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">User Datails</span></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark fw-bold">{{ Auth::user()->name }}</span></li>
  </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h3 class=" text-black-50">Post from <span class=" text-black fw-semibold">{{ Auth::user()->name }}</span></h3>
        <hr>
        <div class="row">
            @forelse ($finalUser as $post)
                <div class="col-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route("post.show",$post->id) }}" class="text-decoration-none">
                                <h5 class="text-black fw-bold hv-ef">{{ Str::substr($post->title, 0, 30) }}</h5>
                            </a>
                            <p class=" text-black-50">{{ Str::substr($post->description, 0, 100) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="m-0">No post added currently.</p>
            @endforelse
        </div>
        <div>
          <div></div>
          <div>{{ $finalUser->onEachSide(1)->links() }}</div>
        </div>
    </div>
</div>
@endsection