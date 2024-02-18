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

        return $this->camelCaseKeysRecursive($items);
    }

    /**
     * 下划线转驼峰
     * @param $data
     * @return array
     */
    public function camelCaseKeysRecursive($data): array
    {
        return array_map(function($item) {
            if (is_array($item)) {
                $item = $this->camelCaseKeysRecursive($item);
            }
            return $item;
        }, collect($data)->mapWithKeys(function($value, $key) {
            return [Str::camel($key) => $value];
        })->toArray());
    }
}
