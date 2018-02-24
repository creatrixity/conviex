@extends('layouts.app')

@section('view-title')
{{ $data['unreadMessages'] ? '('. $data['unreadMessages']. ')' : '' }} Messages &middot; FashLogue
@endsection

@section('content')
            <section class="app-content u-mb-md" style="margin-top: 60px;">
                <div class="">
                    <section class="col-md-6 col-md-offset-3 col-xs-12 u-mb-md">
                      <div class="fcds-convo card card--default clearfix">
              					<header class="fcds-convo__header">
              						<a href="{{ url(route('conversations')) }}" class="fcds-convo__link"> < All messages</a>

                                    @foreach($data['conversers'] as $converser)
              						<div class="fcds-convo__participant text-center">
                                            <a href="{{ url(route('profile', $converser->user->username)) }}" class="link link--regular">
                                                <img src="{{ $converser->user->getUserAvatar(30) }}" width="40" alt="" class="fcds-convo__avatar img img-circle u-mr-xs">
                  								<h2 class="fcds-convo__title h4">{{ $converser->user->getFirstName() }}</h2>
                                            </a>
              						</div> <!-- .fcds-convo__participant -->
                                    @endforeach

              					</header> <!-- .fcds-convo__header -->

              					<main class="fcds-convo__main container-fluid">

                                    @if (count($data['messages']))

                                    @foreach($data['messages'] as $message)

                                    @if ($message->user_id != Auth::user()->id)
                                    <div class="fcds-convo__item u-mb-md" id="message-{{ $message->id }}">
              							<section class="media">

              								<a class="media-left pull-left" href="{{ url(route('profile', $message->user->username)) }}">
              									<img src="{{ $message->user->getUserAvatar(30) }}" width="32" alt="" class="fcds-convo__avatar img img-circle">
              								</a>

              								<div class="media-body">

              									<p class="fcds-convo__message">
                                                    {{ $message->body }}
              									</p>

              									<time class="fcds-convo__date text-muted" style="font-size: 10px;">
              										{{ $message->getTimeDiff() }}
              									</time>

              								</div>

              							</section>

              						</div> <!-- .fcds-convo__item -->

                                    @else
                                    <div class="fcds-convo__item  fcds-convo__item--user pull-right u-mb-md" id="message-{{ $message->id }}">

              								<p class="fcds-convo__message">
              									{{ $message->body }}
              								</p>

              								<time class="fcds-convo__date text-muted small text-right" style="font-size: 10px;">
                                                {{ $message->getTimeDiff() }}
              								</time>

              						</div> <!-- .fcds-convo__item -->
                                    @endif

              						<div class="clearfix"></div>

                                    @endforeach

                                    @endif

              					</main> <!-- .fcds-convo__main -->

              					<footer class="fcds-convo__footer">
              						<form action="{{ url(route('message.create')) }}" method="post" class="container-fluid">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="conversation_id" value="{{ $data['conversation']->id }}">
              							<section class="">

              								<div class="input-group col-xs-12">
              									<input name="body" required autofocus="autofocus" autocomplete="off" placeholder="Enter message and hit enter." id="body" class="form-control fcds-convo__input">
              									<label for="trigger" tabindex="0" class="input-group-addon btn btn-primary">
              										Send
              									</label>

              									<input id="trigger" class="hidden" value="Hello" type="submit">

              								</div>

              							</section>

              						</form>
              					</footer> <!-- fcds-convo__footer -->

                      </div> <!-- .fcds-convo -->

                    </section>

                </div>
            </section>

@endsection
