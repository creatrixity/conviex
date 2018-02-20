@extends('layout.messaging.master')

@section('view-title')
{{ $data['unreadConversations'] ? '('. $data['unreadConversations']. ')' : '' }} Conversations &middot; FashLogue
@endsection

@section('content')
            <section class="app-content u-mb-md" style="margin-top: 60px;">
                <div class="">
                    <section class="col-md-8 col-md-offset-2 col-xs-12 u-mb-md">
                        <div class="card card--default clearfix">
        					<section class="container-fluid">
        						<div class="row">

                                    @if (count($data['conversations']))
        							<ul class="list list-unstyled col-sm-10 col-sm-offset-1">
        								<h2 class="h5 u-mb-md">Your Messages</h2>

                                        @foreach($data['conversations'] as $conversation)
        								<li class="list-item">
        									<a class="media fcds-convo__listing" style="display: block;" href="{{ url(route('conversation', $conversation->id). $conversation->getLastMessageHash()) }}">
        										<div class="media-left">
        											<img src="{{ $conversation->getOtherConverser(Auth::id())->getUserAvatar('mini') }}" width="40" alt="" class="img img-circle">
        										</div>
        										<div class="media-body">

        											<div class="col-xs-10">
        												<h3 class="h4 media-heading">{{ $conversation->getOtherConverser(Auth::id())->name }}</h3>
        												<p class="text-muted">
                                                            @if($conversation->getLastMessage() && $conversation->getLastMessage()->user_id == Auth::id())
                                                            <span class="u-weight--bold text-muted">You:</span>
                                                            @endif

                                                            {{ $conversation->getLastMessage() ? $conversation->getLastMessage()->body : 'Click to send a message' }}
        												</p>
        												<hr class="hidden-xs">
        											</div>

        											<div class="col-xs-2">
        												<time class="fcds-convo__date text-muted small text-right">
                                                            {{ $conversation->getLastMessage() ? $conversation->getLastMessage()->getTimeDiff() : $conversation->getTimeDiff() }}
        												</time>
        											</div>

        										</div>
        									</a>
        								</li>
                                        @endforeach

        							</ul>
                                    @else
                                    Sorry no messages
                                    @endif

        						</div>
        					</section>
        				</div> <!-- .fcds-convo -->

                    </section>

                </div>
            </section>

@endsection
