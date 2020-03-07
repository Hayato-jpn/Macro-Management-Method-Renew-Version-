<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'eat_date' => 'required',
        'food' => 'required',
        'eat_time' => 'required| filled',
        'protein' => 'required',
        'carbohydrate' => 'required',
        'lipid' => 'required',
    );
    
    //今日のプロテイン数値
    public static function getTodayProtein($foods) {
        $todayProtein = 0;
        foreach ($foods as $food) {
            $todayProtein += $food->protein;
        }
        return $todayProtein;
    }
    
    //今日の炭水化物数値
    public static function getTodayCarbohydrate($foods) {
        $todayCarbohydrate = 0;
        foreach ($foods as $food) {
            $todayCarbohydrate += $food->carbohydrate;
        }
        return $todayCarbohydrate;
    }
    
    //今日の脂質数値
    public static function getTodayLipid($foods) {
        $todayLipid = 0;
        foreach ($foods as $food) {
            $todayLipid += $food->lipid;
        }
        return $todayLipid;
    }
    
    //今日のトータルカロリー数値
    public static function getTodayCalorie($todayProtein, $todayCarbohydrate, $todayLipid) {
        $output = floor($todayProtein * 4 + $todayCarbohydrate * 4 + $todayLipid * 9);
        return $output;
    }
    
    //該当日付
    public static function getDay($day) {
        return $day;
    }
}
