@extends("layouts.auth")
<link rel="stylesheet" href="/css/style.css">
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
    .x5 {
        padding-left: 40px;
    }
    .x6 {
        width: 80%;
        display: flex;
        justify-content: center;
        margin-top: 45px;
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
    .review {
        width: 90%;
        min-height: 100px;
        margin: auto;
        padding: 25px;
        margin-bottom: 70px;
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
    .p_review {
        margin-left: 35px;
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
    .star {
        width: 25px;
        height: 25px;
    }
    .star1 {
        width: 17px;
        height: 17px;
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
            @if ($product->is_unavailable == 1)
                    <div class="bg-danger rounded">
                        <p class="text-center"><span>Product is available!</span></p>
                    </div>
                @endif
            <div class="row buttons">
                <div class="">
                    <a class="border p-1" href="">Bay with one click</a>
                </div>
                @if (!$is_card)
                    <div class="">
                        <a class="border p-1" href="/to_card/{{ $product->id }}">Add to card</a>
                    </div>
                @endif
                @if ($is_card)
                    <div class="">
                        <a class="border p-1" href="/delete_in_card/{{ $product->id }}">Delete in card</a>
                    </div>
                @endif
                <div class="">
                    <a class="border p-1" href="">Add to favorites</a>
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
            @foreach ($categories as $item)
            <div onclick="location.href='/product/details/{{ $item->id }}'" class="col-md-3 text-center cursor">
                <img class="cat_img" src="/images/{{ $item->glav_photo }}" alt="">
                <p>{{ $item->name }}</p>
            </div>
        @endforeach
        </div>
    </div>
    <div class="">
        <h3>Review</h3>
        <div class="border review">
            @foreach ($feedback as $item)
                <div class="container border-bottom border-info x5">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="font-weight-bold">{{ $item["writed"]->surname }} {{ $item["writed"]->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $item->stars)
                                        <img class="star1" src="https://img.icons8.com/fluent/48/000000/star.png"/>
                                    @else
                                        <img class="star1" src="https://img.icons8.com/android/24/000000/star.png"/>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="p_review">{{ $item->review }}</p>
                </div>
            @endforeach
            @if ($is_buyed == 1)
                <div class="x6">
                    <div class="col-md-6">
                        <form action="/add_feedback/{{ $product->id }}/{{ Session::get('user')->id }}" method="post">
                            {{ csrf_field() }}
                            <p>Feedback</p>
                            <input class="selStar" name="selStar" type="hidden">
                            <p class="text-danger">{{ $errors->msg_star->first() }}</p>
                            <img class="star" name="1" src="https://img.icons8.com/android/24/000000/star.png"/>
                            <img class="star" name="2" src="https://img.icons8.com/android/24/000000/star.png"/>
                            <img class="star" name="3" src="https://img.icons8.com/android/24/000000/star.png"/>
                            <img class="star" name="4" src="https://img.icons8.com/android/24/000000/star.png"/>
                            <img class="star" name="5" src="https://img.icons8.com/android/24/000000/star.png"/>
                            <textarea name="review" cols="60" rows="2"></textarea>
                            <button class="btn btn-info btn-block m-3 save">Save</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let star
            $(".star").mouseenter(function() {
                $(".star").attr("src" , "https://img.icons8.com/android/24/000000/star.png")
                $(this).prevAll(".star").attr("src", "https://img.icons8.com/fluent/48/000000/star.png");
                $(this).attr("src" ,  "https://img.icons8.com/fluent/48/000000/star.png")
            })
            $(".star").mouseleave(function() {
                $(".star").attr("src" , "https://img.icons8.com/android/24/000000/star.png")
            })
            $(".star").click(function() {
                $(".selStar").attr("value", this.name)
            })
        })
    </script>
@endsection


