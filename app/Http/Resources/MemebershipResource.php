<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
  
class MemebershipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array

     */
    public function toArray(Request $request): array
    {
        return [
            'membership_id' => $this->membership_id,
            'membership_name' => $this->membership_name,
            'description' => $this->description,
            'membership_mode_name' => $this->membership_mode_name,
            'amount' => $this->amount,
        ];
    }
}