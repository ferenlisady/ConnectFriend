@extends('layouts.app')

@section('title', 'Home')

@section('contents')
<div class="container mt-4">
    <div class="row justify-content-between align-items-center my-5">
        <!-- Search Form -->
        <div class="col-lg-3 col-md-4 col-sm-12">
            <form class="d-flex flex-row align-items-center" method="GET" action="{{ route('users.index') }}">
                <input class="form-control me-2" type="search" placeholder="@lang('home.searchBar')" aria-label="Search"
                    name="job" value="{{ request('job') }}" style="flex: 1; border-color: var(--darkgreen);">
                <button class="btn btn-outline-search" type="submit"
                    style="color: var(--darkgreen); border-color: var(--darkgreen);">
                    @lang('home.search')
                </button>
            </form>
        </div>

        <!-- Filter Form -->
        <div class="col-lg-2 col-md-4 col-sm-12">
            <form method="GET" action="{{ route('users.index') }}" class="d-inline-block d-flex align-items-center">
                <select name="gender" id="gender" class="form-select"
                    style="width: 100%; color: var(--darkgreen); border-color: var(--darkgreen);"
                    onchange="this.form.submit()">
                    <option value="">@lang('home.filterbygender')</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>@lang('home.male')</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>@lang('home.female')
                    </option>
                </select>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- User Cards -->
    <div class="row g-5 mb-5">
        @if ($users->isEmpty())
            <div class="alert alert-danger text-center">
                @lang('home.nouser')
            </div>
        @endif
        @foreach ($users as $user)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 d-flex flex-column">
                    <div class="card-body d-flex flex-column">
                        <div class="text-center">
                            <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture"
                                class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
                        </div>
                        <h4 class="card-title my-3 text-center">{{ $user->name }}</h4>
                        <p class="text-left"><strong>@lang('home.profession')</strong> {{ $user->current_job }}</p>
                        <p class="text-left"><strong>@lang('home.fow')</strong> {{ $user->field_of_work }}</p>

                        <div class="mt-auto">
                            @auth
                                <form action="{{ route('add.friend', ['receiver_id' => $user->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn rounded-3 border-0"
                                        style="background-color: #183F23; color: white;">
                                        @lang('home.addFriend')
                                    </button>
                                </form>
                            @else
                                <p class="text-muted">@lang('home.loginToAdd')</p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @empty($users)
            <div class="col-12">
                <p class="text-center">@lang('home.emptyUser')</p>
            </div>
        @endempty
    </div>

    <!-- Pagination -->
    @if ($users->lastPage() > 1)
        <div class="d-flex justify-content-center mb-4">
            <span class="me-2">@lang('home.page') | </span>
            <span class="me-2">
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <a href="{{ $users->url($i) }}"
                        class="mx-1 {{ $i === $users->currentPage() ? 'text-dark fw-bold' : 'text-muted' }}"
                        style="text-decoration: none;">{{ $i }}</a>
                @endfor
            </span>
        </div>
    @endif

</div>
@endsection