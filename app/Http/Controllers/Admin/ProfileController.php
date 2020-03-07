<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function create(Request $request) {
        $user_id = Auth::id();
        $profile = Profile::where('id', $user_id)->first();
        if (!(empty($profile))) {
            return view('admin.profile.edit', ['profile_form' => $profile, 'user_id' => $user_id]);
        } else {
            return view('admin.profile.create', ['user_id' => $user_id]);   
        }
    }
    
    public function record(Request $request) {
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        unset($form['_token']);
        $profile->fill($form);
        $profile->save();
        return redirect('admin/profile/create');
    }
    
    public function data(Request $request) {
        $user_id = Auth::id();
        $profile = Profile::where('id', $user_id)->first();
        if (empty($profile)) {
            return redirect('admin/profile/create');
        } else {
            return view('admin.profile.data',  ['profile' => $profile]);
        }
    }
    
    public function edit(Request $request) {
        $user_id = Auth::id();
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            return view('admin.profile.create',  ['user_id' => $user_id]);   
        } else {
            return view('admin.profile.edit', ['profile_form' => $profile, 'user_id' => $user_id]);   
        }
    }
    
    public function update(Request $request) {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();
        return redirect('admin/profile/data');
    }
}
