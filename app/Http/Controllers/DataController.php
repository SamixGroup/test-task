<?php

namespace App\Http\Controllers;

use App\Models\DataModel;
use Illuminate\Auth\Access\Response;
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

    /**
     * @OA\Get(
     *  path="/data/all",
     *  operationId="indexData",
     *  tags={"Datas"},
     *  security={
     *      {"sanctum":{}},
     *  },
     *  summary="Get list of Data",
     *  description="Returns list of Data",
     *  @OA\Response(response=200, description="Successful operation"),
     *  ),
     * )
     *
     * Display a listing of Data.
     */
    public function index()
    {
        return view('items.list', ['items' => DataModel::all()]);
    }

    /**
     * @OA\Post(
     *  operationId="storeData",
     *  summary="Insert a new Data with POST",
     *  description="Insert a new Data",
     *  tags={"Datas"},
     *  security={
     *      {"sanctum":{}},
     *  },
     *  path="/api/data",
     *  @OA\RequestBody(
     *    description="Data to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/DataModel")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Data created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/DataModel"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     *
     *
     * @OA\Get(
     *  operationId="storeDataGet",
     *  summary="Insert a new Data with GET",
     *  description="Insert a new Data with GET",
     *  tags={"Datas"},
     *  security={
     *      {"sanctum":{}},
     *  },
     * @OA\Parameter (
     *      parameter="data",
     *      in="query",
     *      name="data",
     *      required=true,
     *      description="content of Data",
     *      @OA\Schema(
     *          type="object",
     *          ref="#/components/schemas/DataModel"
     *      )
     * ),
     *  path="/api/data",
     *
     *  @OA\Response(response="201",description="Data created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/DataModel"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     **/


    public function store(Request $request): DataModel
    {
        $data = new DataModel();
        $validated = $request->validate(['data' => 'required'])['data'];
        if (is_array($validated)) $data->data = $validated;
        else $data->data = json_decode($validated);
        $data->user_id = $request->user()->id;
        $data->save();
        return $data;
    }

    /**
     * @OA\Post(
     *  operationId="updateData",
     *  summary="update a Data with POST",
     *  description="update Data",
     *  tags={"Datas"},
     *  security={
     *      {"sanctum":{}},
     *  },
     *  path="/api/data/update",
     *  @OA\RequestBody(
     *    description="id and actions to apply to Data",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="actions",
     *      property="actions",
     *      type="string",
     *      example="$data->list->sublist[0] = 0;"),
     *      @OA\Property(
     *      title="id",
     *      property="id",
     *      type="integer",
     *      example="12")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Data created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/DataModel"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     **/
    public function updatePost()
    {
    }

    /**
     * @OA\Get(
     *  operationId="updateDataGet",
     *  summary="Update Data with GET",
     *  description="Update Data with GET",
     *  tags={"Datas"},
     *  security={
     *      {"sanctum":{}},
     *  },
     * @OA\Parameter (
     *      parameter="id",
     *      in="query",
     *      name="id",
     *      required=true,
     *      description="id of Data",
     *      @OA\Schema(
     *          type="integer",
     *      )
     * ),
     * @OA\Parameter (
     *      parameter="actions",
     *      in="query",
     *      name="actions",
     *      required=true,
     *      description="actions to apply to Data",
     *      @OA\Schema(
     *          type="string",
     *          example="$data->list->sublist[0] = 0;"
     *      )
     * ),
     *  path="/api/data/update",
     *
     *  @OA\Response(response="201",description="Data created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/DataModel"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     **/
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'actions' => 'string'
        ]);
        $model = DataModel::findOrFail($validated['id']);
        if (!$request->user()->can('update', $model)) return Response::deny("You're not allowed to modify this object");
        $data = $model->data;
        eval($validated['actions']);
        $model->data = $data;
        $model->save();
        return $model;

    }

    /**
     * @OA\Get(
     *  operationId="getData",
     *  summary="Display Data with specific ID",
     *  description="Display Data with specific ID",
     *  tags={"Datas"},
     *  security={
     *      {"sanctum":{}},
     *  },
     * @OA\Parameter (
     *      parameter="id",
     *      in="path",
     *      name="id",
     *      required=true,
     *      description="id of Data",
     *      @OA\Schema(
     *          type="integer",
     *      )
     * ),
     *  path="/data/{id}",
     *
     *  @OA\Response(response="201",description="Data created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/DataModel"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     **/
    public function show(Request $request, int $id)
    {
        $model = DataModel::findOrFail($id);
        return view('items.detail', ['items' => $model->data, 'id' => $id]);
    }

    /**
     * @OA\Delete(
     *  path="/api/data/{id}",
     *  summary="Delete a Data",
     *  description="Delete a Data",
     *  operationId="deleteData",
     *  tags={"Datas"},
     *  security={
     *      {"sanctum":{}},
     *  },
     * @OA\Parameter (
     *      parameter="id",
     *      in="path",
     *      name="id",
     *      required=true,
     *      description="id of Data",
     *      @OA\Schema(
     *          type="integer",
     *      )
     * ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/DataModel"
     *       ),
     *     ),
     *   ),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Data not found"),
     * )
     **/
    public function delete(Request $request, int $id)
    {
        $model = DataModel::find($id);
//        if (!$request->user()->can('delete', $model)) return Response::deny("You're not allowed to delete this object");
        $model->delete();
        return view('items.detail', ['items' => $model->data, 'id' => $id]);
    }
}
