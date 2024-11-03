<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
  
class EmergancyContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array

     */
    public function toArray(Request $request): array
    {
        return [
            'emergancy_contact_id ' => $this->emergancy_contact_id ,
            'userid' => $this->userid,
            'emergancy_contact_name' => $this->emergancy_contact_name,
            'emergancy_contact_image' => $this->emergancy_contact_image,
            'emergancy_contact_mobile' => $this->emergancy_contact_mobile
        ];
    }
}