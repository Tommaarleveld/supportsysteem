<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all the tickets
        $tickets = Ticket::orderBy('created_at', 'asc')->paginate(5);

        //Return the tickets alongside the view
        return view ('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the fields
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'level' => 'required'
        ]);

        //Create a ticket
        $ticket = new Ticket;
        $ticket->title = $request->input('title');
        $ticket->body = $request->input('body');
        $ticket->level = $request->input('level');
        $ticket->save();

        return redirect('/tickets')->with('success', 'Ticket succesvol aangemaakt');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get the ticket id
        $ticket = Ticket::find($id);

        //Return ticket id alongside the standard view
        return view('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);

        return view('tickets.edit')->with('ticket', $ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate the fields
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'level' => 'required'
        ]);

        //Create a ticket
        $ticket = Ticket::find($id);
        $ticket->title = $request->input('title');
        $ticket->body = $request->input('body');
        $ticket->level = $request->input('level');
        $ticket->save();

        return redirect('/tickets')->with('success', 'Ticket succesvol aangepast');
    }

    public function addUser(Request $request, $id)
    {

        //Retrieve the ticket, request the user_id from the form and then save the ticket.
        $ticket = Ticket::find($id);
        $ticket->user_id = auth()->user()->id;
        $ticket->save();

        return redirect('/tickets')->with('success', 'Ticket succesvol geclaimed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = ticket::find($id);
        $ticket->delete();

        return redirect('/tickets')->with('success', 'Ticket succesvol verwijderd');
    }
}
