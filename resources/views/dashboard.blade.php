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
                    @if (count($tickets->where('status', 'doing')) > 0)
                    <table class="table table-striped">
                            <tr>
                                <th>Titel</th>
                                <th></th>
                                <th></th>
                            </tr>
                    @foreach($tickets->where('status', 'doing') as $ticket)
                        <tr>
                            <th><a href="/tickets/{{$ticket->id}}">{{$ticket->title}}</a></th>
                            <th><a class="btn btn-outline-success float-right" href="/tickets/markAsToReview/{{$ticket->id}}">Afronden</a></th>
                            <th><a class="btn btn-outline-danger float-right" href="/tickets/dropTicket/{{$ticket->id}}">Dump Ticket</a></th>
                        </tr>
                    @endforeach
                    </table>
                    @else
                    <p>Je hebt op dit moment geen tickets geclaimed.</p>
                    @endif
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
                    @if (count($tickets->where('status', 'toreview')) > 0)
                    <table class="table table-striped">
                            <tr>
                                <th>Titel</th>
                            </tr>
                    @foreach($tickets->where('status', 'toreview') as $ticket)
                        <tr>
                            <th><a href="/tickets/{{$ticket->id}}">{{$ticket->title}}</a></th>
                        </tr>
                    @endforeach
                    </table>
                    @else
                    <p>Je hebt op dit moment geen tickets die in afwachting zijn op goedkeuring.</p>
                    @endif
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
