<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (session('username') == null) {
            # code...
            return view('login');
        } else {
            return redirect()->action([MonitoringController::class, 'index']);
        }
    }


    /**
     * Loging in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        $username = $request->input('username');
        $password = $request->input('password');

        $user = Auth::where('username', $username)->first();

        if ($user != null && $password == $user->password) {
            $request->session()->put('username', $user->username);
            $request->session()->put('kode_prov', $user->kd_prov);
            $request->session()->put('kode_kab', $user->kd_kab);
            $request->session()->put('nama_kab', $user->nama_kab);

            return redirect()->action([MonitoringController::class, 'index']);
        } else {
            return redirect()->action([AuthController::class, 'index'])->with('error', 'Username atau password salah!');
        }
    }

    /**
     * Loging out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        session()->forget('username');
        session()->forget('kode_prov');
        session()->forget('kode_kab');
        session()->forget('nama_kab');
        return redirect()->action([AuthController::class, 'index']);
    }
}
