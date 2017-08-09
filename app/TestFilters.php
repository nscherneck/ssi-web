<?php
namespace App;

class TestFilters extends QueryFilter
{
    public function date_range($dates)
    {
        return $this->builder->whereBetween('test_date', [$dates[0], $dates[1]]);
    }

    public function technician($technician_id)
    {
        return $this->builder->where('technician_id', $technician_id);
    }

    public function test_type($test_type_id)
    {
        return $this->builder->where('test_type_id', $test_type_id);
    }

    public function test_result($test_result_id)
    {
        return $this->builder->where('test_result_id', $test_result_id);
    }

    public function added_by($added_by)
    {
        return $this->builder->where('added_by', $added_by);
    }
}
