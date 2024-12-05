@extends('layouts.app')
@section('title', '- ПРОЕКТЫ')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="{{ route('projects.index') }}" secondPositionName='Проекты' />
    <section>
        @livewire('select-projects', ['regionCode' => $regionCode])
    </section>
@endsection
