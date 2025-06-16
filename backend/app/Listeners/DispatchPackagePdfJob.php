<?php

namespace App\Listeners;

use App\Events\PackageCreated;
use App\Jobs\GeneratePackagePdfJob;

class DispatchPackagePdfJob
{
    public function handle(PackageCreated $event)
    {
        GeneratePackagePdfJob::dispatch($event->package);
    }
}
