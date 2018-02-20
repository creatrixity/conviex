<?php
namespace App\Services\Web\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;

use Framework\User;

class ListUsersFeature extends Feature
{
    public function handle(Request $request)
    {
        $users = User::all();

        $data = [
            'users' => $users
        ];

        return view('app.user.user-index', [
            'data' => $data
        ]);
    }
}
