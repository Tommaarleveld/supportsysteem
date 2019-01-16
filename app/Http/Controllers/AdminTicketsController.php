<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\User;

class AdminTicketsController extends Controller
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

    public function index()
    {
        if(auth()->user()->isAdmin !== 1){
            return redirect('/tickets')->with('error', 'Alleen een admin mag het control panel beheren.');
        }

        //Get all the tickets
        $ticketsDoing = Ticket::orderBy('created_at', 'asc')->where('status', 'doing')->paginate(5);
        $ticketsToReview = Ticket::orderBy('created_at', 'asc')->where('status', 'toreview')->paginate(5);
        $ticketsDone = Ticket::orderBy('created_at', 'asc')->where('status', 'done')->paginate(5);

        foreach($ticketsDoing as $ticketDoing){
            if(User::find($ticketDoing->user_id)){
                $ticketDoing->userName = User::find($ticketDoing->user_id)->name;
            }
        }

        foreach($ticketsToReview as $ticketToReview){
            if(User::find($ticketToReview->user_id)){
                $ticketToReview->userName = User::find($ticketToReview->user_id)->name;
            }
        }

        foreach($ticketsDone as $ticketDone){
            if(User::find($ticketDone->user_id)){
                $ticketDone->userName = User::find($ticketDone->user_id)->name;
            }
        }

        //Return the tickets alongside the view
        return view ('admin.tickets', compact('ticketsDoing', 'ticketsToReview', 'ticketsDone'));
    }
    
}
