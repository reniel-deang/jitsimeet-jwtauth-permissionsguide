<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class JitsiTokenController extends Controller
{
    public function generateToken(Request $request)
    {
        // Fetch inputs: room_name, user details, and affiliation
        $room_name = $request->input('room_name');
        $user_name = $request->input('user_name');
        $user_email = $request->input('user_email');
        $affiliation = $request->input('affiliation', 'member'); // Default to 'member'

        // Jitsi App credentials
        $app_id = 'jitsi_class_app_12d93f6e';
        $app_secret = 'b4a5f784d7b8f9e12c6a58a3b9d12345a9e8f7a6c5b4d3a2f1e8d7c9b6a5e4f3';

        // JWT Payload
        $payload = [
            'aud' => $app_id,
            'iss' => $app_id,
            'sub' => 'api.codecraftmeet.online',
            'room' => $room_name,
            'exp' => time() + 3600, // Token expires in 1 hour
            'context' => [
                'user' => [
                    'name' => $user_name,
                    'email' => $user_email,
                    'avatar' => 'https://gravatar.com/avatar/abc123',
                    'affiliation' => $affiliation, // Owner for moderator, member for guests
                ]
            ]
        ];

        // Generate JWT Token
        $token = JWT::encode($payload, $app_secret, 'HS256');

        // Concatenate the URL
        $url = "https://webapi.codecraftmeet.online/{$room_name}?jwt={$token}";

        // Return response
        return response()->json(['url' => $url, 'token' => $token]);
    }
}
