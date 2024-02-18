<?php

namespace App\Http\Resources;

use App\Facades\Json\Json;
use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;
use Illuminate\Support\Str;

class JsonResource extends BaseJsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $items = Json::decode(Json::encode($this->resource));
        return $this->underscoreToHump($items);
    }

    /**
     * 下划线转驼峰
     * @param $data
     * @return array
     */
    public function underscoreToHump($data): array
    {
        $newParameters = [];
        if ($data) {
            foreach ($data as $key => $value) {
                if (!is_int($key)) {
                    if (is_array($value)) {
                        $newParameters[Str::camel($key)] = $this->underscoreToHump($value);
                    } else {
                        $newParameters[Str::camel($key)] = $value;
                    }
                } else if (is_array($value)) {
                    $newParameters[$key] = $this->underscoreToHump($value);
                } else {
                    $newParameters[$key] = $value;
                }
            }
        }
        return $newParameters;
    }
}
