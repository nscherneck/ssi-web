<?php

namespace App\Filters;

class SiteFilter extends Filters
{
    protected $filters = ['name', 'branch', 'state', 'zip'];

    /**
     * @param  string Description
     * @return [type]
     */
    protected function name($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function branch($branch)
    {
        return $this->builder->where('branch_office_id', $branch);
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function state($state)
    {
        return $this->builder->where('state_id', $state);
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function zip($zip)
    {
        return $this->builder->where('zip', $zip);
    }
}
