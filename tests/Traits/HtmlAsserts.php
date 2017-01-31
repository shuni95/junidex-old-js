<?php

namespace TestZone\Traits;

trait HtmlAsserts
{
    /**
     * Assert how many times an element is repeated in the HTML
     * @param  string $text
     * @param  integer $times
     * @return $this
     */
    private function seeMany($text, $times)
    {
        $this->assertTrue(substr_count($this->response->getContent(), $text) == $times);
    }
}
