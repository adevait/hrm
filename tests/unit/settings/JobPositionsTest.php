<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JobPositionsTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_job_posting_list()
    {
        $this->visit(route('settings.list_job_positions'))
             ->see('Job Positions');
    }
}
