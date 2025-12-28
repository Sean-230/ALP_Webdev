<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\Vendor;
use App\Models\Performer;
use App\Models\EventVendor;
use App\Models\EventPerformer;
use App\Models\EventRegister;
use App\Models\Schedule;
use App\Models\Qna;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 3 specific role-based accounts
        $adminUser = User::firstOrCreate(
            ['email' => 'Admin@gmail.com'],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        $eventManagerUser = User::firstOrCreate(
            ['email' => 'Sean.tandjaja05@gmail.com'],
            [
                'name' => 'Event Manager',
                'role' => 'eventManager',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        $regularUser = User::firstOrCreate(
            ['email' => 'Sean.tandjaja2005@gmail.com'],
            [
                'name' => 'User',
                'role' => 'user',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        // Only these 3 users
        $users = collect([$adminUser, $eventManagerUser, $regularUser]);
        
        // Create categories
        $categories = Category::factory(10)->create();
        
        // Create vendors
        $vendors = Vendor::factory(15)->create();
        
        // Create performers
        $performers = Performer::factory(20)->create();
        
        // Create events with existing categories and assign to event manager
        $events = collect();
        foreach ($categories->random(8) as $category) {
            $events = $events->merge(
                Event::factory(rand(2, 5))->create([
                    'category_id' => $category->id,
                    'user_id' => $eventManagerUser->id
                ])
            );
        }
        
        // Attach vendors to events (many-to-many)
        foreach ($events as $event) {
            $event->vendors()->attach(
                $vendors->random(rand(2, 4))->pluck('id')
            );
        }
        
        // Attach performers to events (many-to-many)
        foreach ($events as $event) {
            $event->performers()->attach(
                $performers->random(rand(1, 3))->pluck('id')
            );
        }
        
        // Create schedules for events
        foreach ($events as $event) {
            Schedule::factory(rand(1, 3))->create([
                'event_id' => $event->id
            ]);
        }
        
        // Create event registrations
        foreach ($events->random(min(15, $events->count())) as $event) {
            EventRegister::factory(rand(3, 8))->create([
                'event_id' => $event->id,
                'user_id' => $users->random()->id,
            ]);
        }
        
        // Create Q&As
        foreach ($events->random(min(12, $events->count())) as $event) {
            Qna::factory(rand(2, 5))->create([
                'event_id' => $event->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
