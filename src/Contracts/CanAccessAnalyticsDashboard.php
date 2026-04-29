<?php

declare(strict_types=1);

namespace JonMierke\PaperLink\Contracts;

interface CanAccessAnalyticsDashboard
{
    public function canAccessAnalyticsDashboard(): bool;
}
