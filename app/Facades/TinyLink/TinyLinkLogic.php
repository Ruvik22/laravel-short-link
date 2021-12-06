<?php

namespace App\Facades\TinyLink;

use App\Models\TinyLink;
use Illuminate\Support\Str;

class TinyLinkLogic {
    /**
     * Tiny link creator method
     *
     * @return String
     */
    public function creator()
    {
        // Create character counter variable
        $charCounter = 2;

        while($charCounter < 10)
        {
            // Create slug
            $slug = Str::random($charCounter);

            // Check slug unique or not
            $haveThisTinyLinkBefore = TinyLink::where('slug', $slug)->first();

            // If unique return it
            if(empty($haveThisTinyLinkBefore))
                return $slug;

            // If not create slug with more character
            $charCounter++;
        }

        return false;
    }

    public function isExpire(TinyLink $tinyLink, $expiration)
    {
        // Is it expire?
        if($tinyLink->expire_counter > $expiration)
            return true;

        // Increment expiration
        $tinyLink->incrementExpirationCounter();

        return false;
    }
}
