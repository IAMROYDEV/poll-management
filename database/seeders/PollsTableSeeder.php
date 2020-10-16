<?php

namespace Database\Seeders;

use App\Models\Poll;
use Illuminate\Database\Seeder;

class PollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

             Poll::updateOrCreate([
                'name'                           => 'KBC',
                'description'                    => 'Kaun Banega Corepathi',
                'activated'                     => true
            ]);

            Poll::updateOrCreate([
                'name'                           => 'PHP TEST',
                'description'                    => 'Php test',
                'activated'                     => false
            ]);
    }


}
