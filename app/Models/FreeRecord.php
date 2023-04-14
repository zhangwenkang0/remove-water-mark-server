<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


class FreeRecord extends Model
{
    protected $fillable = [
        'id', 'time', 'user_id','date','updated_at'
    ];

    protected $table = "free_records";

    protected $primaryKey = "id";

    public function getUserFreeNum($id)
    {
        $freeRecord = FreeRecord::query()->where('date', date("Y-m-d"))->where("user_id", $id)->limit(1)->get();
        Log::debug($freeRecord);

        if (count($freeRecord) == 0) {
            Log::debug("没有免费记录，新增记录");
            FreeRecord::insert([
                'times' => 10, 'user_id' => $id, 'date' => date("Y-m-d")
            ]);
            return 10;
        } else {
            Log::debug("已有免费记录");
            Log::debug(json_encode($freeRecord));
            return json_decode($freeRecord)[0]->times;
        }
    }

    public function decreaseFreeNum($id){
        $this->getUserFreeNum($id);
        FreeRecord::where('date', date("Y-m-d"))->where("user_id", $id) ->decrement('times');
        $freeRecord = FreeRecord::query()->where('date', date("Y-m-d"))->where("user_id", $id)->limit(1)->get();
        Log::debug("减次数user_id:{$id}|{$freeRecord}");
        return json_decode($freeRecord)[0]->times;
    }

    public function increaseFreeNum($id){
        FreeRecord::where('date', date("Y-m-d"))->where("user_id", $id) ->increment('times');
        $freeRecord = FreeRecord::query()->where('date', date("Y-m-d"))->where("user_id", $id)->limit(1)->get();
        Log::debug("加次数user_id:{$id}|{$freeRecord}");
        return json_decode($freeRecord)[0]->times;
    }
}
