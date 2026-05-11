<?php

namespace App\Traits;

trait LogsActivity
{
    public function logActivity($activity, $description, array $properties = [],$caused_by = null, $performedOn = null)
    {
        return activity($activity)
            ->performedOn($performedOn ?? $this)
            ->causedBy($caused_by ?? $this)
            ->withProperties($properties)
            ->log($description);
    }
}
