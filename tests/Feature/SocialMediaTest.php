<?php

namespace Tests\Feature;

use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SocialMediaTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user
        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        Storage::fake('public');
    }

    public function test_can_view_social_media_index()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.social-media.index'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.social-media.index');
    }

    public function test_can_view_create_form()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.social-media.create'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.social-media.create');
    }

    public function test_can_create_social_media_link()
    {
        $file = UploadedFile::fake()->image('instagram.png', 100, 100);

        $data = [
            'platform' => 'Instagram',
            'url' => 'https://instagram.com/gazaroots',
            'image' => $file,
            'is_active' => true,
            'order' => 1,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.social-media.store'), $data);

        $response->assertRedirect(route('admin.social-media.index'));
        $this->assertDatabaseHas('social_media', ['platform' => 'Instagram']);
    }

    public function test_can_delete_social_media_link()
    {
        $socialMedia = SocialMedia::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.social-media.destroy', $socialMedia));

        $response->assertRedirect(route('admin.social-media.index'));
        $response->assertSessionHas('success');
    }

    public function test_social_media_appears_on_homepage()
    {
        SocialMedia::factory()->create([
            'platform' => 'Instagram',
            'is_active' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewHas('socialMedia');
    }
}

