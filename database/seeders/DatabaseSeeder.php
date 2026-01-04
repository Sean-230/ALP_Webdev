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
        // Create 4 specific role-based accounts
        $adminUser = User::firstOrCreate(
            ['email' => 'Admin@gmail.com'],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        $regularUser = User::firstOrCreate(
            ['email' => 'sean.tandjaja2005@gmail.com'],
            [
                'name' => 'Sean User',
                'role' => 'user',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        $eventManagerUser = User::firstOrCreate(
            ['email' => 'sean.tandjaja05@gmail.com'],
            [
                'name' => 'Sean Event Manager',
                'role' => 'eventManager',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        $vendorManagerUser = User::firstOrCreate(
            ['email' => 'sean.tandjaja@gmail.com'],
            [
                'name' => 'Sean Vendor Manager',
                'role' => 'vendorManager',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        // Only these 4 users
        $users = collect([$adminUser, $regularUser, $eventManagerUser, $vendorManagerUser]);
        
        // Create some additional users with pending applications
        $pendingUser1 = User::create([
            'name' => 'John Pending',
            'email' => 'john.pending@example.com',
            'password' => '12345678',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $pendingUser2 = User::create([
            'name' => 'Sarah Applicant',
            'email' => 'sarah.applicant@example.com',
            'password' => '12345678',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $pendingUser3 = User::create([
            'name' => 'Mike Manager',
            'email' => 'mike.manager@example.com',
            'password' => '12345678',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create pending manager applications
        \App\Models\ManagerApplication::create([
            'user_id' => $pendingUser1->id,
            'role_type' => 'eventManager',
            'status' => 'pending',
            'created_at' => now()->subDays(3),
        ]);

        \App\Models\ManagerApplication::create([
            'user_id' => $pendingUser2->id,
            'role_type' => 'vendorManager',
            'status' => 'pending',
            'created_at' => now()->subDays(2),
        ]);

        \App\Models\ManagerApplication::create([
            'user_id' => $pendingUser3->id,
            'role_type' => 'eventManager',
            'status' => 'pending',
            'created_at' => now()->subDays(1),
        ]);
        
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
