<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddMediaToCollection implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Model $model;
    protected string $collectionName;
    protected string $filePath;
    protected string $fileName;

    /**
     * Create a new job instance.
     */
    public function __construct(Model $model, string $filePath, string $fileName, string $collectionName = 'default')
    {
        $this->model = $model;
        $this->collectionName = $collectionName;
        $this->fileName = $fileName;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->model
            ->addMedia($this->filePath)
            ->usingFileName($this->fileName)
            ->toMediaCollection($this->collectionName);
    }
}
