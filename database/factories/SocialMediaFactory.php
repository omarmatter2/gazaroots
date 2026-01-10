<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialMedia>
 */
class SocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $platforms = ['Instagram', 'TikTok', 'Twitter', 'Telegram', 'Snapchat', 'Facebook', 'YouTube'];
        $platform = $this->faker->unique()->randomElement($platforms);

        return [
            'platform' => $platform,
            'image' => 'social-media/' . strtolower($platform) . '.svg',
            'hover_image' => 'social-media/' . strtolower($platform) . '-hover.svg',
            'url' => 'https://' . strtolower($platform) . '.com/gazaroots',
            'is_active' => $this->faker->boolean(80),
            'order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
