<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Domain;

class ViewTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index()
    {
        Domain::create(['domainName' => 'example.com', 'deliveredCount' => 0, 'bouncedCount' => 0]);
        $domains = Domain::latest()->paginate(5);
        $view = $this->view('Domains.Index', compact('domains'));

        $view->assertSee('example.com');
    }

    public function test_show()
    {
        Domain::create(['domainName' => 'example.com', 'deliveredCount' => 0, 'bouncedCount' => 0]);
        $domain = Domain::findOrFail(1);
        $view = $this->view('Domains.Show', compact('domain'));

        $view->assertSee('example.com');
    }

    public function test_edit()
    {
        Domain::create(['domainName' => 'example.com', 'deliveredCount' => 0, 'bouncedCount' => 0]);
        $domain = Domain::findOrFail(1);
        $view = $this->view('Domains.Edit', compact('domain'));

        $view->assertSee('example.com');
    }

    public function test_create()
    {
        $view = $this->view('Domains.Create');
        $view->assertSee('example.com');
    }
}
