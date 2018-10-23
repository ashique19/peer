<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user = null;

    public function __construct() {

    }

    public function getUser(Request $request)
    {
        if($request->is('api/*')) {
            $this->user = \App\User::where('api_token', $request->request->get('token'))->get()->first();
        } else {
            if(Auth::check()) {
                $this->user = Auth::user();
            }
        }
        if($this->user) {
            $request->request->add(['user_id' => $this->user->id]);
        }
        return $request;
    }

    public function jsonOutput($data = [], $status = 200)
    {
        $outputData = [
            'data' => $data,
            'status' => $status,
            'message' => ($data) ? 'Found' : 'not found'
        ];
        return JsonResponse::create($outputData, 200);
    }
}
