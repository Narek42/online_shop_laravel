<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
{{-- <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" /> --}}
<style>
    body {
        background-color: #1a1f36;
    }

    .container-fluid {
        padding: 50px;
    }
    p {
        margin-top: 0px;
        margin-bottom: 1px;
    }

    .container {
        background: #c8c8c8;
        padding: 50px;
        border-radius: 20px;
    }

    #title {
        font-family: 'Lobster', cursive;
    }
    .img {
        height: 203px;
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
        height: 400px;
    }
    .comment {
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<div class="container-fluid">
    <div class="container">
        <h1 class="text-center" id="title">Online Shop</h1>
        <p class="text-center">
        <hr>
        <div class="row">
            <div class="col-md-5">
                <form role="form" method="post" action="/signup">
                    {{ csrf_field() }}
                    <fieldset>
                        <p class="text-uppercase pull-center"> SIGN UP:</p>
                        <div class="form-group">
                            <p class="text-danger">{{ $errors->signup->first("name") }}</p>

                            <input type="text" name="name" class="form-control input-lg" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <p class="text-danger">{{ $errors->signup->first("surname") }}</p>

                            <input type="text" name="surname" class="form-control input-lg" placeholder="Surname">
                        </div>
                        <div class="form-group">
                            <p class="text-danger">{{ $errors->signup->first("email") }}</p>

                            <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <p class="text-danger">{{ $errors->signup->first("password") }}</p>

                            <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <p class="text-danger">{{ $errors->signup->first("confirmpass") }}</p>

                            @if (session("false_password"))
                                <p class="text-danger">{{ session("false_password") }}</p>
                            @endif
                            <input type="password" name="confirmpass"  class="form-control input-lg" placeholder="Confirm Password">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="seller">
                                You are a seller?
                            </label>
                        </div>
                        <div>
                            <button class="btn btn-info">Signup</button>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="col-md-2">
                <!-------null------>
            </div>

            <div class="col-md-5">
                <form role="form" action="/login" method="post">
                    {{ csrf_field() }}
                    <fieldset>
                        <p class="text-uppercase"> Login using your account: </p>

                        <div class="form-group">
                            <p class="text-danger">{{ session("error_login") }}</p>
                            <p class="text-danger">{{ $errors->login->first("email") }}</p>
                            <input type="email" name="email" class="form-control input-lg" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <p class="text-danger">{{ session("error_password") }}</p>
                            <p class="text-danger">{{ $errors->login->first("password") }}</p>
                            <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-md" value="Sign In">
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row products text-center">
    @foreach ($products as $item)
        <div class="col-md-3 m-2 border text-left cursor">
            <div onclick="location.href='/guest/product/details/{{ $item->id }}';" class="p-3">
                <img src="images/{{ $item->glav_photo }}" class="img-fluid img"/>
                <p class="comment">Product name: {{ $item->name }}</p>
                <p>Price: {{ $item->price }}{{ $item->valuta }}</p>
                <p>Quantity: {{ $item->quantity }} </p>
                <p>Seller: <a href="/guest/seller/products/{{ $item->seller->id }}">{{ $item->seller->name }} {{ $item->seller->surname }}</a></p>
                <p class="comment">Comment: {{ $item->comment }}</p>
            </div>
        </div>
    @endforeach
</div>
<p class="text-center">
    <small id="passwordHelpInline" class="text-muted"> Developer:<a href="http://www.psau.edu.ph/"> Pampanga state agricultural university ?</a> BS. Information and technology students @2017 Credits: <a href="https://v4-alpha.getbootstrap.com/">boostrap v4.</a></small>
</p>


{{-- display flex justi? --}}
