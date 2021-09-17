<?php

namespace Gus\Foundation\Database;

use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $dataSources = [];

    /**
     * @return void
     */
    public function __construct()
    {
        foreach ($this->dataSources as $index => $dataSource) {
            $this->data[$index] = json_decode(
                file_get_contents(resource_path('seeders/' . $dataSource)),
                true,
            );
        }
    }
}
