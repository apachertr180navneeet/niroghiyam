<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
  
class CompliancesResource extends JsonResource
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
            'titel' => $this->titel,
            'description' => $this->description,
            'file' => $this->file,
            'userid' => $this->userid
        ];
    }
}