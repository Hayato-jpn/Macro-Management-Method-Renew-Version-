<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'sex' => 'required | filled',
        'height' => 'required',
        'weight' => 'required',
        'age' => 'required',
        'active' => 'required | filled',
        'purpose' => 'required | filled',
    );
    
    //基礎代謝率
    public function getBmrAttribute() {
        $sexValue = ($this->sex == 'man') ? 5 : -161;
        $output = floor(10 * $this->weight + 6.25 * $this->height - 5 * $this->age + $sexValue);
        return $output;
    }
    
    //アクティブ度
    public function getActiveValueAttribute() {
        switch ($this->active) {
        case 'low':
            return 1.2;
        case 'normal':
            return 1.55;    
        default:
            return 1.725;
        }
    }
    
    //目的
    public function getPurposeValueAttribute() {
        switch ($this->purpose) {
        case 'diet':
            return 0.8;
        case 'keep':
            return 1;
        case 'increase':
            return 1.2;
        }
    }
    
    //目標カロリー計算
    public function getTotalCalorieAttribute() {
        return floor($this->bmr * $this->active_value * $this->purpose_value);
    }
    
    //目標プロテイン
    public function getProteinAttribute() {
        return $this->weight * 2;
    }
    
    //目標脂質
    public function getLipidAttribute() {
        return floor($this->total_calorie * 0.25 / 9);
    }
    
    //目標炭水化物
    public function getCarbohydrateAttribute() {
        return floor(($this->total_calorie - $this->protein * 4 - $this->lipid * 9) / 4);
    }
    
    //性別
    public function getPersonalSexAttribute() {
        $output = ($this->sex == 'man') ? '男' : '女';
        return $output;
    }
    
    //アクティブ度
    public function getPersonalActiveAttribute() {
        if ($this->active == 'low') {
            $output = '【低】座り仕事が多く、一日の運動は歩いたり階段を上ったりする程度';
        } elseif ($this->active == 'normal') {
            $output = '【普通】立ち仕事や重労働が多く、比較的一日中動き回っている';
        } else {
            $output = '【高】立ち仕事や重労働が多く、それに加えジムでトレーニングを行っている';
        }
        return $output;
    }
    
    //目的
    public function getPersonalPurposeAttribute() {
        if ($this->purpose == 'diet') {
            $output = '減量(ダイエット)';
        } elseif ($this->purpose == 'keep') {
            $output = '現状維持';
        } else {
            $output = '増量';
        }
        return $output;
    }
}
