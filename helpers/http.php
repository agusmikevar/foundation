<?php

use Waffleboss\Foundation\Http\Authentication;

/**
 * @param  string  $type
 * @param  array  $refs
 * @return bool
 */
function gf_auth($type, $refs)
{
    return Authentication::authenticate($type, $refs);
}
