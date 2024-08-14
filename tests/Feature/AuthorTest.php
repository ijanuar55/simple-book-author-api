<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_author()
    {
        $response = $this->postJson('/api/authors', [
            'name' => 'Author Name',
            'bio' => 'Some bio',
            'birth_date' => '1970-01-01'
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'name', 'bio', 'birth_date', 'created_at', 'updated_at']);
    }

    public function test_can_update_author()
    {
        $author = Author::factory()->create();

        $response = $this->putJson("/api/authors/{$author->id}", [
            'name' => 'Updated Name'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Name']);
    }

    public function test_can_delete_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/api/authors/{$author->id}");

        $response->assertStatus(204);
    }

    public function test_can_get_authors_books()
    {
        $author = Author::factory()->create();
        $author->books()->create([
            'title' => 'Book Title',
            'description' => 'Description',
            'publish_date' => '2023-08-01',
        ]);

        $response = $this->getJson("/api/authors/{$author->id}/books");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     ['id', 'title', 'description', 'publish_date', 'author_id', 'created_at', 'updated_at']
                 ]);
    }
}
