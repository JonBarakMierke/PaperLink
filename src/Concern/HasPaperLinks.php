<?php

namespace JonMierke\PaperLink\Concern;

trait HasPaperLinks
{
    public function paperLinks()
    {
        return $this->morphMany(
            \PaperLink\PaperLink\Models\PaperLink::class,
            'owner'
        );
    }
}