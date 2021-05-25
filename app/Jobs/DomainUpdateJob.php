<?php

namespace App\Jobs;

use App\Models\Domain;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DomainUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    private $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $id)
    {
        Log::debug($id);
        Log::debug($request);
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $domain = Domain::findOrFail($this->id);
        $domain->update($this->request);
    }
}
