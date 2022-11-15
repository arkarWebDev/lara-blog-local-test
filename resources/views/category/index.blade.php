@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">Category Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("category.index") }}" class="text-dark text-decoration-none">Category List</a></li>
  </ol>
</nav>
<table class="table">
  <thead>
    <tr class=" table-dark">
      <th scope="col">Category</th>
      <th scope="col">Create at</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @forelse ($categories as $category)
      <tr>
        <th>
          <p class="m-0">{{ $category->title }} <span class=" badge bg-dark m-0">{{ $category->posts()->count() }}</span></p>
          @isUser
            <p class="m-0 text-black-50">Added by <span class="text-dark">You</span></p>
          @endisUser
          @notUser
            <p class="m-0 text-black-50">Added by <span class="text-dark">{{ $category->user->name }}</span></p>
          @endnotUser
        </th>
        <th>
          <p class=" m-0 text-sm text-black-50"><i class="fa-regular fa-calendar me-2"></i>{{ $category->created_at->format("d M o") }}</p>
          <p class=" m-0 text-sm text-black-50"><i class="fa-regular fa-clock me-2"></i>{{ $category->created_at->format("g:i A") }}</p>
        </th>
        @can("update",$category)
          <th class="pt-3"><a href="{{ route("category.edit",$category->id) }}"><i class="fa-regular fa-pen-to-square fs-4 text-dark"></i></a></th>
        @endcan
        @can("delete",$category)
          <th class="pt-3">
            <form action="{{ route("category.destroy",$category->id) }}" method="post">
              @csrf
              @method("delete")
              <button type="submit" style="padding: 0;border: none;background: none">
                <i class="fa-solid fa-trash-can fs-4 text-danger"></i>
              </button>
            </form>
          </th>
        @endcan
      </tr>
    @empty
    <th colspan="4">
      <p class="text-center fs-5 text-dark">No category currently added.</p>
    </th>
    @endforelse
  </tbody>
</table>
@endsection