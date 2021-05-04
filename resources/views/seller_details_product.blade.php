@extends('layouts/seller')


@section('p3')
<style>
    .img {
        width: 400px;
        height: 400px;
        object-fit: cover;
    }
    .xar {
        margin-top: 7%;
        margin-left: 112px;
    }
    p {
        margin-top: 0px !important;
        margin-bottom: 1px !important;
        margin-top: 0px !important;
        margin-bottom: 1px !important;
        font-size: 17px;
        font-family: sans-serif;
    }
    span {
        font-weight: 700;
    }
    .cat_img {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
    .categories {
        margin-top: 10%;
        margin-bottom: 83px;
        background: #eeeeee;
    }
    .cat_product {
        padding: 38px;
        padding-bottom: 25px !important;
    }
    .cursor {
        cursor: pointer;
    }
    .det_photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }
    .p3 {
        padding: 24px;
        margin-top: 4%;
    }
    .buttons {
        justify-content: space-evenly;
        margin-top: 3%;
    }
    .button_a {
        border-radius: 6px;
    }
</style>

@section('p1')
    <div class="row">
        <div class="col-md-6">
            <div>
                <h2>{{ $product->name }}</h2>
                <img class="img" src="/images/{{ $product->glav_photo }}" alt="">
            </div>
        </div>
        <div class="col-md-4 xar">
            <h4>Additional information</h4>
            <p><span>Price:</span> {{ $product->price }}{{ $product->valuta }}</p>
            <p><span>Quantity:</span> {{ $product->quantity }} </p>
            <p><span>Seller:</span> <a href="/products/{{ $product->seller->id }}">{{ $product->seller->name }} {{ $product->seller->surname }}</a></p>
            <p><span>Comment:</span> {{ $product->comment }}</p>
            @if ($is_unavailable == 0)
                    <div class="bg-info rounded">
                        <p class="text-center"><span>Product is unavailable!</span></p>
                    </div>
                @endif
                @if ($is_unavailable == 1)
                    <div class="bg-danger rounded">
                        <p class="text-center"><span>Product is available!</span></p>
                    </div>
                @endif
            <div class="row buttons">
                <div class="">
                    <a class="border p-1 button_a" href="/product/edit/{{ $product->id }}">Edit info</a>
                </div>
                @if ($is_unavailable == 0)
                    <div class="">
                        <a class="border p-1 button_a" href="/product/unavailable/{{ $product->id }}">Make it unavailable</a>
                    </div>
                @endif
                @if ($is_unavailable == 1)
                    <div class="">
                        <a class="border p-1 button_a" href="/product/available/{{ $product->id }}">Make it available</a>
                    </div>
                @endif
                <div class="">
                    <a class="border p-1 button_a" href="/product/delete/{{ $product->id }}">Delete product</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row border p3">
        @foreach ($product->photo as $item)
            <div class="col-md-2 text-center">
                <img class="det_photo" src="/images/{{ $item }}" />
            </div>
            @endforeach
    </div>
    <div class="categories border">
        <h2 class="text-center">Perhaps interested in</h2>
        <div class="row cat_product">
            @foreach ($my_products as $item)
            <div onclick="location.href='/seller/details/product/{{ $item->id }}'" class="col-md-3 text-center cursor">
                <img class="cat_img" src="/images/{{ $item->glav_photo }}" alt="">
                <p>{{ $item->name }}</p>
            </div>
        @endforeach
        </div>
    </div>
@endsection
