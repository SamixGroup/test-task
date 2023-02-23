<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   description="Data model",
 *   title="DataModel",
 *   required={},
 *   @OA\Property(type="integer",description="id of Data",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="data of Data",title="data",property="data",example="Some json"),
 *   @OA\Property(type="string",description="memory usage (optional)",title="memory_usage",property="memory_usage",readOnly=true, example="123123"),
 *   @OA\Property(type="string",description="response time",title="response_time",property="response_time",readOnly=true,example="0.12313"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 *
 **/
class DataModel extends Model
{
    /**
     * @var array $data
     */
    protected $casts = [
        'data' => 'object'
    ];
}
