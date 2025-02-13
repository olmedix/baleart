<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ViewUserController extends Controller
{
    public function index($booleanValue = true)
    {
        $orderBy = $booleanValue ? 'created_at' : 'updated_at';

        $users = User::query()->orderBy($orderBy, 'desc')->paginate(10);

        return view('user.index', ['users' => $users]);
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
