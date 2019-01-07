@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <p>This is the index page.</p>
    @if(count($inhoud))
        <ul class="list-group">
            @foreach($inhoud as $item)
                <li class="list-group-item">{{$item}}</li>
            @endforeach
        </ul>    
    @endif
@endsection