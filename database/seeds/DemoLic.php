<?php

use Illuminate\Database\Seeder;
use App\Licencias;
class DemoLic extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Licencias::create([
        	'code' => 'c95212f10ee3c332ad7db40ad542e6691c6ff7b6',
    		'status' => 'A',
    		'expire' => date('Y-m-d', strtotime("+30 days"))
    	]);
    }
}
