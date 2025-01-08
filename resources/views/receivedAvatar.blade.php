<!-- receivedAvatars.blade.php -->
@extends('layouts.app')

@section('title', 'Received Avatars')

@section('contents')

<div class="container mt-5">
    <h1 class="text-center mb-5">@lang('avatar.received')</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($avatars->isEmpty())
        <div class="alert alert-info text-center">@lang('avatar.empty')</div>
    @else
        <div class="row gap-5 d-flex justify-content-center">
            @foreach ($avatars as $avatar)
                <div class="col-md-3 mb-5">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset($avatar->image) }}" class="card-img-top" alt="{{ $avatar->name }}">
                        <div class="card-body text-center">
                            <h4 class="card-title mb-4">{{ $avatar->name }}</h4>
                            <h6 class="card-text"><strong>@lang('avatar.price')</strong>{{ $avatar->price }} Coins</h6>
                            <h6 class="card-text"><strong>@lang('avatar.sentBy')</strong>{{ $avatar->sender_name }}</h6>

                            <form action="{{ route('avatar.save', $avatar->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn mt-3" style="background-color: #183F23; color: white;">@lang('avatar.save')</button>
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
    @endif
</div>

@endsection