@extends('layouts.app')
@section('title', '- НОВОСТИ')
@section('content')
    <x-pages.breadcrumbs secondPositionUrl="{{ route('news.index') }}" secondPositionName='Новости' />
    <section>
        @livewire('select-news', ['regionCode' => $regionCode])
    </section>
@endsection
