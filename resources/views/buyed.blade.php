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
    <div class="row">
        @foreach ($products as $item)
            @if ($item->is_unavailable == 1)
                <div class="col-md-12 text-danger product " onclick="location.href='/product/details/{{ $item->id}}';">
            @endif
            @if ($item->is_unavailable == 0)
                <div class="col-md-12 product " onclick="location.href='/product/details/{{ $item->id}}';">
            @endif
                <img class="img" src="/images/{{ $item->glav_photo }}" alt="">
                <div class="row r1">
                    <div class="col-md-3">
                        <p class="name">{{ $item->name }}</p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-left"><span>Price: </span>{{ $item->price }}{{ $item->valuta }}</p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-left"><span>Quantity:</span> {{ $item->quantity }} </p>
                    </div>
                    <div class="col-md-3">
                        <a class="text-left" href="/to_card/{{ $item->id }}">Add to Card</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
@endsection
