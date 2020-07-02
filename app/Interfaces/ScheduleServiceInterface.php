<?php namespace App\Interfaces;

use Carbon\Carbon;

interface ScheduleServiceInterface
{
	public function isAvailableInterval($date, $doctoId, Carbon $start);
	public function getAvailableIntervals($date, $doctorId);
}