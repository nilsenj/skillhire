<?php namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Proposal;
use App\Core\Messenger\Models\Message;
use App\Core\Messenger\Models\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    /**
     * Just for testing - the user should be logged in. In a real
     * app, please use standard authentication practices
     */
    public function __construct()
    {
        $user = User::find(1);
        Auth::login($user);
    }

    /**
     * Show all of the message Proposals to the user
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;

        // All Proposals, ignore deleted/archived participants
        $Proposals = Proposal::getAllLatest()->get();

        // All Proposals that user is participating in
        // $Proposals = Proposal::forUser($currentUserId)->latest('updated_at')->get();

        // All Proposals that user is participating in, with new messages
        // $Proposals = Proposal::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        return view('messenger.index', compact('Proposals', 'currentUserId'));
    }

    /**
     * Shows a message Proposal
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $Proposal = Proposal::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The Proposal with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $Proposal->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $Proposal->participantsUserIds($userId))->get();

        $Proposal->markAsRead($userId);

        return view('messenger.show', compact('Proposal', 'users'));
    }

    /**
     * Creates a new message Proposal
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger.create', compact('users'));
    }

    /**
     * Stores a new message Proposal
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();

        $Proposal = Proposal::create(
            [
                'subject' => $input['subject'],
            ]
        );

        // Message
        Message::create(
            [
                'Proposal_id' => $Proposal->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );

        // Sender
        Participant::create(
            [
                'Proposal_id' => $Proposal->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $Proposal->addParticipants($input['recipients']);
        }

        return redirect('messages');
    }

    /**
     * Adds a new message to a current Proposal
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $Proposal = Proposal::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The Proposal with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $Proposal->activateAllParticipants();

        // Message
        Message::create(
            [
                'Proposal_id' => $Proposal->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'Proposal_id' => $Proposal->id,
                'user_id'   => Auth::user()->id
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $Proposal->addParticipants(Input::get('recipients'));
        }

        return redirect('messages/' . $id);
    }
}
