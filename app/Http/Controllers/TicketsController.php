<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\User;

class TicketsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
       if($request->has('level')){
            $tickets = Ticket::orderBy('created_at', 'asc')->where('status', 'todo')->where('level', $request->get('level'))->paginate(5);
        }
        else if($request->has('search')){
            $tickets = Ticket::orderBy('created_at', 'asc')->where('status', 'todo')->where('title','LIKE', '%'. $request->get('search') .'%')->orWhere('level','LIKE', '%'. $request->get('search') .'%')->paginate(5);
        }
        else{
            //Get all the tickets
            $tickets = Ticket::orderBy('created_at', 'asc')->where('status', 'todo')->paginate(5);
        }

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
        if(auth()->user()->isAdmin !== 1){
            return redirect('/tickets')->with('error', 'Alleen een admin mag tickets aanmaken.');
        }

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
        if(auth()->user()->isAdmin !== 1){
            return redirect('/tickets')->with('error', 'Alleen een admin mag tickets aanmaken.');
        }

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
        if(auth()->user()->isAdmin !== 1){
            return redirect('/tickets')->with('error', 'Alleen een admin mag tickets aanpassen.');
        }

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
        if(auth()->user()->isAdmin !== 1){
            return redirect('/tickets')->with('error', 'Alleen een admin mag tickets aanpassen.');
        }

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

    public function claimTicket(Request $request, $id)
    {
        //Retrieve the ticket, request the user_id and then save the ticket.
        $ticket = Ticket::find($id);

        //If ticket level is medium and the user points is lower then 10 redirect with error message
        if($ticket->level == 'medium' && auth()->user()->points < 20){
            return redirect('/tickets')->with('error', 'Je hebt niet voldoende tickets afgerond om een ticket met het level "MEDIUM" te claimen. Ga eerst met tickets aan de slag met het level "EASY".');
        }
        //If ticket level is hard and the user points is lower then 20 redirect with error message
        else if($ticket->level == 'hard' && auth()->user()->points < 20){
            return redirect('/tickets')->with('error', 'Je hebt niet voldoende tickets afgerond om een ticket met het level "HARD" te claimen. Ga eerst met tickets aan de slag met het level "EASY" Of "MEDIUM".');
        }
        //If ticket level is expert and the user points is lower then 30 redirect with error message
        else if($ticket->level == 'expert' && auth()->user()->points < 30){
            return redirect('/tickets')->with('error', 'Je hebt niet voldoende tickets afgerond om een ticket met het level "EXPERT" te claimen. Ga eerst met tickets aan de slag met het level "EASY", "MEDIUM" of "HARD".');
        }

        $ticket->user_id = auth()->user()->id;
        $ticket->status = 'doing';
        $ticket->save();

        return redirect('/dashboard')->with('success', 'Ticket succesvol geclaimed.');
    }

    public function dropTicket(Request $request, $id)
    {

        $ticket = Ticket::find($id);

        // Check for correct user
        if(auth()->user()->id !== $ticket->user_id){
             return redirect('/tickets')->with('error', 'Alleen de gebruiker die dit ticket heeft geclaimed mag deze actie uitvoeren.');
        }

        $ticket->user_id = NULL;
        $ticket->status = 'todo';
        $ticket->save();

        return redirect('/dashboard')->with('success', 'Ticket succesvol gedumpt.');
    }

    public function markAsToReview (Request $request, $id)
    {
        $ticket = Ticket::find($id);
        
        // Check for correct user
        if(auth()->user()->id !== $ticket->user_id){
            return redirect('/tickets')->with('error', 'Alleen de gebruiker die dit ticket heeft geclaimed mag deze actie uitvoeren.');
        }

        $ticket->status = 'toreview';
        $ticket->save();

        return redirect('/dashboard')->with('success', 'Het ticket is nu in afwachting op goedkeuring.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->isAdmin !== 1){
            return redirect('/tickets')->with('error', 'Alleen een admin mag tickets verwijderen.');
        }

        $ticket = ticket::find($id);
        $ticket->delete();

        return redirect('/tickets')->with('success', 'Ticket succesvol verwijderd');
    }
}
