@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">User Management</span></li>
    <li class="breadcrumb-item"><a href="{{ route("user.index") }}" class=" text-decoration-none text-dark">User List</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">User Datails</span></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark fw-bold">{{ $user->name }}</span></li>
  </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h3 class=" fw-bold m-0">Account Deatils</h3>
        <hr>
        <div class="row">
            <div class="col-7">
                <p class=" fs-6 text-black-50 fw-bold">Username : <span class="text-dark">{{ $user->name }}</span></p>
                <p class=" fs-6 text-black-50 fw-bold">Email : <span class="text-dark">{{ $user->email }}</span></p>
                <p class=" fs-6 text-black-50 fw-bold">Role : 
                    @if($user->role == 0)
                    <span class="m-0 text-dark fs-6"><i class="fa-solid fa-user-shield me-1"></i>Admin</span>
                    @elseif ($user->role == 1)
                    <span class="m-0 text-dark fs-6"><i class="fa-solid fa-user-pen me-1"></i>Editor</span>
                    @elseif ($user->role == 2)
                    <span class="m-0 text-dark fs-6"><i class="fa-solid fa-user-check me-1"></i>Verified User</span>
                @endif
                </p>
                <p class=" fs-6 text-black-50 fw-bold">Country : <span class="text-dark">{{ $user->nation->name }}</span></p>
                <p class=" fs-6 text-black-50 fw-bold">Account created at : <span class="text-dark">{{ $user->created_at->format("d M o g:i A") }}</span></p>
            </div>
            <div class="col-5 d-flex justify-content-end pe-4">
                <div style="width: 130px;height: 130px" class="rounded-circle border border-3 border-dark p-2 overflow-hidden mt-4">
                    <img src="{{ asset("admin.jpg") }}" class="w-100">
                </div>
            </div>
        </div>
        <h3 class=" fw-bold m-0">Added Categories</h3>
        <hr>
        @forelse ($user->categories as $category)
            <span class=" badge rounded bg-dark" style="font-size: 13px">{{ $category->title }}</span>
        @empty
            <p class="m-0 fw-bold fs-5">No category added currently.</p>
        @endforelse

        <h3 class=" fw-bold m-0 mt-4">Recent Posts</h3>
        <hr>
        <div class="row">
            @forelse ($user->posts()->limit(8)->get() as $post)
                <div class="col-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route("post.show",$post->id) }}" class="text-decoration-none">
                                <h5 class="text-black fw-bold hv-ef">{{ Str::substr($post->title, 0, 30) }}</h5>
                            </a>
                            <p class=" text-black-50">{{ Str::substr($post->description, 0, 60) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="m-0">No post added currently.</p>
            @endforelse
            <div class="col-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route("user.allpost") }}" class=" text-decoration-none text-dark">
                            <i class="fa-solid fa-arrow-right fs-1 mt-2"></i>
                            <div></div>
                            <h5 class="text-black fw-bold hv-ef mt-3">See all posts</h5>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            <h3 class=" fw-bold m-0 mt-4">Photos From Posts</h3>
            <hr>
            <div class="grid-ctr">
            @forelse ($user->subImgs as $img)
                <img src="{{ asset("storage/" . $img->name) }}"  class="w-100 me-3 mb-3 rounded">
            @empty
                <p class="m-0">No photo added yet.</p>
            @endforelse
            @foreach ($user->posts as $img)
                @if ($img->feature_image != NULL)
                    <img src="{{ asset("storage/" . $img->feature_image) }}"  class=" w-100 me-3 mb-3 rounded">
                @endif
            @endforeach
            </div>
        </div>
    </div>
    
</div>
@endsection