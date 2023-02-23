<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Info"},
     *     operationId="documentation",
     *     path="/api/documentation",
     *  summary="Get a documentation",
     *     @OA\Response(response="200", description="Docs page")
     * )
     */
    public function index()
    {

    }
}
