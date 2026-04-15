<?php

namespace JonMierke\PaperLink\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PaperLink extends Model
{
    use HasFactory, MassPrunable;

    public const UPDATED_AT = null;

    public const CREATED_AT = null;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function account()
    {
        return $this->morphTo();
    }
}
