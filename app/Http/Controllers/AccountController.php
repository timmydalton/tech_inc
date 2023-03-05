<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Accounts;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function create_account(Request $request) {
      $params = $request->all();
      $username = $params['username'] ?? null;
      $password = $params['password'] ?? null;
      $info = $params['info'] ?? null;
      if (isset($username) && isset($password) && isset($info)) {
        $exist = Accounts::where('username', $username)->first();
        if (isset($exist)) {
          return response()->json(['message' => 'username existed', 'data' => $username], 401);
        }
        $user = Accounts::create([
        'username' => $username,
        'password' => $password,
        'role' => 1,
        'info' => $info
        ]);
        return response()->json(['message' => 'success', 'data' => $user], 200);
      } else return response()->json(['message' => 'missing params'], 500);
    }

    public function handle_login(Request $request) {
      $params = $request->all();
      $username = $params['username'] ?? null;
      $password = $params['password'] ?? null;
      if (isset($username) && isset($password)) {
          //find account
        $user = Accounts::where([
          ['username', '=', $username],
          ['password', '=', $password]
        ])->first();
        if (isset($user)) {
            //create new token
            $randomString = Str::random(32);
            Accounts::where('id',$user->id)->update(['token'=>$randomString]);
            //return token
            $data = [];
            $data['token'] = $randomString;
            //hide password
            $data['user'] = $user->makehidden('password');
            //return data
            return response()->json(['message' => 'ok', 'data' => $data], 200);
        } else return response()->json(['message' => 'wrong username or password'], 401);
      } else return response()->json(['message' => 'missing params'], 500);
    }

    public function get_account_by_token(Request $request) {
      $params = $request->all();
      $token = $request->token;
      if (isset($token)) {
        $user = Accounts::where([
          ['token', '=', $token]
        ])->first();
        if (!isset($user)) return response()->json(['message' => 'invalid token'], 401);
        $user->makehidden('password');
        return response()->json(['message' => 'ok', 'data' => $user], 200);
      } else return response()->json(['message' => 'missing params'], 500);
    }
}
