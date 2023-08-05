<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
  
class VaccinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array

     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'vaccination_date' => $this->vaccination_date,
            'name' => $this->name,
            'vaccination_next_schedule' => $this->vaccination_next_schedule,
            'place' => $this->place,
            'remark' => $this->remark
        ];
    }
}