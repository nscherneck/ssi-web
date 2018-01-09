<?php

namespace App\Filters;

use App\Site;
use App\Customer;
use Illuminate\Support\Facades\DB;

class SystemFilter extends Filters
{
    protected $filters = [
        'name',
        'type',
        'customer',
        'components',
        'panel',
        'active',
        'ssi_test_account',
        'ssi_install',
        'test_range',
        'next_test',
        'branch_office',
        'order'
    ];

    /**
     * @param  string Description
     * @return [type]
     */
    protected function name($name)
    {
        return $this->builder->where('name', 'like', $name . '%');
    }

    /**
     * @param  string Description
     * @return [type]
     */
    protected function type($type)
    {
        if (is_array($type)) {
            return $this->builder->whereIn('system_type_id', $type);
        }
        return $this->builder->where('system_type_id', $type);
    }

    /**
     * @param  string Description
     * @return [type]
     */
    protected function customer($customer)
    {
        if (is_array($customer)) {
            return $this->builder->whereHas('site', function ($query) use ($customer) {
                $query->whereIn('customer_id', $customer);
            });
        }
        return $this->builder->whereHas('site', function ($query) use ($customer) {
            $query->where('customer_id', $customer);
        });
    }

    /**
     * @param  string Description
     * @return [type]
     */
    protected function components($components)
    {
        natsort($components);
        $components = array_values($components);
        if (sizeof($components) > 1) {
            return $this->builder->select('systems.*', DB::raw('SUM(components_systems.quantity) as component_quantity'))
                ->join('components_systems', 'systems.id', '=', 'components_systems.system_id')
                ->groupBy('components_systems.system_id')
                ->havingRaw('SUM(components_systems.quantity) BETWEEN ' . $components[0] . ' AND ' . $components[1])
                ->get();
        }
    }

    /**
     * @param  string Description
     * @return [type]
     */
    protected function panel($panel)
    {
        if (is_array($panel)) {
            return $this->builder->whereHas('components', function ($query) use ($panel) {
                $query->whereIn('component_id', $panel);
            });
        }
        return $this->builder->whereHas('components', function ($query) use ($panel) {
            $query->where('component_id', $panel);
        });
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function active($active)
    {
        if ($active[0] == 3) {
            return $this->builder->whereNotIn('is_active', [0, 1]);
        }
        return $this->builder->whereIn('is_active', $active);
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function ssi_test_account($ssi_test_account)
    {
        if ($ssi_test_account[0] == 3) {
            return $this->builder->whereNotIn('ssi_test_acct', [0, 1]);
        }
        return $this->builder->whereIn('ssi_test_acct', $ssi_test_account);
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function ssi_install($ssi_install)
    {
        if ($ssi_install[0] == 3) {
            return $this->builder->whereNotIn('ssi_install', [0, 1]);
        }
        return $this->builder->whereIn('ssi_install', $ssi_install);
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function test_range($test_range)
    {
        natsort($test_range);
        $test_range = array_values($test_range);
        if (sizeof($test_range) > 1) {
            return $this->builder->whereHas('tests', function ($query) use ($test_range) {
                $query->whereBetween('test_date', $test_range);
            });
        }
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function next_test($next_test)
    {
        natsort($next_test);
        $next_test = array_values($next_test);
        if (sizeof($next_test) > 1) {
            return $this->builder->whereBetween('next_test_date', $next_test);
        }
    }
    
    /**
     * @param  string Description
     * @return [type]
     */
    protected function branch_office($branch_office)
    {
        // if ($branch_office[0] == 0) {
        //     return $this->builder->whereHas('site', function ($query) use ($branch_office) {
        //         $query->whereNotIn('branch_office_id', $branch_office);
        //     });
        // }
        return $this->builder->whereHas('site', function ($query) use ($branch_office) {
            $query->whereIn('branch_office_id', $branch_office);
        });
    }
}
