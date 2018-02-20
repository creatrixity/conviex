@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        Conviex Users
                    </h3>
                    <p class="small text-muted">Tap the message button to start a conversation.</p>

                </div>

                <div class="panel-body">
                    <section class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td><span class="sr-only">Avatar</span></td>
                                    <td><b>Name</b></td>
                                    <td><b>Username</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['users'] as $user)
                                @if ($user and $user->id != Auth::id())
                                <tr>
                                    <td> <img class="img img-responsive img-circle" src="{{ $user->getUserAvatar(30) }}" alt="{{ $user->getFirstName() }} avatar"> </td>
                                    <td>{{ $user->getFirstName() }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <a href="{{ url(route('message', $user->id)) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Start a conversation with {{ $user->name }}">
                                            <i class="glyphicon glyphicon-envelope" style="font-size: 18px;"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
