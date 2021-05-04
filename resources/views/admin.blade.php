<style>
    .x-1 {
        margin-top: 5px;
    }
    .x-5 {
        cursor: pointer;
    }
    .x-2 {
        margin: auto;
        height: 26px;
        cursor: pointer;
    }
    .x-3 {
        min-height: 40px;
    }
    .x-4 {
        padding: 10px;
        cursor: auto;
    }
</style>

@extends('layouts.admin')

@section('p1')

    <div id="app">
        <h1>Admin/ {{ $admin->name }} {{ $admin->surname }}</h1>
        <example-component>

        </example-component>
    </div>

    <script src={{ mix("js/app.js") }}></script>

@endsection
