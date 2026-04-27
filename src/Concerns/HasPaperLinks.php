<?php

namespace JonMierke\PaperLink\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use JonMierke\PaperLink\Models\PaperLink;

trait HasPaperLinks
{
    public function links(): MorphToMany
    {
        return $this->morphToMany(
            PaperLink::class,
            'linkable',
            'linkables'
        )->withTimestamps();
    }
}
