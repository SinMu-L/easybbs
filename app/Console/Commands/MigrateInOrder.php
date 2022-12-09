<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '按照指定顺序执行迁移文件和填充数据文件';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $s_execSeederAfter = [
            '2022_11_04_103933_seed_founder_to_user.php',
        ];
        // eg: https://stackoverflow.com/questions/32524101/laravel-change-migration-order
        // https://stackoverflow.com/questions/49499020/laravel-get-array-of-filenames-from-folder
        $miagrateFiles = File::allFiles(database_path('migrations'));
        foreach($miagrateFiles as $file){
            $fileInfo = pathinfo($file);

            if(!in_array($fileInfo['basename'],$s_execSeederAfter)){
                $path = 'database/migrations/' . $fileInfo['basename'];

                $this->call('migrate:refresh',[
                    '--path' => $path,
                ]);
            }
        }

        // 执行seeder
        $this->call('db:seed');

        // 执行 s_execSeederAfter 里面的文件
        foreach($s_execSeederAfter as $file){
            $path = 'database/migrations/' . $file;
            $this->call('migrate:refresh',[
                '--path' => $path,
            ]);
        }

    }
}
