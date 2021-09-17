<?php

namespace Gus\Foundation;

trait ManageService
{
    /**
     * @param  \Gus\Foundation\Service  $service
     * @param  \Illuminate\Http\Request  $request
     * @param  ...$args
     * @return void
     */
    public function manage(Service $service, $request, ...$args)
    {
        return $service->serve($request, ...$args);
    }
}
