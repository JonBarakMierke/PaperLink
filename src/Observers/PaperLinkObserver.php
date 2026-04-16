<?php

namespace JonMierke\PaperLink\Observers;

use JonMierke\PaperLink\Models\PaperLink;
use Illuminate\Support\Facades\Cache;

class PaperLinkObserver
{
    /**
     * Handle the PaperLink "created" event.
     */
    public function created(PaperLink $paperLink): void
    {
        //
    }

    /**
     * Handle the PaperLink "updated" event.
     */
    public function updated(PaperLink $paperLink): void
    {
        Cache::forget("paperlink:{$paperLink->slug}");
    }

    /**
     * Handle the PaperLink "deleted" event.
     */
    public function deleted(PaperLink $paperLink): void
    {
        Cache::forget("paperlink:{$paperLink->slug}");
    }

    /**
     * Handle the PaperLink "restored" event.
     */
    public function restored(PaperLink $paperLink): void
    {
        //
    }

    /**
     * Handle the PaperLink "force deleted" event.
     */
    public function forceDeleted(PaperLink $paperLink): void
    {
        //
    }
}
