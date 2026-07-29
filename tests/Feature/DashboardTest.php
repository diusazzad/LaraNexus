<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * Test that the LaraNexus dashboard loads successfully.
     */
    public function test_laranexus_dashboard_loads_successfully(): void
    {
        $response = $this->get('/laranexus');

        $response->assertStatus(200);
        $response->assertSee('LaraNexus');
        $response->assertSee('Interactive Mindmap');
    }
}
