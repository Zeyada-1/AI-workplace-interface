<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = ['Midjourney', 'DALL-E', 'Stable Diffusion', 'Runway', 'Kling', 'Higgsfield', 'Google AI Studio', 'ChatGPT', 'Claude'];
        
        foreach ($tools as $tool) {
            Tool::create(['name' => $tool]);
        }
    }
}
