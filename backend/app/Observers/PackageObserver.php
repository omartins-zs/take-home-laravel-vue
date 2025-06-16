<?php

namespace App\Observers;

use App\Models\Package;
use Illuminate\Support\Facades\Log;

class PackageObserver
{
    public function created(Package $package)
    {
        Log::info("Package created: {$package->name}");
    }

    public function updated(Package $package)
    {
        Log::info("Package updated: {$package->name}");
    }

    public function deleted(Package $package)
    {
        Log::warning("Package deleted: {$package->name}");
    }
}
