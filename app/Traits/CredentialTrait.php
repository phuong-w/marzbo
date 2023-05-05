<?php

namespace App\Traits;

trait CredentialTrait
{
    /**
     * Set the "credentials" attribute to JSON encoded value.
     *
     * @param $value
     * @return void
     */
    public function setCredentialsAttribute($value)
    {
        $this->attributes['credentials'] = json_encode($value);
    }

    /**
     * Get the "credentials" attribute as a decoded JSON value.
     *
     * @param $value
     * @return mixed
     */
    public function getCredentialsAttribute($value)
    {
        return json_decode($value);
    }
}
