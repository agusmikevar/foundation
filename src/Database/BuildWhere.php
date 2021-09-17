<?php

namespace Gus\Foundation\Database;

trait BuildWhere
{
    /**
     * @return \Gus\Foundation\Database\WhereBuilder
     */
    public function buildWhere()
    {
        return new WhereBuilder();
    }
}
