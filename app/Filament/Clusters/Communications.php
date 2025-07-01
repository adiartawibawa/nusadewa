<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Communications extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationLabel = 'Inbox';

    protected static ?string $navigationGroup = 'Communications';
}
