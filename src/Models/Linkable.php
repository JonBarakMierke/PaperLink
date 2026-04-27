<?php

namespace JonMierke\PaperLink\Models;

use Illuminate\Database\Eloquent\Model;

class Linkable extends Model
{
    protected $table = 'linkables';

    protected $guarded = [];

    public function paperLink()
    {
        return $this->belongsTo(PaperLink::class);
    }

    public function linkable()
    {
        return $this->morphTo();
    }
}