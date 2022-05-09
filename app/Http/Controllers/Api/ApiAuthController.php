<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    //
    public function loginPersonal(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            // $user = User::with('city')->where('email', '=', $request->input('email'))->first();
            if (Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('User-API');
                $user->setAttribute('token', $token->accessToken);
                // $user->load('city');
                return response()->json([
                    'status' => true,
                    'message' => 'Logged in successfully',
                    'object' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Wrong credentials, check password!',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    public function loginPGCT(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            return $this->generateToken($request);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    private function generateToken(Request $request)
    {
        try {
            //http://natuf.mr-dev.tech/oauth/token
            //http://127.0.0.1:81/oauth/token
            $response = Http::asForm()->post('http://natuf.mr-dev.tech/oauth/token', [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'bOBN6XAiQB1zWbxXLotLGaWMN3SEjaPYIcrjTe3H',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '*',
            ]);

            // return $response['access_token'];
            $decodedJson = json_decode($response);
            $user = User::where('email', '=', $request->input('email'))->first();
            $user->setAttribute('token', $decodedJson->access_token);
            return response()->json([
                'status' => true,
                'message' => 'Logged in successfully',
                'data' => $user,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $decodedJson->message,
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'password' => 'required|string|current_password:user-api',
            'new_password' => 'required|string|min:3|confirmed',
            // 'new_password_confirmation'=>'required|same:new_password'
        ]);

        if (!$validator->fails()) {
            // $usre = auth('user-api')->user();
            $user = $request->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return response()->json([
                'status' => $isSaved,
                'message' => $isSaved ? 'Password updated successfully' : 'Password update failed!',
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    //
    public function forgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();

            $randomCode = random_int(1000, 9999);
            $user->verification_code = Hash::make($randomCode);
            $isSaved = $user->save();
            return response()->json([
                'status' => $isSaved,
                'message' => $isSaved ? 'Code sent successfully' : 'Code sending failed!',
                'code' => $randomCode,
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'code' => 'required|numeric|digits:4',
            'new_password' => 'required|string|min:3|confirmed'
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (!is_null($user->verification_code)) {
                if (Hash::check($request->input('code'), $user->verification_code)) {
                    $user->password = Hash::make($request->input('new_password'));
                    $user->verification_code = null;
                    $isSaved = $user->save();
                    return response()->json([
                        'status' => $isSaved,
                        'message' => $isSaved ? 'Password reset successfully' : 'Password reset failed!',
                    ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Reset process rejected, no verification code!',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        $revoked = $request->user('user-api')->token()->revoke();
        return response()->json(
            ['message' => $revoked ? 'Logged out successfully' : 'Logout failed!'],
            $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
