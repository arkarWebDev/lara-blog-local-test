@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">post Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("post.index") }}" class="text-dark text-decoration-none">Post List</a></li>
  </ol>
</nav>
<div class="d-flex align-items-center justify-content-between">
  <div>
  @if (request("keyword"))
  <div class=" border border-dark p-1 rounded d-flex align-items-center">
      <p class="m-0">search by <span>{{ request("keyword") }}</span></p>
      <a href="{{ route("post.index") }}" class=" text-decoration-none text-dark mt-1 pe-1">
        <i class="fa-solid fa-xmark fs-5 fw-bolder ms-2"></i>
      </a>
  </div>
  @endif
  </div>
  <div>
    <form action="{{ route("post.index") }}" method="get">
      <div class="d-flex align-items-center">
        <input type="text" class="form-control" placeholder="Search something ..." name="keyword">
        <button style="padding: 0;border: none;background: none">
          <i class="fa-solid fa-magnifying-glass fs-4 text-dark ms-2"></i>
        </button>
      </div>
    </form>
  </div>
</div>
<table class="table mt-3">
  <thead>
    <tr class=" table-dark">
      <th scope="col">Post Info</th>
      <th scope="col"></th>
      <th scope="col">Create at</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @forelse ($posts as $post)
      <tr>
        <th colspan="2">
          <p class="m-0">{{ $post->title }}</p>
          <div class="d-flex align-items-center">
            <span>
              <i class="fa-regular fa-folder"></i>
              <span class=" text-black-50">{{ \App\Models\Category::find($post->category_id)->title }}</span>
            </span>
            <i class="fa-solid fa-chevron-right mx-2" style="font-size: 10px"></i>
            <span>
              <i class="fa-regular fa-user"></i>
              {{ \App\Models\User::find($post->user_id)->name }}
            </span>
          </div>
        </th>
        <th>
          <p class=" m-0 text-sm text-black-50"><i class="fa-regular fa-calendar me-2"></i>{{ $post->created_at->format("d M o") }}</p>
          <p class=" m-0 text-sm text-black-50"><i class="fa-regular fa-clock me-2"></i>{{ $post->created_at->format("g:h A") }}</p>
        </th>
        <th class="pt-3"><a href="{{ route("post.edit",$post->id) }}"><i class="fa-regular fa-pen-to-square fs-4 text-dark"></i></a></th>
        <th class="pt-3">
          <form action="{{ route("post.destroy",$post->id) }}" method="post">
            @csrf
            @method("delete")
            <button type="submit" style="padding: 0;border: none;background: none">
              <i class="fa-solid fa-trash-can fs-4 text-danger"></i>
            </button>
          </form>
        </th>
        <th class=" pt-3">
          <a href="{{ route("post.show",$post->id) }}">
            <i class="fa-solid fa-arrow-up-right-from-square fs-4 text-dark"></i>
          </a>
        </th>
    @empty
    <th colspan="6">
      <p class="text-center fs-5">There is no post to show .</p>
    </th>
    @endforelse
    </tr>
  </tbody>
</table>
<div>
  <div></div>
  <div>{{ $posts->onEachSide(1)->links() }}</div>
</div>
@endsection