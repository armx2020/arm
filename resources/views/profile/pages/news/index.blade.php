@extends('layouts.app')
@section('content')
    <div class="flex flex-col lg:flex-row mx-auto my-10">
        <x-nav-profile page="mynews"></x-nav-profile>
        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
            <x-profile.alert />
            <x-profile.grid :$entities :$entityName :$entitiesName />
        </div>
    </div>
@endsection
