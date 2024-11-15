<?php

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function commands(): void 
    {
        $this->load(__DIR__.'/Commands');
        
        require base_path('routes/console.php');
    }
}