<?php

namespace App;

use Carbon\Carbon;

class WorkOrderNumber
{

	public function createWorkOrderNumber($branchOfficeId, $todaysWorkOrderCount)
	{
	    return $this->generateDateSegment() . '-' . 
	    $this->generateBranchSegment($branchOfficeId) . '-' . 
	    $this->generateSequentialNumberSegment($todaysWorkOrderCount);
	}

	private function generateDateSegment()
	{
	    return Carbon::now('America/Los_Angeles')->format('ymd');
	}

	private function generateBranchSegment($branchOfficeId)
	{	    
	    return sprintf("%02d", $branchOfficeId);
	}

	private function generateSequentialNumberSegment($todaysWorkOrderCount)
	{
	    $incrementedWorkOrderCount = ++$todaysWorkOrderCount;
	    $countWithLeadingZeroes = sprintf("%03d", $incrementedWorkOrderCount);

	    return $countWithLeadingZeroes;
	}

}