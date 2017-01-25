<?php

namespace TestZone\Traits;

use App\Admin;

trait ActingAs
{
    private function beTrainer()
    {

    }

    private function beAsh()
    {

    }

    private function beAlain()
    {

    }

    private function beAdmin()
    {
        $this->actingAs(factory(Admin::class, 'admin')->create(), 'admin');
    }
}