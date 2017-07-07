<?php

namespace App\Http\Controllers;

use App\Core\Messenger\Models\Message;
use App\Core\Messenger\Models\Participant;
use App\Core\Messenger\Models\Proposal;
use App\Core\Transformers\ProposalsTransformer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProposalsController extends Controller
{
    /**
     * Just for testing - the user should be logged in. In a real
     * app, please use standard authentication practices
     */
    public function __construct()
    {
    }

    /**
     * Show all of the message proposals to the user
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $currentUserId = $request->user()->id;

        // All proposals, ignore deleted/archived participants
        //$proposals = Proposal::getAllLatest()->get();

        // All proposals that user is participating in
        $proposals = Proposal::forUser($currentUserId)->latest('updated_at')->get();

        // All proposals that user is participating in, with new messages
//      $proposals = Proposal::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        return response()->json($proposals);
    }

    /**
     * Shows a message proposal
     *
     * @param $id
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        try {
            $proposal = Proposal::findOrFail($id);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error_message' => 'The proposal with ID: ' .
                $id . ' was not found.'], 404);
        }

        // show current user in list if not a current participant
         $users = User::whereIn('id', $proposal->participantsUserIds())->get();

        // don't show the current user in list
        $userId = $request->user()->id;
//        $users = User::whereNotIn('id', $proposal->participantsUserIds($userId))->get();

        $proposal->markAsRead($userId);

        return response()->json(compact('proposal', 'users'));
    }

    /**
     * Stores a new message proposal
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $input = Input::all();

        $proposal = Proposal::create(
            [
                'subject' => $input['subject'],
            ]
        );

        // Message
        $message = Message::create(
            [
                'proposal_id' => $proposal->id,
                'user_id' => $request->user()->id,
                'body' => $input['message'],
            ]
        );

        $sender = Participant::create(
            [
                'proposal_id' => $proposal->id,
                'user_id' => $request->user()->id,
                'last_read' => new Carbon()
            ]
        );

        $participants = [];
        // Recipients
        if (Input::has('recipients')) {
            $participants = $proposal->addParticipants($input['recipients']);
        }

        return response()->json([
            'proposal_id' => $proposal->id], 200);
    }

    /**
     * Adds a new message to a current proposal
     *
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            $proposal = Proposal::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            \Session::flash('error_message', 'The proposal with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $proposal->activateAllParticipants();

        // Message
        Message::create(
            [
                'proposal_id' => $proposal->id,
                'user_id' => $request->id(),
                'body' => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'proposal_id' => $proposal->id,
                'user_id' => $request->user()->id
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $proposal->addParticipants(Input::get('recipients'));
        }

        return redirect('messages/' . $id);
    }
}
