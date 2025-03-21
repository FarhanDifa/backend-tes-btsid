<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('checklist')->insert([
            [
                'title' => 'Plan weekly schedule',
                'description' => 'Organize tasks and set priorities for the week',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Write daily journal',
                'description' => 'Reflect on today’s accomplishments and challenges',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Review project progress',
                'description' => 'Check pending tasks and update the status',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Prepare for team meeting',
                'description' => 'Gather notes and agenda for discussion',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Update task board',
                'description' => 'Move completed tasks and add new priorities',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Backup important files',
                'description' => 'Save project documents to cloud storage',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Review learning materials',
                'description' => 'Go through study notes and online courses',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Plan weekend activities',
                'description' => 'Decide on relaxation or recreational plans',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Clean workspace',
                'description' => 'Organize desk and declutter unnecessary items',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Exercise routine',
                'description' => 'Follow a scheduled workout session',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
