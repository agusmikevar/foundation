<?php

namespace Gus\Foundation;

trait TransmitTask
{
    /**
     * @param  \Gus\Foundation\Task  $task
     * @param  \Illuminate\Http\Request  $request
     * @param  ...$args
     * @return void
     */
    public function transmit(Task $task, $request, ...$args)
    {
        return $task->handle($request, ...$args);
    }
}
