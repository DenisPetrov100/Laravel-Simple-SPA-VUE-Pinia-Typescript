<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['guard_name' => 'web', 'name' => 'admin']);
        $userRole  = Role::create(['guard_name' => 'web', 'name' => 'user']);

        $adminPayment = Payment::create(["description" => "Admin payment", "amount" => 10.55]);
        $userPayment = Payment::create(["description" => "User payment", "amount" => 20.31]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '+111111111',
            'password' => bcrypt('12345678'),
            ])->assignRole($adminRole);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'phone' => '+222222222',
            'password' => bcrypt('12345678'),
        ])->assignRole($userRole);

        $adminPayment->user()->associate($admin)->save();
        $userPayment->user()->associate($user)->save();

        $users = User::factory()->count(100)->create();

        foreach($users as $user){
            $user->syncRoles(['user']);
        }
    }
}
