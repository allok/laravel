<?php

namespace App\Console\Commands;

use App\BuyerUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test exists property on model';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start Test-1');
        DB::beginTransaction();

        try {
            $buyer = new BuyerUser;
            $result = $buyer->save();

            DB::commit();

            var_dump([
                'exists' => $buyer->exists,
                'Save result' => $result,
                'Row in db' => BuyerUser::all()->count()
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->error('Exception for Test-1: ' . $e->getMessage());
        }

        $this->info('Test-1 finished');

        $this->info('Start Test-2');
        DB::beginTransaction();

        try {
            $buyer = BuyerUser::create();

            DB::commit();

            var_dump([
                'exists' => $buyer->exists,
                'Row in db' => BuyerUser::all()->count()
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->error('Exception for Test-2: ' . $e->getMessage());
        }

        $this->info('Test-2 finished');
    }
}
