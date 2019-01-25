{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <h1>Tickets</h1>
        </div>
        <div class="col-md-3">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/tickets?level=easy">Easy</a>
                    <a class="dropdown-item" href="/tickets?level=medium">Medium</a>
                    <a class="dropdown-item" href="/tickets?level=hard">Hard</a>
                    <a class="dropdown-item" href="/tickets?level=expert">Expert</a>
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/tickets">All</a>
                </div>
            </div>
        </div>
        <div class="col-md-4" align="right">
            {!!Form::open(['action' => ['TicketsController@index'], 'method' => 'GET', 'class' => ''])!!}
                {{Form::text('search')}}
                {{Form::submit('Zoeken', ['class' => 'btn btn-primary'])}}
            {!!Form::close()!!}
        </div>
    </div>
</div>
    @if (count($tickets) > 0)
        @foreach($tickets as $ticket)
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="card-title"><a href="/tickets/{{$ticket->id}}">{{$ticket->title}}</a></h5>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                        <small>Aangemaakt op {{$ticket->created_at}}</small>
                                        </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">Level:</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <p class="text-uppercase font-weight-bold">{{$ticket->level}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if(Auth::user()->isAdmin == 1)
                                {!!Form::open(['action' => ['TicketsController@destroy', $ticket->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Verwijderen', ['class' => 'btn btn-outline-danger'])}}
                                {!!Form::close()!!}
                                <a href="/tickets/{{$ticket->id}}/edit" class="btn btn-outline-primary float-right mr-1">Edit</a>
                                @endif
                                <a class="btn btn-primary float-right mr-1" href="/tickets/claimTicket/{{$ticket->id}}">Claim ticket</a>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-2">
        {{$tickets->links()}}
        </div>
    @else
        <p>Er zijn geen tickets beschikbaar op dit moment</p>
    @endif
@endsection