<!-- resources/views/filament/layout.blade.php -->
@extends('filament::layouts.base')

@section('brand')
    <a href="{{ route('landlord.home') }}" class="brand">
        <!-- You can include a custom logo or text here -->
        {{ config('app.name') }}
    </a>
@endsection
