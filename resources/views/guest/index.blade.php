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
        <div class="col-lg-4 col-xl-3">
            @foreach ($posts as $post)
                <div class="card my-3">
                    <div class="card-body">
                        <div class=" d-flex align-items-center justify-content-between">
                            <div class=" d-flex align-items-center">
                                <div style="width: 50px;height: 50px" class="p-1 rounded-circle border border-2 border-dark overflow-hidden border-opacity-25">
                                    <img src="{{ asset('admin.jpg') }}" class="w-100">
                                </div>
                                <div class=" ms-1">
                                    <p class=" fw-semibold m-0" >{{ $post->user->name }}</p>
                                    <span class=" text-black-50 m-0">{{ $post->user->nation->name }}</span>
                                </div>
                            </div>
                            <div>
                                <i class="fa-solid fa-ellipsis fw-semibold fs-4"></i>
                            </div>
                        </div>
                        <h5 class=" text-dark mt-2">{{ $post->title }}</h5>
                        <div id="carouselExampleIndicators{{ $post->id }}" class="carousel slide" 
                            data-bs-ride="true">
                            <div class="carousel-indicators">
                                @foreach ($post->subImgs as $key => $img)
                                    <button type="button" data-bs-target="#carouselExampleIndicators{{ $post->id }}" 
                                    data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" 
                                    aria-current="true" aria-label="Slide {{ $key }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($post->subImgs as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $img->name) }}" class="d-block w-100" height="555"
                                    style="object-fit: cover">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" 
                            data-bs-target="#carouselExampleIndicators{{ $post->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" 
                            data-bs-target="#carouselExampleIndicators{{ $post->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="d-flex align-items-center justify-content-between my-2">
                            <div>
                                <i class="fa-regular fa-heart fs-3 me-3"></i>
                                <i class="fa-regular fa-comment fs-3 me-3"></i>
                                <i class="fa-regular fa-paper-plane fs-3"></i>
                            </div>
                            <div>
                                <i class="fa-regular fa-bookmark fs-3"></i>
                            </div>
                        </div>
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
                            <span class=" text-black-50">{{ Str::replace(' ','_',Auth::user()->name) }}</span>
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
                            <a href="{{ route('login') }}"  class=" text-primary">
                                <span>Login or Sign up</span>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <p class=" fw-semibold my-2 fs-6">Recent Users</p>
            @if (Auth::user())
            @foreach ($users as $user)
            <div class="mb-1">
                <div class=" d-flex align-items-center justify-content-between">
                    <div class=" d-flex align-items-center">
                        <div style="width: 30px;height: 30px" class="rounded-circle overflow-hidden">
                            <img src="{{ asset('admin.jpg') }}" class="w-100">
                        </div>
                        <div class="ms-3">
                            <span class=" fw-semibold text-dark">{{ $user->name }}</span>
                            <div></div>
                            <span class=" text-black-50">{{ Str::replace(' ','_',$user->name) }}</span>
                        </div>
                    </div>
                    <span class=" text-dark cp">follow</span>
                </div>
            </div>
            @endforeach
            @else
            @for ($n=0;$n < 5;$n++)
            <div class="mb-1">
                <div class=" d-flex align-items-center justify-content-between">
                    <div class=" d-flex align-items-center">
                        <div style="width: 30px;height: 30px" class="rounded-circle overflow-hidden">
                            <img src="{{ asset('user_default.png') }}" class="w-100 opacity-25">
                        </div>
                        <div class="ms-3">
                            <span class=" fw-semibold text-black-50">▬▬▬▬▬▬</span>
                            <div></div>
                            <span class=" text-black-50">▬▬▬</span>
                        </div>
                    </div>
                    <span class=" text-black-50">▬▬</span>
                </div>
            </div>
            @endfor
            @endif
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