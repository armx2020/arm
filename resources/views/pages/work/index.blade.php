@extends('layouts.app')
@section('title', '- РАБОТА')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="{{ route('works.index') }}" secondPositionName='Работа' />
    <section>
        @livewire('select-works', ['regionCode' => $regionCode])
    </section>
@endsection
