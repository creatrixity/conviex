@extends('layouts.app')

@section('view-title')
{{ $data['unreadConversations'] ? '('. $data['unreadConversations']. ')' : '' }} Conversations &middot; FashLogue
@endsection

@section('content')
He
            <section class="app-content u-mb-md" style="margin-top: 60px;">
                <div class="">
                    <section class="col-md-8 col-md-offset-2 col-xs-12 u-mb-md">
                        <div class="card card--default clearfix">
        					<section class="container-fluid">
        						<div class="row">

                                    @if (count($data['conversations']))
        							<ul class="list list-unstyled col-sm-10 col-sm-offset-1">
        								<h2 class="h4" style="margin-bottom: 30px;">Your Messages</h2>

                                        @foreach($data['conversations'] as $conversation)
        								<li class="list-item">
        									<a class="media" style="display: block;" href="{{ url(route('conversation', $conversation->id). $conversation->getLastMessageHash()) }}">
        										<div class="media-left">
        											<img src="{{ $conversation->getOtherConverser(Auth::id())->getUserAvatar(40) }}" alt="" class="img img-circle">
        										</div>
        										<div class="media-body">

        											<div class="col-xs-10">
        												<h3 class="h4 media-heading">{{ $conversation->getOtherConverser(Auth::id())->name }}</h3>
        												<p class="text-muted">
                                                            @if($conversation->getLastMessage() && $conversation->getLastMessage()->user_id == Auth::id())
                                                            <span class="u-weight--bold text-muted">You:</span>
                                                            @endif

                                                            {!! $conversation->getLastMessage() ?
                                                                $conversation->getLastMessage()->body :
                                                                '<i class="glyphicon glyphicon-envelope"></i> &nbsp; Message'
                                                            !!}
        												</p>
        												<hr class="hidden-xs">
        											</div>

        											<div class="col-xs-2">
        												<time class="text-muted small text-right">
                                                            {{ $conversation->getLastMessage() ? $conversation->getLastMessage()->getTimeDiff() : $conversation->getTimeDiff() }}
        												</time>
        											</div>

        										</div>
        									</a>
        								</li>
                                        @endforeach

        							</ul>
                                    @else
                                    <div class="container-fluid">
                                        <section class="row">
                                            <div class="col-md-10 col-md-offset-1">
                                                <h2 class="h3" style="margin-bottom: 30px;">Let's get you started</h2>

                                                <p class="lead text-muted">Oops. Your conversations list is a little sad at the moment. You could <a href="{{ url(route('users')) }}">start a conversation now</a></p>

                                            </div>
                                        </section>
                                    </div>
                                    @endif

        						</div>
        					</section>
        				</div>

                    </section>

                </div>
            </section>

@endsection
