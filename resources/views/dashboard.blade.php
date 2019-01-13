@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-10">
            <h1>Dashboard</h1>
            <div class="card">
                <div class="card-body">
                    <h3>Doing</h3>
                    <p class="infotext">Onderstaande tickets zijn door jou geclaimed.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h3>To Review</h3>
                    <p class="infotext">Onderstaande tickets zijn in afwachting op goedkeuring van een admin.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h3>Done</h3>
                    <p class="infotext">Onderstaande tickets zijn met succes door jou volbracht.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
