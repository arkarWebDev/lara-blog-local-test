@extends('guest layouts.master')

@section('content')

<div class=" container-fluid">
    <div class="row">
        <div class="col-3 position-relative"> 
            <div class="border-end border-1 border-dark border-opacity-10 ps-3 pt-5 position-fixed" style="height: 100vh;width: 16.66666667%">
                <h2 class="text-it-ef fw-light pb-4">Laragram</h2>
                <ul class=" list-unstyled mt-5">
                    <li class=" mb-5">
                        <a href="" class=" text-decoration-none text-dark hv-ef">
                            <i class="fa-solid fa-house fs-4"></i>
                            <span class=" fs-5 ms-2 fw-semibold">Home</span>
                        </a>
                    </li>
                    <li class=" mb-5">
                        <a href="" class=" text-decoration-none text-dark hv-ef">
                            <i class="fa-solid fa-magnifying-glass fs-4"></i>
                            <span class=" fs-5 ms-2">Search</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="" class=" text-decoration-none text-dark hv-ef">
                            <i class="fa-regular fa-bell fs-4"></i>
                            <span class=" fs-5 ms-2">Notifications</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-2"></div>
        <div class="col-3">
            @foreach ($posts as $post)
                <div class="card my-3">
                    <div class="card-body">
                        <div class=" d-flex align-items-center justify-content-between">
                            <div class=" d-flex align-items-center">
                                <div style="width: 50px;height: 50px" class="p-1 rounded-circle border border-2 border-dark overflow-hidden border-opacity-25">
                                    <img src="{{ asset('admin.jpg') }}" class="w-100">
                                </div>
                                <div class=" ms-1">
                                    <span class=" fw-semibold">{{ $post->user->name }}</span>
                                    <div></div>
                                    <span class=" text-black-50">{{ $post->user->nation->name }}</span>
                                </div>
                            </div>
                            <div>
                                <i class="fa-solid fa-ellipsis fw-semibold fs-4"></i>
                            </div>
                        </div>
                        <h4 class=" text-dark mt-2">{{ $post->title }}</h4>
                        <span class=" text-dark m-0 short" id="des/{{ $post->id }}">
                            {{ Str::limit($post->description,300,'') }}
                        </span>
                        <span class="fw-semibold cp text-primary" onclick="showHide({{ $post->id }})" 
                            id="btn/{{ $post->id }}">
                            See More
                        </span>
                        <p class=" m-0 text-black-50 fw-lighter">{{ $post->created_at->diffforHumans() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="col-2">
            <div class="my-3">
                <div class=" d-flex align-items-center justify-content-between mt-4">
                        @if (Auth::user())
                        <div class=" d-flex align-items-center">
                            <div style="width: 60px;height: 60px" class="rounded-circle overflow-hidden">
                                <img src="{{ asset('admin.jpg') }}" class="w-100">
                            </div>
                            <div class="ms-2">
                                <span class=" fw-semibold">{{ Auth::user()->name }}</span>
                                <div></div>
                                @if (Auth::user()->role == 0)
                                    <span class=" text-black-50">Admin</span>
                                @elseif (Auth::user()->role == 1)
                                    <span class=" text-black-50">Editor</span>
                                @else
                                    <span class=" text-black-50">User</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <a href="{{ route("user.show",Auth::user()->id) }}" class=" text-black-50">View Profile</a>
                        </div>
                        @else
                        <div class=" d-flex align-items-center">
                            <div style="width: 60px;height: 60px" class="rounded-circle overflow-hidden opacity-75">
                                <img src="{{ asset('user_default.png') }}" class="w-100">
                            </div>
                            <div class=" ms-2">
                                <span class=" fw-semibold">Guest User</span>
                                <div></div>
                                <a href="{{ route('login') }}"  class=" text-black-50">
                                    <span>Login or Sign up</span>
                                </a>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showHide(msg){
        let v1 = `des/${msg}`;
        let v2 = `btn/${msg}`;
        let v1Ctr = document.getElementById(v1);
        let v2Ctr = document.getElementById(v2);
        if (v1Ctr.classList.contains("short")) {
            v1Ctr.innerHTML = "{{ $post->description }}";
            v1Ctr.classList.remove("short");
            v1Ctr.classList.add("long");
            v2Ctr.innerHTML = "See Less";
        } else if (v1Ctr.classList.contains("long")) {
            v1Ctr.innerHTML = "{{ Str::limit($post->description,200,'') }}";
            v1Ctr.classList.remove("long");
            v1Ctr.classList.add("short");
            v2Ctr.innerHTML = "See More";
        }

    }
</script>
@endsection