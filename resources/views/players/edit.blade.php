@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between;">
            <div>{{ $player->first_name }} {{ $player->last_name }} </div>
               <a href="javascript:history.back()" class="pure-button pure-button-primary">Nazad</a>
           </div>
                <div class="card-body">
                   
                @include('players.editForm')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
