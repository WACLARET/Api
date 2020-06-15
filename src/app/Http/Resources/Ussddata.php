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
            'customeridnumber' => $this->customeridnumber,
            'customermobilenumber' => $this->customermobilenumber,
            'loanproduct' => $this->loanproduct,
            'loanamount' => $this->loanamount,
            'loanterm' => $this->loanterm,
            'customerfullnames' => $this->customerfullnames,
            'loanapplicationdate' => $this->loanapplicationdate
        ];
    }
}
