@extends('layouts/seller')

<style>
    .container-fluid {
        padding: 50px;
    }
    p {
        margin-top: 0px !important;
        margin-bottom: 1px !important;
    }

    .container {
        background-color: white;
        padding: 50px;
    }

    #title {
        font-family: 'Lobster', cursive;
    }
    .img {
        height: 203px;
        width: 203px;
        object-fit: cover;
    }
    .products {
        padding: 45px;
        background: white;
        width: 98%;
        margin: auto;
        display: flex;
        justify-content: space-evenly;
        /* flex-flow: nowrap; */
    }
    .cursor {
        cursor: pointer;
        height: 407px;
    }
    .comment {
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .p3 {
        padding: 7px;
    }
</style>

@section('p3')
    <h3 class="text-right">{{ $user->name }} {{ $user->surname }}</h3>
    <div class="row text-center products">
        @foreach ($my_products as $item)
        <div class="col-md-3 m-2 border text-left cursor" onclick="location.href='/seller/details/product/{{ $item->id }}';">
            <div class="p3">
                <img src="/images/{{ $item->glav_photo }}" class="img"/>
                <p>Product name: {{ $item->name }}</p>
                <p>Price: {{ $item->price }}{{ $item->valuta }}</p>
                <p>Quantity: {{ $item->quantity }} </p>
                <p class="comment">Comment: {{ $item->comment }}</p>
                @if ($item->is_unavailable > 0)
                    <div class="">
                        <p class="text-danger"><span>Product is available!</span></p>
                    </div>
                @endif
                <div class="text-center">
                    <a class="m-2" href="/product/delete/{{ $item->id }}">Delete</a>
                    <a class="m-2" href="/product/edit/{{ $item->id }}">Edit</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
    </div>
@endsection


