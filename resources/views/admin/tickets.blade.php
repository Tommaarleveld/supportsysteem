@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <h1>Admin Panel</h1>
            <div class="card">
                <div class="card-body">
                    <h3>Doing</h3>
                    <p class="infotext">Onderstaande tickets worden op dit moment uitgevoerd.</p>
                    @if (count($ticketsDoing) > 0)
                        @foreach($ticketsDoing as $ticketDoing)
                            <div class="card bg-light mt-1">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5><a class="card-title align-middle" href="/tickets/{{$ticketDoing->id}}">{{$ticketDoing->title}}</a></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-12">
                                                            <small>Wordt uitgevoerd door: <span class="text-dark font-weight-bold">{{$ticketDoing->userName}}</span></small>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">Level:</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <p class="text-uppercase font-weight-bold">{{$ticketDoing->level}}</p>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                <a class="btn btn-outline-danger float-right" href="/tickets/dropTicket/{{$ticketDoing->id}}">Dump Ticket</a>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <div class="mt-2">
                        {{$ticketsDoing->links()}}
                    </div>
                    @else
                    <p>Er zijn op dit moment geen tickets met de status "Doing".</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>To Review</h3>
                    <p class="infotext">Onderstaande tickets zijn in afwachting op goedkeuring van een admin.</p>
                    @if (count($ticketsToReview) > 0)
                        @foreach($ticketsToReview as $ticketToReview)
                            <div class="card bg-light mt-1">
                                <div class="card-body">
                                    <div class="container">
                                            <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5><a class="card-title align-middle" href="/tickets/{{$ticketToReview->id}}">{{$ticketToReview->title}}</a></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small>Wordt uitgevoerd door: <span class="text-dark font-weight-bold">{{$ticketToReview->userName}}</span></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-12">Level:</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                <p class="text-uppercase font-weight-bold">{{$ticketToReview->level}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a class="btn btn-outline-danger float-right" href="/tickets/dissaproveTicket/{{$ticketToReview->id}}">Afkeuren</a>
                                                        <a class="btn btn-outline-success float-right mr-1" href="/tickets/markAsDone/{{$ticketToReview->id}}">Goedkeuren</a>
                                                    </div>  
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-2">
                            {{$ticketsToReview->links()}}
                        </div>
                    @else
                    <p>Er zijn op dit moment geen tickets met de status "To Review".</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Done</h3>
                    <p class="infotext">Onderstaande tickets zijn met succes volbracht.</p>
                    @if (count($ticketsDone) > 0)
                        @foreach($ticketsDone as $ticketDone)
                            <div class="card bg-light mt-1">
                                <div class="card-body">
                                    <div class="container">
                                            <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5><a class="card-title align-middle" href="/tickets/{{$ticketDone->id}}">{{$ticketDone->title}}</a></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-md-12">
                                                                    <small>Ticket is uitgevoerd door: <span class="text-dark font-weight-bold">{{$ticketDone->userName}}</span></small>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                                <div class="col-md-12">Level:</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <p class="text-uppercase font-weight-bold">{{$ticketDone->level}}</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        @if(Auth::user()->isAdmin == 1)
                                                        {!!Form::open(['action' => ['TicketsController@destroy', $ticketDone->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {{Form::submit('Verwijderen', ['class' => 'btn btn-outline-danger'])}}
                                                        {!!Form::close()!!}
                                                        @endif
                                                    </div>  
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-2">
                            {{$ticketsDone->links()}}
                        </div>
                    @else
                    <p>Er zijn op dit moment geen tickets met de status "Done".</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
