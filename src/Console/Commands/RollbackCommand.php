<?php

declare(strict_types=1);

namespace Cortex\Foundation\Console\Commands;

use Illuminate\Console\Command;

class RollbackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:rollback:foundation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback Cortex Foundation Tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->warn($this->description);

        $this->call('migrate:reset', ['--path' => 'app/cortex/foundation/database/migrations']);
    }
}
