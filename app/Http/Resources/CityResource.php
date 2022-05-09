<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'city';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'pk' => $this->id,
            'arabic_name' => $this->name_ar,
            $this->mergeWhen(auth('user-api')->user()->hasPermissionTo('Read-Users'), [
                'english_name' => $this->name_en,
                'users_counter' => 5,
            ]),
        ];
    }
}
