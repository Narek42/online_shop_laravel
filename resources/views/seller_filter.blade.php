@extends("layouts.auth")

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
    .ateg {
        margin-left: 0px !important;
        margin-top: 17px;
    }
</style>
@section('p1')
    <div class="row products text-center">
    @foreach ($products as $item)
        <div onclick="location.href='/product/details/{{ $item->id }}';" class="col-md-3 m-2 border text-left cursor">
            <div class="p3">
                <img src="/images/{{ $item->glav_photo }}" class="img"/>
                <p class="comment">Product name: {{ $item->name }}</p>
                <p>Price: {{ $item->price }}{{ $item->valuta }}</p>
                <p>Quantity: {{ $item->quantity }} </p>
                <p>Seller: <a href="/products/{{ $item->seller->id }}">{{ $item->seller->name }} {{ $item->seller->surname }}</a></p>
                <p class="comment">Comment: {{ $item->comment }}</p>
                <div class="row ateg">
                    @if ($item->is_card)
                        <div class="">
                            <a class="border p-1" href="delete_in_card/{{ $item->id }}">Delete in card</a>
                        </div>
                    @endif
                    @if (!$item->is_card)
                        <div class="">
                            <a class="border p-1" href="to_card/{{ $item->id }}">Add to card</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
