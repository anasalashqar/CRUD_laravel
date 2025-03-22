@extends('partials.master')

@section('content')

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Hero Section --}}
    @include('partials.hero')

    {{-- Bestsellers Section --}}
    @include('partials.bestsellers', ['products' => $products])

    {{-- Footer --}}
    @include('partials.footer')

@endsection
