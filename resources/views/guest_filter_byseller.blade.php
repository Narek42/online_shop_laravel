@extends('layouts/guest')

<style>
    p {
        margin-bottom: 0px !important;
        margin-top: 0px !important;
    }
    .img {
        width: 67% !important;
        height: 92px;
        object-fit: cover;
    }
    .x-1 {
        margin-top: 5%;
    }
    .comment {
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .x-3 {
        color: black !important;
    }
</style>
@section('p1')
    <div class="row text-center">
        <h3 class="col-md-6 text-info">{{ count($products) }} Product</h3>
        <h3 class="col-md-6 text-danger">{{ $products[0]->seller->name }} {{ $products[0]->seller->surname }}</h3>
    </div>
    <div class="row">
        @foreach ($products as $item)
            <div class="col-md-3 x-1">
                <a class="x-3" href="/guest/product/details/{{ $item->id }}">
                    <img src="/images/{{ $item->glav_photo }}" class="img"/>
                    <p class="comment">Product name: {{ $item->name }}</p>
                    <p>Price: {{ $item->price }}{{ $item->valuta }}</p>
                    <p>Quantity: {{ $item->quantity }} </p>
                    <p class="comment">Comment: {{ $item->comment }} </p>
                </a>
            </div>
        @endforeach
    </div>
@endsection
