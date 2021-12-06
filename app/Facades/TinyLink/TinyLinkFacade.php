<?php

namespace App\Facades\TinyLink;

use Illuminate\Support\Facades\Facade;

class TinyLinkFacade extends Facade {
   protected static function getFacadeAccessor() { return 'TinyLink'; }
}
