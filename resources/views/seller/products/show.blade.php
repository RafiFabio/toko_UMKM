@extends('layouts.app')

@section('title', $product->name)

@section('content')
<h1>{{ $product->name }}</h1>
<p>Harga: Rp{{ number_format($product->price) }}</p>
<p>Stok: {{ $product->stock }}</p>
<p>Deskripsi: {{ $product->description }}</p>
@if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="200">
@endif
@endsection
