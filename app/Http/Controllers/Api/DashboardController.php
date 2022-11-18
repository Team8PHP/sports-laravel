<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function userIndex(){
        return User::where('role','user')->get();
    }

    public function makeAdmin($id){
        $user = User::find($id);
        $user->role = 'admin';
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User is admin now'
        ], 200);
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }

    public function newsIndex(){
        return News::all();
    }

    public function deletenews($id){
        $user = News::find($id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'article deleted successfully'
        ], 200);
    }

}
