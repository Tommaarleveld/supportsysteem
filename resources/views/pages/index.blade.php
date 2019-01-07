@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
        <h1>{{$title}}</h1>
        <p>This is the index page.</p>
        @if(count($inhoud))
            <ul class="list-group">
                @foreach($inhoud as $item)
                    <li class="list-group-item">{{$item}}</li>
                @endforeach
            </ul>
        </div>
    </div>    
    @endif
@endsection