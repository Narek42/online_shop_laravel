@extends('layouts/auth')
<style>
    .img {
        height: 160px;
        width: 160px;
        object-fit: cover;
    }
    .products {
        text-align: center;
        padding: 22px;
    }
    .comment {
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    p {
        margin-top: 0px !important;
        margin-bottom: 1px !important;
        text-align: left;
    }
    .x-1 {
        padding: 30px;
        cursor: pointer;
    }
    .ateg {
        margin-left: 0px !important;
        margin-top: 17px !important;
    }
    .open_filter {
        cursor: pointer;
        font-size: 18px;
        width: 86px;
        margin: auto;
        border-bottom: solid 1px;
    }
    .range {
        display: inline-grid;
    }
    .p1 {
        margin-bottom: 0px
    }
    .div_min_max {
        height: 77px;
        display: flex;
        justify-content: space-around;
    }
    .par_div {
        margin-top: 7px
    }
    .x5 {
        margin-bottom: 0px;
    }
    .x6 {
        padding-top: 16px;
    }
    select {
        width: 116px;
    }
    a {
        color: black !important;
    }
</style>
@section('p1')
    <div id="main">
        <h3>{{ $user->name }} {{ $user->surname }}</h3>
            <div class="row">
                <div class="col-md-7">
                    <input id="search" v-model="search" v-on:input = "searchProducts()" class="form-control" type="text" placeholder="Search" name="name">
                </div>
                <div class="col-md-4">
                    <p v-on:click="openSearch()" class="text-center text-info open_filter">Open filter</p>
                </div>
            </div>
            <div class="row par_div" v-if="filter.open == 1">
                <div class="col-md-2">
                    <div class="form-group range">
                        <label class="p1" for="">Catalog</label>
                        <select v-on:change="filterCatalog()" v-model="filter.catalog" class="form-group" >
                            <option></option>
                            <option v-for="item in catalog" v-bind:value="item.id" >@{{ item.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row border div_min_max">
                        <div class="col-md-2 ">
                            <div class="range">
                                <label for="points">Min price:</label>
                                <input type="range" id="points" name="points" min="10000" max="20000" v-model="filter.min">
                                <p class="x5">@{{ filter.min }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="range">
                                <label for="points">Max price:</label>
                                <input  type="range" id="points" name="points" min="21000" max="900000" v-model="filter.max">
                                <p class="x5">@{{ filter.max }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p v-on:click = "filterPrice()" class="text-center text-info open_filter x6">Filter</p>
                        </div>
                        <div class="col-md-2">
                            <p v-on:click = "clearFilter()" class="text-center text-info open_filter x6">Clear filter</p>
                        </div>
                    </div>
                </div>
            </div>
        <p class="text-center text-danger">@{{ msg.filter }}</p>
        <div class="row products">
            <div class="col-md-3 border x-1" v-for="item in showProducts">
                <a v-bind:href="'/product/details/'+item.id">
                    <img class="img" v-bind:src="'/images/'+item.glav_photo" alt="">
                    <p>Product name: @{{ item.name }}</p>
                    <p>Price: @{{ item.price }}@{{ item.valuta }}</p>
                    <p>Quantity: @{{ item.quantity }}</p>
                    <p>Seller: <a v-bind:href="'/products/'+item.seller.id">@{{ item.seller.name }} @{{ item.seller.surname }}</a></p>
                    <p class="comment">Comment: @{{ item.comment }}</p>
                </a>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script>
        new Vue({
            el: "#main",
            data: {
                products: [],
                showProducts: [],
                search: "",
                filter: {
                    open: 0, min: "", max: "", catalog: "",
                },
                catalog: [],
                msg: {filter: "", catalog: ""},
            },
            methods: {
                searchProducts:function() {
                    this.showProducts = this.products.slice()
                    this.showProducts = this.showProducts.filter(a => a.name.startsWith(this.search))
                    if  (!this.search) {
                        if  (this.filter.catalog) {
                            return this.filterCatalog()
                        }
                        this.showProducts = this.products
                    }
                },
                openSearch: function() {
                    this.filter.open = this.filter.open == 0 ? this.filter.open = 1 : this.filter.open = 0
                },
                filterPrice:function() {
                    if  (!this.filter.min && !this.filter.max) {
                        this.msg.filter = "Something went wrong"
                        return
                    }
                    if  (this.filter.catalog) {
                        this.showProducts = this.showProducts.filter(a => a.catalog != this.filter.catalog)
                    }
                    if  (this.filter.min) {
                        this.showProducts = this.showProducts.filter(a => a.price > this.filter.min)
                    }
                    if  (this.filter.max) {
                        this.showProducts = this.showProducts.filter(a => a.price < this.filter.max)
                    }
                },
                clearFilter:function() {
                    this.filter.min = ""
                    this.filter.max = ""
                    if  (this.filter.catalog) {
                        return this.filterCatalog()
                    }
                    this.showProducts = this.products
                },
                filterCatalog:function() {
                    axios.get("/filter_with_catalog/"+this.filter.catalog)
                    .then(r => {
                        this.msg.filter = ""
                        if  (r.data.length == 0) {
                            this.msg.filter = "There is nothing in this directory!"
                        }
                        this.showProducts = r.data
                    })
                },
            },
            created:function()  {
                axios.get("/get_products")
                .then(r => {
                    this.products = r.data
                    this.showProducts = r.data
                })
                axios.get("/get_catalog")
                .then(r => {
                    this.catalog = r.data
                })
            }
        })
        </script>


@endsection
