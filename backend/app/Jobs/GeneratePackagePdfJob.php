<?php

namespace App\Jobs;

use App\Models\Package;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratePackagePdfJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Package $package) {}


    /**
     * Execute the job.
     */
    public function handle()
    {
        $pdf = Pdf::loadView('pdf.package', ['package' => $this->package]);
        Storage::disk('pdfs')->put("packages/{$this->package->id}.pdf", $pdf->output());
    }
}
