<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeactivateUsers extends Command
{

    protected $signature = 'deactivate:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate users if date is less than specified';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $date = date('Y-m-d'); // текущая дата
        $thresholdDate = '2023-03-22'; // нужная дата
        $isActive = $date < $thresholdDate ? 0 : 1;
        DB::table('users')->where('date', '<', $date)->update(['active' => $isActive]);

    }
}
