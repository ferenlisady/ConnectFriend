@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
<div class="container mt-4">
    <h1 class="text-center mb-5">@lang('profile.profile')</h1>
    <div class="row g-5">
        <!-- Left Side: Profile Overview and Menu -->
        <div class="col-md-3">
            <!-- Profile Overview -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture"
                            class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
                    </div>
                    <h4 class="text-center mb-4">{{ $user->name }}</h4>
                    <h6 class="text-left"><strong>@lang('profile.job')</strong> {{ $user->current_job }}</h6>
                    <h6 class="text-left"><strong>@lang('profile.coin')</strong> {{ $user->coin }}</h6>

                    <form method="POST" action="{{ route('topUpCoin') }}">
                        @csrf
                        <button type="submit" name="top-up button" class="btn btn-success mt-2">@lang('profile.topUp')</button>
                    </form>

                    <ul class="list-unstyled mt-4">
                        <li><a href="javascript:void(0)" onclick="showSection('accountDetails')"
                                class="text-decoration-none text-left"
                                style="color: black;">@lang('profile.account')</a></li>
                        <li><a href="javascript:void(0)" onclick="showSection('friendList')"
                                class="text-decoration-none text-left"
                                style="color: black;">@lang('profile.friendlist')</a></li>
                        <li><a href="javascript:void(0)" onclick="showSection('friendRequests')"
                                class="text-decoration-none text-left" style="color: black;">@lang('profile.accFR')</a>
                        </li>
                    </ul>

                    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-md mt-4">@lang('profile.logout')</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Content for Account Details, Friend List, Pending Friend Requests -->
        <div class="col-md-9">
            <!-- Account Details -->
            <div class="card shadow-sm mb-5" id="accountDetails" style="display: block;">
                <div class="card-body ms-3">
                    <h3 class="mb-4">@lang('profile.accInfo')</h3>

                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>@lang('profile.name'): </strong> {{ $user->name }}</p>
                            <p><strong>@lang('profile.email'): </strong> {{ $user->email }}</p>
                            <p><strong>@lang('profile.gender'): </strong> {{ $user->gender }}</p>
                            <p><strong>@lang('profile.fow'): </strong> {{ $user->field_of_work }}</p>
                            <p><strong>@lang('profile.linkedind'): </strong> {{ $user->linkedin_username }}</p>
                            <p><strong>@lang('profile.phone'): </strong> {{ $user->phone_number }}</p>
                            <p><strong>@lang('profile.job')</strong> {{ $user->current_job }}</p>
                            <p><strong>@lang('profile.coin')</strong> {{ $user->coin }}</p>
                        </div>
                    </div>

                    <!-- Visibility Option -->
                    <hr>
                    <h5 class="fw-bold mt-4">@lang('profile.visibility')</h5>
                    <form action="{{ route('profile.visibility') }}" method="POST">
                        @csrf
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="profileVisibility"
                                name="profile_visibility" {{ $user->visibility ? 'checked' : '' }}>
                            <label class="form-check-label" for="profileVisibility">
                                {{ $user->visibility ? __('profile.visible') : __('profile.invisible') }}
                            </label>
                        </div>

                        @if ($user->visibility)
                            <div class="alert alert-info mt-3">
                                @lang('profile.visibilityInfo')
                            </div>
                        @endif

                        @if (!$user->visibility)
                            <div class="alert alert-info mt-3">
                                @lang('profile.showProfileInfo')
                            </div>
                        @endif

                        <button type="submit" class="btn mt-3 px-5 py-2 rounded-3 border-0"
                            style="background-color: #183F23; color: white;">
                            {{ $user->visibility ? 'Make Invisible' : 'Make Visible' }}
                        </button>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Friend List -->
            <div class="card shadow-sm mb-5" id="friendList" style="display: none;">
                <div class="card-body ms-3">
                    <h3 class="mb-3">@lang('profile.friendlist')</h3>
                    <!-- Scrollable Container -->
                    <div style="max-height: 400px; overflow-y: auto;">
                        <ul class="list-group">
                            @foreach ($friends as $friend)
                                <li class="list-group-item d-flex align-items-center">
                                    @if ($friend->sender_id == $user->id)
                                        <img src="{{ asset($friend->receiver->profile_picture) }}" alt="Profile Picture"
                                            class="img-fluid rounded-circle me-3" style="width: 80px; height: 80px;">
                                    @else
                                        <img src="{{ asset($friend->sender->profile_picture) }}" alt="Profile Picture"
                                            class="img-fluid rounded-circle me-3" style="width: 80px; height: 80px;">
                                    @endif

                                    <div class="ms-3 mt-3">
                                        <h5 class="mb-3">
                                            @if ($friend->sender_id == $user->id)
                                                {{ $friend->receiver->name }}
                                            @else
                                                {{ $friend->sender->name }}
                                            @endif
                                        </h5>
                                        <p class="mb-1"><strong>@lang('profile.job')</strong>
                                            @if ($friend->sender_id == $user->id)
                                                {{ $friend->receiver->current_job }}
                                            @else
                                                {{ $friend->sender->current_job }}
                                            @endif
                                        </p>
                                        <p><strong>@lang('profile.fow'): </strong>
                                            @if ($friend->sender_id == $user->id)
                                                {{ $friend->receiver->field_of_work }}
                                            @else
                                                {{ $friend->sender->field_of_work }}
                                            @endif
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Pending Friend Requests -->
            <div class="card shadow-sm mb-5" id="friendRequests" style="display: none;">
                <div class="card-body ms-3">
                    <h3 class="mb-3">@lang('profile.pending')</h3>
                    <!-- Scrollable Container -->
                    <div style="max-height: 400px; overflow-y: auto;">
                        <ul class="list-group">
                            @foreach ($pendingRequests as $request)
                                <li class="list-group-item d-flex align-items-center">
                                    @if ($request->sender_id == $user->id)
                                        <img src="{{ asset($request->receiver->profile_picture) }}" alt="Profile Picture"
                                            class="img-fluid rounded-circle me-3" style="width: 80px; height: 80px;">
                                    @else
                                        <img src="{{ asset($request->sender->profile_picture) }}" alt="Profile Picture"
                                            class="img-fluid rounded-circle me-3" style="width: 80px; height: 80px;">
                                    @endif

                                    <div class="ms-3 mt-3">
                                        <h5 class="mb-3">
                                            @if ($request->sender_id == $user->id)
                                                {{ $request->receiver->name }}
                                            @else
                                                {{ $request->sender->name }}
                                            @endif
                                        </h5>
                                        <p class="mb-1"><strong>@lang('profile.job')</strong>
                                            @if ($request->sender_id == $user->id)
                                                {{ $request->receiver->current_job }}
                                            @else
                                                {{ $request->sender->current_job }}
                                            @endif
                                        </p>
                                        <p><strong>@lang('profile.fow'): </strong>
                                            @if ($request->sender_id == $user->id)
                                                {{ $request->receiver->field_of_work }}
                                            @else
                                                {{ $request->sender->field_of_work }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="ms-auto">
                                        <form action="{{ route('friend.accept', $request->sender_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-success btn-sm">@lang('profile.accept')</button>
                                        </form>

                                        <form action="{{ route('friend.decline', $request->sender_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-danger btn-sm">@lang('profile.decline')</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // Function to show the selected section and hide others
    function showSection(sectionId) {
        // Get all sections
        var sections = document.querySelectorAll('.col-md-9 .card');

        // Hide all sections
        sections.forEach(function (section) {
            section.style.display = 'none';
        });

        // Show the selected section
        var selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.style.display = 'block';
        }
    }
</script>
@endsection