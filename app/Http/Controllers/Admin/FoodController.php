<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Food;
use App\Profile;

class FoodController extends Controller
{
    //
    public function top() {
        return view('top');
    }
    
    public function use() {
        $user_id = Auth::id();
        $profile = Profile::where('id', $user_id)->select('id')->first();
        return view('use', ['profile' => $profile]);
    }
    
    public function create() {
        $user_id = Auth::id();
        return view('admin.food.create', ['user_id' => $user_id]);
    }
    
    public function record(Request $request) {
        $this->validate($request, Food::$rules);
        $food = new Food;
        $form = $request->all();
      
        unset($form['_token']);
      
        $food->fill($form);
        $food->save();
        
        return redirect('admin/food/index');
    }
    
    public function index(Request $request) {
        $user_id = Auth::id();
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $foods = Food::where('user_id', $user_id)->where('food', 'like', "%{$cond_title}%")->orderBy('eat_date','desc')->get();
        } else {
            $foods = Food::where('user_id', $user_id)->orderBy('eat_date','desc')->get();
        }
        return view('admin.food.index', ['foods' => $foods, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request) {
        $user_id = Auth::id();
        $food = Food::find($request->id);
        if (empty($food)) {
        abort(404);    
      }
      return view('admin.food.edit', ['food_form' => $food, 'user_id' => $user_id]);
    }
    
    public function update(Request $request) {
        $this->validate($request, Food::$rules);
        $food = Food::find($request->id);
        $food_form = $request->all();
        unset($food_form['_token']);
        $food->fill($food_form)->save();
        return redirect('admin/food/index');
    }
    
    public function delete(Request $request) {
        $food = Food::find($request->id);
        $food->delete();
        return redirect('admin/food/index');
    }
    
    public function history(Request $request) {
        $user_id = Auth::id();
        $profile = Profile::where('id', $user_id)->first();
        $day = \Carbon\Carbon::now()->format('Y-m-d');
        $foods = Food::where('user_id', $user_id)->where('eat_date', $day)->get();
        
        $todayProtein = Food::getTodayProtein($foods);
        $todayCarbohydrate = Food::getTodayCarbohydrate($foods);
        $todayLipid = Food::getTodayLipid($foods);
        $todayCalorie = Food::getTodayCalorie($todayProtein, $todayCarbohydrate, $todayLipid);
        $day = Food::getDay($day);
        
        return view('admin.food.history', compact('profile', 'foods', 'day', 'todayProtein', 'todayCarbohydrate', 'todayLipid', 'todayCalorie'));
    }
    
    public function check(Request $request) {
        $user_id = Auth::id();
        $profile = Profile::where('id', $user_id)->first();
        $day = $request->input('eat_date');
        $foods = Food::where('user_id', $user_id)->where('eat_date', $day)->get();
        
        $todayProtein = Food::getTodayProtein($foods);
        $todayCarbohydrate = Food::getTodayCarbohydrate($foods);
        $todayLipid = Food::getTodayLipid($foods);
        $todayCalorie = Food::getTodayCalorie($todayProtein, $todayCarbohydrate, $todayLipid);
        $day = Food::getDay($day);
        
        return view('admin.food.history', compact('profile', 'foods', 'day', 'todayProtein', 'todayCarbohydrate', 'todayLipid', 'todayCalorie'));
    }
    
    public function today(Request $request) {
        $user_id = Auth::id();
        $profile = Profile::where('id', $user_id)->first();
        $day = \Carbon\Carbon::now()->format('Y-m-d');
        $food = Food::where('user_id', $user_id)->first();
        $foods = Food::where('user_id', $user_id)->where('eat_date', $day)->get();
        
        if (empty($profile)) {
            return redirect('admin/profile/create');
        }
        
        $todayProtein = Food::getTodayProtein($foods);
        $todayCarbohydrate = Food::getTodayCarbohydrate($foods);
        $todayLipid = Food::getTodayLipid($foods);
        $todayCalorie = Food::getTodayCalorie($todayProtein, $todayCarbohydrate, $todayLipid);
        
        return view('admin.food.today', compact('profile', 'foods', 'todayProtein', 'todayCarbohydrate', 'todayLipid', 'todayCalorie'));
    }
}
