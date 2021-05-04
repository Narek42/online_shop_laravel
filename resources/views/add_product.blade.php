@extends('layouts/seller')

<style>
    .kurs {
        margin-top: 15px;
    }
    #selectPhoto {
        display: none;
    }
    #addImages{
        width: 100%;
        height: 36%;
        text-align: center;
        font-size: 23px;
        padding: 1px;
        font-family: monospace;
        color: blue;
        cursor: pointer;
    }
</style>
@section('p2')
        <h3 class="text-right">{{ $user->name }} {{ $user->surname }}</h3>

    <h3 class="text-warning">Add your Product</h3>
    <form action="/seller/addProduct/adding" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{-- <input type="hidden" name="user_id" value={{ $user->id }}> --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <p class="text-danger">{{ $errors->adding_product->first("name") }}</p>
                    <label>Product name:</label>
                    <input type="text" class="form-control" autofocus name="name">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <p class="text-danger">{{ $errors->adding_product->first("price") }}</p>
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" >
                </div>
            </div>
            <div class="col-md-2 kurs">
               <div class="form-group">
                   <label>Select valuta</label>
                   <select name="valuta" class="form-control">
                       <option value="$">Dollar $</option>
                   </select>
               </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <p class="text-danger">{{ $errors->adding_product->first("quantity") }}</p>
                    <label>Quantity</label>
                    <input type="text" class="form-control" name="quantity" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <p class="text-danger">{{ $errors->adding_product->first("categories") }}</p>
                   <label>Categories</label>
                   <select name="categories" class="form-control">
                       <option value=""></option>
                       @foreach ($categories as $item)
                           <option value="{{ $item->id }}">{{ $item->name }}</option>
                       @endforeach
                   </select>
               </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <p class="text-danger">{{ $errors->adding_product->first("photo") }}</p>
                    <label>Photo</label>
                    <div onclick="openFIle()" id="addImages" class="border">Add images</div>
                    <input onchange="changeImg()" id="selectPhoto" required type="file" class="form-control" name="photo[]" multiple >
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
                </div>
            </div>
            <div class="w-100 text-center">
                <button class="btn btn-success w-50">Add product</button>
            </div>
        </div>
    </form>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<script>
    let arr = [];

    function openFIle() {
        let inp = document.getElementById("selectPhoto")
        inp.click()
    }
    function changeImg() {
        let inp = document.getElementById("selectPhoto")
        arr.push(inp)
        console.log(inp);
        let form = new FormData()
        form.append("images", arr)
        axios.post("show_images", form)
        .then(r => {
            console.log(r);
        })
    }
</script>
