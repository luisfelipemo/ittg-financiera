<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(ClientesSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(LoanSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
