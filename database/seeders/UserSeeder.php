<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nome' => 'Diogo Ferreira',
                'email' => 'diferreira@enovo.pt',
                'password' => Hash::make('1234'),
                'imagem' => 'https://i.ibb.co/d4LpRYTM/Captura-de-ecra-2025-05-28-a-s-09-55-55.png',
                'primeiro_login' => true,
            ],
            [
                'nome' => 'Margarida Cardoso',
                'email' => 'macardoso@enovo.pt',
                'password' => Hash::make('1234'),
                'imagem' => 'https://i.ibb.co/1Yc2kxNc/Captura-de-ecra-2025-05-28-a-s-09-53-53.png',
                'primeiro_login' => true,
            ],
            [
                'nome' => 'Joel Barros',
                'email' => 'jobarros@enovo.pt',
                'password' => Hash::make('1234'),
                'imagem' => 'https://i.ibb.co/fdYddCgx/Captura-de-ecra-2025-05-28-a-s-09-55-32.png',
                'primeiro_login' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
