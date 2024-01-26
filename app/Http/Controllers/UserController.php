<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        return response()->json($user);
}



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::find($user->id);
        if ($user == null) {

            return response()->json(['message' => 'Nincs ilyen felhasználó'], 404);
        } else {
            return response()->json($user);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $rules = [
            'username' =>'unique:users|min:6',
            'email' => 'email|unique:users',
            'password' => 'string|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])/'
        ];
        $messages = [
            'username.unique' => 'A megadott felhasználónév már foglalt',
            'username.min' => 'A felhasználónév legalább 6 karakter hosszú kell legyen',
            'email.email' => 'Érvénytelen e-mail cím',
            'email.unique' => 'A megadott e-mail cím már foglalt',
            'password.string' => 'A jelszónak karaktereket kell tartalmaznia',
            'password.min' => 'A jelszónak legalább 8 karakterből kell állnia',
            'password.regex' => 'A jelszónak legalább egy nagybetűt és egy számot kell tartalmaznia'
        ];

        $user = User::find($user->id);
        if (!$user) {

            return response()->json(['message' => 'Nincs ilyen felhasználó'], 404);
        } else{
            $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response ()->json($errors, 400);
        } else {
            $request['password'] = bcrypt($request->password);
            $user->update($request->all());
            return response()->json($user, 200);
    }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::find($user->id);

        if (!$user) {
            return response()->json(['message'=> 'No student found'], 404);
        } else {
            $user->delete();
            return response()->json(["message" => "Felhasználó törölve"], 200);
        }
    }
}
