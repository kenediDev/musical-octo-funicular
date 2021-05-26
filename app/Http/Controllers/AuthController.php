<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use TypeError;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        if (!$token = JWTAuth::attempt(['email' => $request->name, 'password' => $request->password])) {
            return response()->json(['message' => 'Nama Pengguna atau kata sandi salah'], 400);
        }
        return $this->responseWithToken($token);
    }

    public function reset(Request $request)
    {
        $val = Validator::make($request->all(), [
            'token' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $check = User::where('email', '=', $request->token)->first();
        if (!$check) {
            return response()->json(['message' => 'Akun tidak dapat ditemukan'], 404);
        }
        Mail::send("welcome", ["user" => $check], function ($m) use ($check) {
            $m->from(env("MAIL_USERNAME"), "Laravel");
            $m->to($check->email, $check->name)->subject("Hello Worlds");
        });
        return response()->json(['message' => 'Akun telah direset, silahkan periksa inbox email anda untuk mendapatkan kata sandi baru'], 200);
    }

    public function update(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'brithday' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $datetime = null;
        try {
            $datetime = new DateTime($request->brithday);
        } catch (TypeError) {
            $datetime = $request->brithday;
        }
        $auth->accounts->first_name = $request->first_name;
        $auth->accounts->last_name = $request->last_name;
        $auth->accounts->gender = $request->gender;
        $auth->accounts->brithday = date_format($datetime, "Y-m-d");
        $auth->accounts->save();
        return response()->json(['message' => 'Profil telah diperbarui', 'results' => new UserResource($auth)], 200);
    }

    public function updateProfile(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $files = null;
        if ($request->hasFile("avatar")) {
            $files = Storage::disk("upload_public")->put("images/avatar", $request->file("avatar"));
        } else if ($request->avatar) {
            $files = $request->avatar;
        }
        if ($files) {
            $auth->accounts->avatar = $files;
            $auth->accounts->save();
        }
        return response()->json(['message' => 'Avatar telah diperbarui', 'results' => new UserResource($auth)], 200);
    }

    public function updateBackground(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $files = null;
        if ($request->hasFile("background")) {
            $files = Storage::disk("upload_public")->put("images/background", $request->file("background"));
        } else if ($request->background) {
            $files = $request->background;
        }
        if ($files) {
            $auth->accounts->background = $files;
            $auth->accounts->save();
        }
        return response()->json(['message' => 'Sampul telah diperbarui', 'results' => new UserResource($auth)], 200);
    }

    public function me(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        return response()->json(new UserResource($auth), 200);
    }

    public function updatePrivate(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        if ($auth->accounts->is_superuser) {
            $find = User::where("email", "=", $request->email)->first();
            $find->accounts->is_superuser = $request->is_superuser;
            $find->accounts->staff = $request->staff;
            $find->accounts->save();
            return response()->json(['message' => 'Privasi telah diperbarui', 'results' => new UserResource($find)], 200);
        } else return response()->json(['message' => 'Maaf anda tidak memiliki access ini!'], 400);
    }

    protected function responseWithToken($token)
    {
        return [
            'token' => $token,
            'types' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
    }
}
