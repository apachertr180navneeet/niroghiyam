<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;
  
class NotificationResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array

     */
    public function toArray(Request $request): array
    {
        return [
            'user_id  ' => $this->user_id,
            'message' => $this->message,
            'created_at' => Carbon::parse($this->created_at)->format('m/d/Y'),
        ];
    }
}