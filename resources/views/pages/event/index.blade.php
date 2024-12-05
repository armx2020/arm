@extends('layouts.app')
@section('title', '- АФИША')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="{{ route('events.index') }}" secondPositionName='События' />
    <section>
        @livewire('select-events', ['regionCode' => $regionCode])
    </section>
@endsection
