<?php

namespace JonMierke\PaperLink\Concenr;

trait HasCampaigns
{
    public function campaigns()
    {
        return $this->morphMany(
            \PaperLink\PaperLink\Models\Campaign::class,
            'owner'
        );
    }
}