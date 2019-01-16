{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
    <h1 class="mt-5">Tickets</h1>
    @if (count($tickets) > 0)
        @foreach($tickets as $ticket)
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h5 class="card-title"><a href="/tickets/{{$ticket->id}}">{{$ticket->title}}</a></h5>
                            </div>
                            <div class="col-md-5">
                                @if(Auth::user()->isAdmin == 1)
                                {!!Form::open(['action' => ['TicketsController@destroy', $ticket->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Verwijderen', ['class' => 'btn btn-outline-danger'])}}
                                {!!Form::close()!!}
                                <a href="/tickets/{{$ticket->id}}/edit" class="btn btn-outline-primary float-right mr-1">Edit</a>
                                @endif()
                                <a class="btn btn-primary float-right mr-1" href="/tickets/claimTicket/{{$ticket->id}}">Claim ticket</a>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <small>Aangemaakt op {{$ticket->created_at}}</small>
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