<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getRescuers(Request $request)
    {
        $query = User::where('type', 'rescuer');
        if ($request->has('skiareaId')) {
            $query->where('skiarea_id', $request->skiareaId);
        }
        return response()->json($query->get());
    }
}
