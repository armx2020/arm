@extends('layouts.app')
@section('title', '- НОВОСТИ')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="{{ route('groups.index') }}" secondPositionName='Группы' />
    <section>
        @livewire('select-groups', ['regionCode' => $regionCode])
    </section>
@endsection
