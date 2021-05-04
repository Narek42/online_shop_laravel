@extends('layouts/auth')

<style>
    .img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    .product {
        display: inline-flex;
        margin-bottom: 13px;
        cursor: pointer;
    }
    span {
        font-weight: 700;
    }
    .r1 {
        width: 100%;
        margin: auto;
        text-align: center;
    }
    .name {
        width: 73%;
        margin: auto;
        text-align: left;
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .total {
        text-align: center;
        margin-top: 50px;
        border-top: solid darkgreen;
        padding: 16px;
    }
    a {
        color: black !important;
    }
</style>

@section('p1')
    <h1>Card</h1>
    <div class="row">
        @foreach ($products as $item)
            @if ($item->is_unavailable == 1)
                <div class="col-md-12 text-danger product " onclick="location.href='/product/details/{{ $item->product->id }}';">
            @endif
            @if ($item->is_unavailable == 0)
                <div class="col-md-12 product " onclick="location.href='/product/details/{{ $item->product->id }}';">
            @endif
                <img class="img" src="/images/{{ $item->glav_photo }}" alt="">
                <div class="row r1">
                    <div class="col-md-3">
                        <p class="name">{{ $item->product->name }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="text-left"><span>Price: </span>{{ $item->product->price }}{{ $item->product->valuta }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="text-left"><span>Quantity:</span> {{ $item->product->quantity }} </p>
                    </div>
                        @if ($item->is_buyed)
                            <div class="col-md-2">
                                <p class="text-left"><span class="text-danger">{{ $item->is_buyed }}$</span></p>
                            </div>
                        @else
                            <div class="col-md-2">

                            </div>
                        @endif
                    <div class="col-md-2">
                        <a class="text-left" href="/delete_in_card/{{ $item->product->id }}">Delete</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row total">
            <div class="col-md-4">
                <h3>Total:</h3>
            </div>
            <div class="col-md-4">
                <h3>{{ $total }}</h3>
            </div>
            <div class="col-md-4">
                <a href="/stripe" class="btn btn-info">Process payment</a>
            </div>
        </div>
@endsection
