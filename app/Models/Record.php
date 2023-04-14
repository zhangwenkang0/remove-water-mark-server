<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Record extends Model
{
    protected $fillable = [
        'id', 'url', 'host', 'no_water_mark_url', 'user_id'
    ];

    protected $primaryKey = "id";

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function add($id,$url,$host,$no_water_mark_url){
        Log::info("添加解析记录:{$id},{$url},{$host},{$no_water_mark_url}");
        Record::insert([
            'url' => $url, 'host' => $host,'no_water_mark_url' => $no_water_mark_url, 'user_id' => $id, 'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

}
