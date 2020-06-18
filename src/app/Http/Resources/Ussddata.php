<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ussddata extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'session_id' => $this->session_id,
            'msisdn' => $this->msisdn,
            'Amount' => $this->Amount,
            'id_number' => $this->id_number,
            'confirm' => $this->confirm,
            
        ];
    }
}
