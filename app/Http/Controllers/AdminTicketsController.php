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

    public function markAsDone (Request $request, $id)
    {
        // Check for correct user
        if(auth()->user()->isAdmin !== 1){
            return redirect('/')->with('error', 'Alleen een admin mag tickets goedkeuren.');
        }

        $ticket = Ticket::find($id);
        $ticket->status = 'done';
        $ticket->save();

        //Add a point to user where ticket->user_id is the same as user->id
        User::find($ticket->user_id)->increment('points', 1);

        return redirect('/admin/tickets')->with('success', 'Het ticket is nu goedgekeurd en afgehandeld.');
    }
    
    public function dissaproveTicket(Request $request, $id)
    {

        $ticket = Ticket::find($id);

        // Check if current user is the admin otherwise give errormessage
        if(auth()->user()->isAdmin == 1){
            $ticket->status = 'doing';
            $ticket->save();
    
            return redirect('/admin/tickets')->with('success', 'Ticket succesvol afgekeurd.');
        }
        else{
            return redirect('/tickets')->with('error', 'Alleen een admin mag een ticket afkeuren.');
        }
    }
}
