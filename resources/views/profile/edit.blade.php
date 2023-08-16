@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="profile"></x-nav-profile>

    <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">



        <div class="w-full mx-auto space-y-6">

            @if (session('status') === 'password-updated')
            <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-5 text-base text-green-700" role="alert" style="max-height:64px;">
                Пароль обнавлён
            </div>
            @endif

            @if (session('status') === 'profile-updated')
            <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-5 text-base text-green-700" role="alert" style="max-height:64px;">
                Профиль обнавлён
            </div>
            @endif
            
            <div class="p-4 sm:p-8 bg-white rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection