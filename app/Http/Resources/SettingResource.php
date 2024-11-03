<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
  
class SettingResource extends JsonResource
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
            'title' => $this->title,
            'vedio' => $this->vedio,
            'andriod_app_link' => $this->andriod_app_link,
            'ios_app_link' => $this->ios_app_link,
            'app_logo' => $this->app_logo,
            'andriod_qr' => $this->andqr,
            'iosqrcode' => $this->iosqrcode,
            'vaccinationchart' => $this->vaccinationchart,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'linkedin' => $this->linkedin,
            'razor_pay_key' => $this->razor_pay_key,
        ];
    }
}