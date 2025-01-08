@extends('layouts.app')

@section('title', 'My Avatars')

@section('contents')

<div class="container mt-5">
    <h1 class="text-center mb-5">@lang('avatar.my')</h1>

    @if(session('success'))
        <div class="alert alert-success mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-5 d-flex justify-content-center">
        @foreach ($avatars as $avatar)
            <div class="col-md-3 mb-5 ">
                <div class="card shadow-sm h-70 d-flex flex-column">
                    <img src="{{ asset($avatar->image) }}" class="card-img-top" style="height: 250px"
                        alt="{{ $avatar->name }}">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-4">{{ $avatar->name }}</h5>
                        <form action="{{ route('avatar.setProfilePicture', $avatar->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn"
                                style="background-color: #183F23; color: white;">@lang('avatar.setaspfp')</button>
                        </form>
                        <form
                            action="{{ route('avatar.send', ['avatarId' => $avatar->id, 'receiverId' => 'receiver_id']) }}"
                            method="POST">
                            @csrf
                            <div class="d-flex align-items-center">
                                <div class="form-group mb-0 mt-3 flex-grow-1">
                                    <h5 for="receiver" class="mt-3 ms-2 text-start">@lang('avatar.sendTo')</h5>
                                    <select name="receiver_id" class="form-control" id="receiver" required>
                                        @foreach ($friends as $friend)
                                        <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn ms-3"
                                    style="background-color: #183F23; color: white; margin-top: 60px;">@lang('avatar.send')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if ($avatars->lastPage() > 1)
        <div class="d-flex justify-content-center mb-4">
            <span class="me-2">@lang('home.page') | </span>
            <span class="me-2">
                @for ($i = 1; $i <= $avatars->lastPage(); $i++)
                    <a href="{{ $avatars->url($i) }}"
                        class="mx-1 {{ $i === $avatars->currentPage() ? 'text-dark fw-bold' : 'text-muted' }}"
                        style="text-decoration: none;">{{ $i }}</a>
                @endfor
            </span>
        </div>
    @endif

</div>

@endsection