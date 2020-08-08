<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use JWTAuth;
use Hash;
use App\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->data = [
            'status' => false,
            'code' => 401,
            'data' => null,
            'err' => [
                'code' => 1,
                'message' => 'Unauthorized'
            ]
        ];
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                throw new Exception('invalid_credentials');
            }
            $this->data = [
                'status' => true,
                'code' => 200,
                'data' => [
                    '_token' => $token
                ],
                'err' => null
            ]; } catch (Exception $e) {
            $this->data['err']['message'] = $e->getMessage();
            $this->data['code'] = 401;
        } catch (JWTException $e) {
            $this->data['err']['message'] = 'Could not create token';
            $this->data['code'] = 500;
        }
        return response()->json($this->data, $this->data['code']);
    }

    public function register(Request $request): JsonResponse
    {
        $user = User::create([
                                 'name' => $request->post('name'),
                                 'email' => $request->post('email'),
                                 'password' => Hash::make($request->post('password')),
                                'role' => $request->post('role')
                             ]);
        $this->data = [
            'status' => true,
            'code' => 200,
            'data' => [
                'User' => $user
            ],
            'err' => null
        ];
        return response()->json($this->data, $this->data['code']);
    }/**
 *Log out the user and make the token unusable.
 * @return JsonResponse
 */
    public function logout(): JsonResponse
    {
        auth()->logout();
        $data = [
            'status' => true,
            'code' => 200,
            'data' => [
                'message' => 'Successfully logged out'
            ],
            'err' => null
        ];
        return response()->json($data);
    }/**
 * Renewal process to make JWT reusable after expiry date.
 * @return JsonResponse
 */
    public function refresh(): JsonResponse
    {
        $data = [
            'status' => true,
            'code' => 200,
            'data' => [
                '_token' => auth()->refresh()
            ],
            'err' => null
        ];
        return response()->json($data, 200);
    }
}
