<?php

namespace App\Support\Contracts;

interface PageInfoContract
{
    /**
     * Generate attributes to page.
     *
     * @param  string $method
     * @return mixed
     */
    public function make(array $array);
}
