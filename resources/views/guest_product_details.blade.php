@extends('layouts/guest')

<style>
    .glav_photo {
        width: 400px;
        height: 400px;
        object-fit: cover;
    }
    .photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }
    p {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    .inf {
        width: 80%;
        margin: auto;
        margin-top: 59px;
    }
    .cat_photo {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
    .x-1 {
        margin-top: 5%;
        margin-bottom: 5%;
    }
    .x-2 {
        cursor: pointer;
    }
    .x-3 {
        color: black !important;
    }
</style>

@section('p1')
    <div class="row">
        <div class="col-md-6">
            <h2>{{ $name }}</h2>
            <img class="glav_photo" src="/images/{{ $glav_photo }}" alt="">
            <div class="row">
                @foreach ($photo as $item)
                    <div class="m-2">
                        <img class="photo" src="/images/{{ $item }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="inf">
                <h3>Information</h3>
                <p>Price: {{ $price }}{{ $valuta }}</p>
                <p>Quantity: {{ $quantity }} </p>
                <p>Seller: <a href="/guest/seller/products/{{ $sell->id }}">{{ $sell->name }} {{ $sell->surname }}</a></p>
                <p class="comment">Comment: {{ $comment }}</p>
            </div>
        </div>
    </div>
    <div class="row border x-1">
        {{-- <div> --}}
            @foreach ($categories as $item)
                <div class="m-4 text-center x-2">
                    <a class="x-3" href="/guest/product/details/{{ $item->id }}">
                        <img class="cat_photo" src="/images/{{ $item->glav_photo }}" alt="">
                        <p>{{ $item->name }}</p>
                    </a>
                </div>
            @endforeach
        {{-- </div> --}}
    </div>
@endsection
