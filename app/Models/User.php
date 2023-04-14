<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'openid', 'unionid', 'country', 'province', 'city', 'avatar', 'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = "id";

    public function records()
    {
        return $this->hasMany(Record::class, 'user_id','id');
    }

    public function freeRecord()
    {
        return $this->hasOne(FreeRecord::class, 'user_id','id');
    }

    public function updateUser($id, $nickName, $avatar){
        Log::info("修改用户信息:{$id}-{$nickName}-{$avatar}");
        return User::where('id', $id) -> update([
            'name' => $nickName,
            'avatar' => $avatar
        ]);
    }

    public function getUser($id){
        Log::info("查询用户信息:{$id}");
        $arr = User::where('id', $id) -> get();
        return $arr[0];
    }
}
