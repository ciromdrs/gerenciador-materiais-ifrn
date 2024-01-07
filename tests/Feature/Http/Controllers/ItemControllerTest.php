<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass('\App\Http\Controllers\ItemController')]
class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=MaterialSeeder');
        $this->artisan('db:seed --class=LocalSeeder');
        $this->artisan('db:seed --class=SessionSeeder');
    }

    /**
     * Testa se exibe a página de criação de itens.
     */
    public function test_ItemController_create(): void
    {
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('itens.novo'));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * Testa se exibe a página de edição de itens.
     */
    public function test_ItemController_edit(): void
    {
        $item = Item::factory()->create();

        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('itens.editar', $item));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }

    /**
     * Testa se exibe a página de itens alugados.
     */
    public function test_ItemController_alugados(): void
    {
        $this->markTestSkipped('Funcionalidade não implementada ainda.');
        $response = $this->withCookies(['suapToken' => 'token-falso'])
            ->get(route('itens.alugados'));

        $response->assertStatus(200);
        $response->assertSee('_token'); # Verificar se tem proteção CSRF
    }
}
