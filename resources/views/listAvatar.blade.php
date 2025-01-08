@extends('layouts.app')

@section('title', 'List Of Avatars')

@section('contents')

<div class="container mt-5">
    <h1 class="text-center mb-5">@lang('avatar.avail')</h1>

    @if(session('success'))
        <div class="alert alert-success">
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
                        <h5 class="card-title">{{ $avatar->name }}</h5>
                        <p class="card-text">@lang('avatar.price'){{ $avatar->price }} @lang('avatar.coin')</p>
                        <form action="{{ route('avatar.purchase', $avatar->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn"
                                style="background-color: #183F23; color: white;">@lang('avatar.buy')</button>
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