<?php

namespace Domains\Customer\ValueObjects;

class CartValueObject {

    public function __construct($status, $userID) {
        $this->status = $status;
        $this->userID = $userID;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'status' => $this->status,
            'userID' => $this->userID
        ];
    }
}