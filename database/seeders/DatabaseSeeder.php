<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\AcademicCoordination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        AcademicCoordination::factory()->create([
            'name' => 'Escola Pública de Audiovisual',
            'code' => 'EPAV',
            'coordinator' => 'Cris Francelino',
            'phone' => '85988879658',
            'email' => 'epav@viladasartesfortaleza.com',
        ]);

        Student::factory(30)->create();
    }
}
