<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'first_name'        => 'Главный',
            'last_name'         => 'Администратор',
            'email'             => 'admin@kmg.kz',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        User::create([
            'first_name'        => 'Служба',
            'last_name'         => 'Безопаности',
            'email'             => 'service_of_security@kmg.kz',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        User::create([
            'first_name'        => 'Охрана',
            'last_name'         => 'Проходной',
            'email'             => 'security@kmg.kz',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        User::create([
            'first_name'        => 'Бюро',
            'last_name'         => 'Пропусков',
            'email'             => 'pass_bureau@kmg.kz',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        User::create([
            'first_name'        => 'Вася',
            'last_name'         => 'Пупкин',
            'email'             => 'vasya@gmail.com',
            'password'          => '123456',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        $this->enableForeignKeys();
    }
}
