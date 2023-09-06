<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
  
class BannerResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array

     */
    public function toArray(Request $request): array
    {
        return [
            'banner_id  ' => $this->banner_id,
            'banner_titel' => $this->banner_titel,
            'banner_image' => $this->banner_image
        ];
    }
}