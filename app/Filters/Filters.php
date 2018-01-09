<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request;
    protected $builder;
    protected $filters = [];

    /**
     * Filters constructor
     * @param Request $request
     * @return type
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Description
     * @param type $builder
     * @return type
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }
    
    /**
     * Removes any filters that are not found in $this->filters array.
     * @return Array Filters in the request that are also found in $this->filters array
     */
    public function getFilters()
    {
        return $this->request->intersect($this->filters);
    }
}
