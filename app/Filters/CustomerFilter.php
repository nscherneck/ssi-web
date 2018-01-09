<?php

namespace App\Filters;

class CustomerFilter extends Filters
{
    protected $filters = ['name'];

    /**
     * @param  string $username for use in querying the User model
     * @return [type]
     */
    protected function name($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }
}
