<?php

namespace Database\Seeders;

use App\Models\Tier;
use Illuminate\Database\Seeder;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = [
            [
                'title' => 'Free',
                'price' => 0.00,
                'includes' => [
                    'Access to 1 intro course',
                    '1 free guide',
                    '1 Monthly newsletter',
                    'Blog (limited)',
                ],
            ],
            [
                'title' => 'Premium',
                'price' => 39.99,
                'includes' => [
                    'Access to all online courses',
                    'Full access to digital guides',
                    'All community webinars',
                    '5–10% discount with select partners',
                    'Blog',
                    'Occasional gifts (digital)',
                ],
            ],
            [
                'title' => 'Advanced',
                'price' => 99.99,
                'includes' => [
                    'Access to all courses + early access to new ones',
                    'Exclusive deep-dive newsletters',
                    '1 Holistic session/month (choice of therapist/coach)',
                    'All webinars + VIP Q&A sessions',
                    '15–20% discount with premium partners',
                    'Full forum + private mastermind group',
                    'Retreat discounts, priority booking',
                ],
            ],
        ];

        foreach ($tiers as $tier) {
            Tier::create($tier);
        }
    }
}
