<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function posts() {
        // hasManyThrough 方法讓我們可以使用$country->posts 取得 country 的 posts
        return $this->hasManyThrough('App\Post', 'App\User');

        // 手動指定關聯的欄位名稱 (By default)
        //return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
    }
}
