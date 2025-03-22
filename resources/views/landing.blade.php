@extends('partials.master')

@section('content')


    {{-- Hero Section --}}
    @include('partials.hero')

    {{-- Bestsellers Section --}}
    @include('bestsellers', ['products' => $products])

   


@endsection
