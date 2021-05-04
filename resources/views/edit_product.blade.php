@extends('layouts/seller')

<style>
    .img {
        width: 400px;
        height: 400px;
        object-fit: cover;
        padding: 19px;
    }
    .categories {
        margin-top: 16px;
    }
    .imgg1  {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }
    #selectPhoto {
        display: none;
    }
    #addImages{
        width: 100%;
        height: 36%;
        text-align: center;
        font-size: 17px;
        padding: 4px;
        font-family: monospace;
        color: blue;
        cursor: pointer;
        border-radius: 4px;
    }
</style>

@section('p1')
    <h3>Edit product: {{ $product->name }}</h3>
    <div class="row">
        <div class="col-md-6">
            <img class="img" src="/images/{{ $product->glav_photo }}">
            <div class="row">
                @foreach ($product->photo as $item)
                    <div class="col-md-3">
                        <img class="imgg1" src="/images/{{ $item }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <form action="/product/edit/adding" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                             <p class="text-danger">{{ $errors->adding_product->first("name") }}</p>
                            <label>Name product</label>
                            <input class="form-control" type="text" name="name" value="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <p class="text-danger">{{ $errors->adding_product->first("price") }}</p>
                            <label>Price</label>
                            <input class="form-control" type="text" name="price" value="{{ $product->price }}">
                        </div>
                    </div>
                    <div class="col-md-6 kurs">
                        <div class="form-group">
                             <p class="text-danger">{{ $errors->adding_product->first("valuta") }}</p>
                            <label>Select valuta</label>
                            <select name="valuta" class="form-control">
                                <option value="$">Dollar $</option>
                                <option value="€">Euro €</option>
                                <option value="&#x20bd;">Ruble &#x20bd;</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group categories">
                            <label>Select categories</label>
                            <select name="categories" class="form-control">
                                 <p class="text-danger">{{ $errors->adding_product->first("categories") }}</p>
                                <option value={{ $product->catalog_id }}>{{ $product->catalog }}</option>
                                @foreach ($categories as $item)
                                    <option value={{ $item->id }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                             <p class="text-danger">{{ $errors->adding_product->first("quantity") }}</p>
                            <label>Quantity</label>
                            <input class="form-control" type="text" name="quantity" value="{{ $product->quantity }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                             <p class="text-danger">{{ $errors->adding_product->first("photo") }}</p>
                            <label>Photo</label>
                            <div onclick="openFIle()" id="addImages" class="border">Add images</div>
                            <input id="selectPhoto" required class="form-control" type="file" name="photo[]" multiple> {{--name="photo" value="{{ $product->photo }}" --}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea class="form-control" aria-label="With textarea" name="comment">{{ $product->comment }}</textarea>
                        </div>
                        <button class="btn btn-success">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



<script>
    function openFIle() {
        let inp = document.getElementById("selectPhoto")
        inp.click()
    }
</script>
