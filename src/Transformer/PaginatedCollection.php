<?php

namespace Gus\Foundation\Transformer;

use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class PaginatedCollection extends ResourceCollection
{
    /**
     * Constructor.
     */
    public function __construct(...$args)
    {
        $this->collects = $this->collects();
        parent::__construct(...$args);
    }

    /**
     * @return string
     */
    protected function collects()
    {
        return '';
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'meta' => [
                'last_page' => $this->lastPage(),
                'first_item' => $this->firstItem(),
                'last_item' => $this->lastItem(),
                'total' => $this->total(),
            ]
        ];
    }
}
