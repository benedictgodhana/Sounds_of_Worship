<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class SettingController extends Controller
{
    public function edit()
    {
        return view('settings.index');
    }



    public function update(){
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        auth()->user()->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }


    public function getActiveSessions(Request $request)
{
    $agent = new Agent();

    $browser = $agent->browser();
    $platform = $agent->platform();

    return response()->json([
        'browser' => $browser,
        'platform' => $platform,
    ]);
}

}
