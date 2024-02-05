@php
$atitle = 'support';
@endphp
@extends('layouts.header')
@section('title', 'Support Ticket')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Support</h1>
        </header>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Date & Time</th>
                                <th>Ticket Id</th>
                                <th>Username</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                @if (in_array('read', explode(',', $AdminProfiledetails->support)))
                                    <th>Action</th>
                                @endif
                                <th>Unread message</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                                $limit = 10;
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    $i = $limit * $page - $limit + 1;
                                } else {
                                    $i = 1;
                                }
                            @endphp
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($ticket->created_at)) }}</td>
                                    <td>{{ $ticket->ticket_id }}</td>
                                    <td>{{ $ticket->name }}</td>
                                    <td>{{ mb_strimwidth($ticket->subject, 0, 50, '...') }}</td>
                                    <td class="msglistcnt">{{ mb_strimwidth($ticket->message, 0, 50, '...') }}</td>
                                    <td>@if ($ticket->status == 0) Running @else Completed @endif</td>
                                    @if (in_array('read', explode(',', $AdminProfiledetails->support)))
                                        <td><a class="btn btn-primary btn-xs"
                                                href="{{ url('/admin/reply/' . Crypt::encrypt($ticket->ticket_id)) }}"
                                                class="btn btn-info">Chat</a>
                                            @if ($ticket->status == 0)
                                                <span data-toggle="tooltip" title="Mark as Complete">
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#confirm-enable"
                                                        data-href="{{ url('/admin/completeChat/' . Crypt::encrypt($ticket->id)) }}"><i
                                                            class="fa fa-check"></i> </a>
                                                </span>
                                            @endif
                                        </td>
                                    @endif

                                    <td>{{ $ticket->admin_unreadmsg($ticket->ticket_id) }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @empty
                                <tr>
                                    <td colspan="7"> No record found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    <div class="pagination-tt clearfix">
                        @if ($tickets->count())
                            {{ $tickets->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> Delete </div>
                    <div class="modal-body"> Are you sure you want to delete this user? </div>
                    <div class="modal-footer"> <a class="btn btn-danger btn-ok">Yes</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade site-modal" id="confirm-enable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-white">
                    <div class="modal-header">
                        <h5 class="modal-title">Complete Chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body text-black">
                        Are you sure, do you want to complete this chat?
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success btn-ok">Yes</a>
                        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </section>
@endsection
