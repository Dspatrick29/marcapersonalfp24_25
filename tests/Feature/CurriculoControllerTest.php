<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurriculoControllerTest extends TestCase
{
    public function test_controladores(): void
    {
    /**
     * A basic feature test example.
     */
     /**
         * proyectos index test.
         */
        $response = $this->get('/proyectos');
        $nombres = [
            'Tecnologías de la Información',
            'Diseño Gráfico',
            'Electrónica',
            'Ingeniería Civil',
            'Gastronomía',
            'Medicina',
            'Mecatrónica',
            'Arquitectura',
            'Automoción',
            'Turismo',
        ];

        $response
        ->assertStatus(200)
        ->assertViewIs('proyectos.index')
        ->assertSeeTextInOrder($nombres, $escaped = true);

    /**
     * proyectos show test.
     */
        $response = $this->get("/proyectos/show/1");

        $response
        ->assertStatus(200)
        ->assertViewIs('proyectos.show')
        ->assertSeeText('Diseño Gráfico', $escaped = true);

        $response = $this->get("/proyectos/show/2");

        $response
        ->assertSeeText('Electrónica', $escaped = true);

        $response = $this->get("/proyectos/show/A");
        $response->assertNotFound();

    /**
     * proyectos create test.
     */
        $value = 'Añadir proyecto';
        $response = $this->get('/proyectos/create');

        $response
        ->assertStatus(200)
        ->assertViewIs('proyectos.create')
        ->assertSeeText($value, $escaped = true);

    /**
     * proyectos edit test.
     */
        $id = rand(1, 10);
        $value = "Modificar proyecto";
        $response = $this->get("/proyectos/edit/$id");

        $response
        ->assertStatus(200)
        ->assertViewIs('proyectos.edit')
        ->assertSeeText($value, $escaped = true);

        $response = $this->get("/proyectos/edit/A");
        $response->assertNotFound();

    }
}
