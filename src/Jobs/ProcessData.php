<?php

declare(strict_types=1);

namespace JonMierke\PaperLink\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use JonMierke\PaperLink\DTO\RequestDataDTO;
use JonMierke\PaperLink\Services\PaperLinkService;
use Illuminate\Support\Facades\Log;

class ProcessData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public RequestDataDTO $requestDataDTO)
    {
        $this->onQueue((string) config('request-analytics.queue.on_queue'));
    }

    public function handle(RequestAnalyticsService $requestAnalyticsService): void
    {
        Log::debug('PaperLink⚡ - ProcessData JOB RAN', [
            'payload' => $this->requestDataDTO,
            'Filepath' => __FILE__,
        ]);
        
        $requestAnalyticsService->store($this->requestDataDTO);
    }
}
