<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
  
class UploadReportResource extends JsonResource
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
            'date' => $this->date,
            'file' => $this->file,
            'category_id' => $this->category_id,
            'userid' => $this->userid
        ];
    }
}