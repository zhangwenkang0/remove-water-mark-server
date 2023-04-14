<?php

namespace App\Http\Controllers;

use App\Models\FreeRecord;
use Illuminate\Http\Request;

class FreeRecordController extends Controller
{

    public function getFreeNum(Request $request)
    {
        $user = $request->user();
        $freeNum = (new FreeRecord) -> getUserFreeNum($user['id']);
        return response()->json($freeNum);

    }

    public function decreaseFreeNum(Request $request)
    {
        $user = $request->user();
        $freeNum = (new FreeRecord) -> decreaseFreeNum($user['id']);
        return response()->json($freeNum);
    }

    public function increaseFreeNum(Request $request)
    {
        $user = $request->user();
        $freeNum = (new FreeRecord) -> increaseFreeNum($user['id']);
        return response()->json($freeNum);
    }

}
