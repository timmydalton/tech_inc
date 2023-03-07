<?php

use Closure;
use Illuminate\Http\Request;
use App\Models\Accounts;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $param = $request->all();
        $token = $param->token;
        if (!isset($token)) return response()->json(['message' => 'missing token'], 500);
        $user = Accounts::where([
          ['token', '=', $token]
        ])->first();
        if (!isset($user)) return response()->json(['message' => 'token incorrect'], 500);
        return $next($request);
    }
}
