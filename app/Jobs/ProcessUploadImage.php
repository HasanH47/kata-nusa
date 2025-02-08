<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ProcessUploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $temporaryPath;
    protected $path;
    protected $filename;
    protected $oldImage;

    /**
     * Create a new job instance.
     */
    public function __construct($temporaryPath, $path, $filename, $oldImage)
    {
        $this->temporaryPath = $temporaryPath;
        $this->path = $path;
        $this->filename = $filename;
        $this->oldImage = $oldImage;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $filePath = Storage::path($this->temporaryPath);

        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($filePath);

        Storage::disk('public')->putFileAs($this->path, $filePath, $this->filename, 'public');

        Storage::delete($this->temporaryPath);

        if ($this->oldImage !== null) {
            Storage::disk('public')->delete($this->path . '/' . $this->oldImage);
        }
    }
}
