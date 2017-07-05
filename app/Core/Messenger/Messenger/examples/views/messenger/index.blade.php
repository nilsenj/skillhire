@extends('layouts.master')

@section('content')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
    @if($Proposals->count() > 0)
        @foreach($Proposals as $Proposal)
        <?php $class = $Proposal->isUnread($currentUserId) ? 'alert-info' : ''; ?>
        <div class="media alert {!!$class!!}">
            <h4 class="media-heading">{!! link_to('messages/' . $Proposal->id, $Proposal->subject) !!}</h4>
            <p>{!! $Proposal->latestMessage->body !!}</p>
            <p><small><strong>Creator:</strong> {!! $Proposal->creator()->name !!}</small></p>
            <p><small><strong>Participants:</strong> {!! $Proposal->participantsString(Auth::id()) !!}</small></p>
        </div>
        @endforeach
    @else
        <p>Sorry, no Proposals.</p>
    @endif
@stop
