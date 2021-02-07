<?php

namespace Thtg88\LaravelBaseClasses\Http\Controllers\Api;

use Thtg88\LaravelBaseClasses\Http\Controllers\Controller;

class PingController extends Controller
{
    /**
     * Ping connection to application.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // If we got to here it means application is healthy

        return response()->json(['success' => true]);
    }
}
