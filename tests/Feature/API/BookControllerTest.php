<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\Book;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_book_get_endpoint(): void
    {
        $books = Book::factory(3)->create();

        $response = $this->getJson('/api/book');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
        
        $response->assertJson( function(AssertableJson $json) use ($books) {
                $json->whereType('0.id', 'integer');
                $json->whereType('0.title', 'string');
                $json->whereType('0.isbn', 'string');

                $json->whereAllType(
                    [
                        '0.id' => 'integer',
                        '0.title' => 'string',
                        '0.isbn' => 'string'
                    ]
                );

                $json->hasAll(['0.id', '0.title', '0.isbn']);

                $book = $books->first();

                $json->whereAll(
                    [
                        '0.id' => $book->id,
                        '0.title' => $book->title,
                        '0.isbn' => $book->isbn,
                    ]
                );
            }

        );

    }
}
