<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AiProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ai_projects')->insert(['title' => 'Nike Campaign Stills', 'ai_tool' => 'Midjourney', 'content_type' => 'image', 'brand' => 'Nike', 'status' => 'approved', 'priority' => 'high', 'deadline' => 'End of December', 'notes' => 'Athletic models in urban settings, --v 6.0 --ar 16:9']);
        DB::table('ai_projects')->insert(['title' => 'TikTok Product Teaser', 'ai_tool' => 'Kling', 'content_type' => 'video', 'brand' => 'Adidas', 'status' => 'generating', 'priority' => 'medium', 'deadline' => 'Next Friday', 'notes' => 'Dynamic product reveal with motion graphics']);
        DB::table('ai_projects')->insert(['title' => 'Zara Lifestyle Edit', 'ai_tool' => 'Higgsfield', 'content_type' => 'edit', 'brand' => 'Zara', 'status' => 'editing', 'priority' => 'high', 'deadline' => 'This week', 'notes' => 'Color grading and style transfer applied']);
        DB::table('ai_projects')->insert(['title' => 'Urban Outfitters Mood Board', 'ai_tool' => 'Google AI Studio', 'content_type' => 'prompt-only', 'brand' => 'Urban Outfitters', 'status' => 'idea', 'priority' => 'low', 'deadline' => null, 'notes' => 'Vintage aesthetic prompts collection']);
        DB::table('ai_projects')->insert(['title' => 'Lululemon Active Campaign', 'ai_tool' => 'Midjourney', 'content_type' => 'image', 'brand' => 'Lululemon', 'status' => 'posted', 'priority' => 'medium', 'deadline' => 'Already completed', 'notes' => 'Yoga and fitness lifestyle imagery']);
    }
}
