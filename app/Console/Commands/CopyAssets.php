<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Throwable;

class CopyAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy-assets {from?} {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls the latest code from git repository and copies frontend assets from the specified source directory to the public assets folder. Useful for updating frontend assets after a git pull.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $from = $this->argument('from') ?? 'mi-trade';
        $to = $this->argument('to') ?? 'public/assets';

        $from = "{$from}/assets";

        $from = base_path($from);
        $to = base_path($to.'/frontend');

        $gitPullResult = Process::path($from)->run("git pull");
        if(trim($gitPullResult->output()) == 'Already up to date.') {
            $this->warn('Assets are already up to date.');
        }else{
            $this->info('Assets pulled successfully!');
        }

        if($gitPullResult->errorOutput() != ''){
            $this->error('Failed to pull assets: '.$gitPullResult->errorOutput());
        }

        try {
            File::copyDirectory($from, $to);
            $this->info('Assets copied successfully!');
        } catch (Throwable $th) {
            // throw $th;
            $this->error('Failed to copy assets: '.$th->getMessage());
        }
    }
}