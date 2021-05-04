@extends('layouts/blocked')

@section('p1')
    <div class="blocked">
            <div>
                <h3><b>Dear</b> <span class="text-danger">{{ $user->name }} {{ $user->surname }}</span></h3>
                <p>Your account is blocked. Related to the <b>"<i>{{ $user->blocked->comment }}</i>"</b>. Your account is unlocked via</p>
                <h1 class="text-center">{{ $user->blocked->time }}</h1>
                <p  class="text-center">d/m/Y h:i</p>
               <div class="row">
                   <div class="col-md-3">
                        <a href="/">Go Back</a>
                   </div>
                   <div class="col-md-9">
                       <p class="text-right"><u>25 Massachusetts Avenue Washington DC, 20001 United States Tel: (202) 346-1100</u></p>
                   </div>
               </div>
            </div>
    </div>
@endsection
