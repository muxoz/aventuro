<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\LoginRequest;

class AuthenticatedSessionController
{
    /**
     * Handle an incoming authentication request.
     */
    /**
     * @unauthenticated
     */
    public function store(LoginRequest $request)
    {
        if (! $token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'user' => auth()->user(),
            'token' => $token,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        auth()->logout();

        return response()->json(status: 200);
    }
}
