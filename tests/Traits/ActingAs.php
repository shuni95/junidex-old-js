<?php

namespace TestZone\Traits;

use App\Admin;
use App\Trainer;

trait ActingAs
{
    private function beTrainer($trainer)
    {
        $this->actingAs($trainer, 'trainer');

        return $trainer;
    }

    private function beAsh()
    {
        return $this->beTrainer(factory(Trainer::class, 'ash')->create());
    }

    private function beAlain()
    {
        return $this->beTrainer(factory(Trainer::class, 'alain')->create());
    }

    private function beAdmin()
    {
        $this->actingAs(factory(Admin::class, 'admin')->create(), 'admin');
    }
}
