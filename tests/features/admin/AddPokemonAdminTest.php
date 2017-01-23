<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Admin;

class AddPokemonAdminTest extends TestCase
{
    use DatabaseMigrations;

    function beAdmin()
    {
        $admin = factory(Admin::class, 'admin')->create();

        $this->actingAs($admin, 'admin');
    }

    /** @test */
    function admin_can_add_a_new_pokemon()
    {
        $this->beAdmin();

        $this->visit('/awesome/pokemon/add');

        $this->type('Rowlet', 'name')
             ->type('Mukuroh', 'japanese_name')
             ->type('モクロー', 'japanese_katakana')
             ->select('Grass', 'type_one')
             ->select('Flying', 'type_two')
             ->select('Unknown', 'habitat')
             ->press('Add to Pokedex');

        $this->seePageIs('/awesome/pokemon')
             ->see('Rowlet')
             ->see('Grass/Flying')
             ->see('Rowlet added to the Pokedex successfully.');
    }

    /** @test */
    function admin_must_fill_all_fields()
    {
        $this->beAdmin();

        $this->visit('/awesome/pokemon/add');

        $this->press('Add to Pokedex');

        $this->seePageIs('/awesome/pokemon/add')
             ->see('Name is required')
             ->see('Japanese Name is required')
             ->see('Japanase Katakana is required')
             ->see('At least select one type');
    }

    /** @test */
    function admin_can_see_old_input_whether_form_fails()
    {
        $this->beAdmin();

        $this->visit('/awesome/pokemon/add');

        $this->type('Rowlet', 'name')
             ->type('Mukuroh', 'japanese_name')
             ->select('Grass', 'type_one')
             ->select('Flying', 'type_two')
             ->select('Unknown', 'habitat')
             ->press('Add to Pokedex');

        $this->seePageIs('/awesome/pokemon/add')
             ->see('Rowlet')
             ->see('Mukuroh')
             ->assertSelected('Grass', 'type_one')
             ->assertNotSelected('Fire', 'type_one');
    }

    /**
     * Assert an element is selected
     * @param  string  $option  Text of the option
     * @param  string  $name    Name of the select
     * @param  boolean $flag    Flag to assertTrue or assertFalse
     * @return $this
     */
    private function assertSelected($option, $name, $flag = true)
    {
        $result = false;

        $this->crawler->filter('select[name='. $name .'] > option')
            ->each(function($node, $i) use(&$result, $option) {
                if ($node->text() == $option) {
                    $result = $node->attr('selected') == null ? false : true;
                }
            });

        $this->assertTrue($result == $flag);

        return $this;
    }

    /**
     * Assert an element is not selected
     * Reuse assertSelected, use the false flag
     * @param  string $option
     * @param  string $name
     * @return $this
     */
    private function assertNotSelected($option, $name)
    {
        $this->assertSelected($option, $name, false);
    }
}
