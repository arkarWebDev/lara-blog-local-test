@extends("layouts.app")

@section("content")
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route("home") }}"><i class="fa-solid fa-house text-dark"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="text-dark">User Management</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("user.index") }}" class="text-dark text-decoration-none">Users List</a></li>
  </ol>
</nav>
<div class="d-flex align-items-center justify-content-between">
  <div>
  @if (request("keyword"))
    <div class=" border border-dark p-1 rounded d-flex align-items-center">
        <p class="m-0">search by <span>{{ request("keyword") }}</span></p>
        <a href="{{ route("user.index") }}" class=" text-decoration-none text-dark mt-1 pe-1">
          <i class="fa-solid fa-xmark fs-5 fw-bolder ms-2"></i>
        </a>
    </div>
  @endif
  </div>
  <div>
    <form action="{{ route("user.index") }}" method="get">
      <div class="d-flex align-items-center">
        <input type="text" class="form-control" placeholder="Search by name ..." name="keyword">
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
      <th scope="col">User</th>
      <th scope="col">Mail \ Role</th>
      <th scope="col">Create At</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @forelse ($users as $user)
      <tr>
        <th class="pt-3">
          <p class="m-0">{{ $user->name }}</p>
        </th>
        <th>
          <p class="m-0 text-black-50"><i class="fa-regular fa-envelope fs-5 me-1"></i>{{ $user->email }}</p>
          @if($user->role == 0)
            <p class="m-0 text-black-50"><i class="fa-solid fa-user-shield fs-5 me-1"></i>Admin</p>
          @elseif ($user->role == 1)
            <p class="m-0 text-black-50"><i class="fa-solid fa-user-pen fs-5 me-1"></i>Editor</p>
          @elseif ($user->role == 2)
            <p class="m-0 text-black-50"><i class="fa-solid fa-user-check fs-5 me-1"></i>Verified User</p>
          @endif
        </th>
        <th>
          <p class=" m-0 text-sm text-black-50"><i class="fa-regular fa-calendar me-2"></i>{{ $user->created_at->format("d M o") }}</p>
          <p class=" m-0 text-sm text-black-50"><i class="fa-regular fa-clock me-2"></i>{{ $user->created_at->format("g:h A") }}</p>
        </th>
        <th class="pt-3"><a href="{{ route("user.edit",$user->id) }}"><i class="fa-regular fa-pen-to-square fs-4 text-dark"></i></a></th>
        <th class="pt-3">
          <form action="{{ route("user.destroy",$user->id) }}" method="post">
            @csrf
            @method("delete")
            <button type="submit" style="padding: 0;border: none;background: none">
              <i class="fa-solid fa-ban fs-4 text-danger"></i>
            </button>
          </form>
        </th>
        <th class="pt-3">
          <a href="{{ route("user.show",$user->id) }}">
            <i class="fa-solid fa-circle-info fs-4 text-dark"></i>
          </a>
        </th>
      </tr>
    @empty
    <th colspan="6">
      <p class="text-center fs-5">There is no user to show .</p>
    </th>
    @endforelse
  </tbody>
</table>
<div>
  {{ $users->links() }}
</div>
@endsection