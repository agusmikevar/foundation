<?php

namespace Gus\Foundation\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Gus\Foundation\Database\{
    BuildWhere,
    BuildExtent,
    Transaction,
};
use Gus\Foundation\{
    ManageService,
    TransmitTask,
    RevealWidget,
};

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use BuildWhere, BuildExtent, ManageService, TransmitTask, RevealWidget,
        Transaction;
}
