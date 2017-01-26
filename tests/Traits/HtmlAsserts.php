<?php

namespace TestZone\Traits;

trait HtmlAsserts
{
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
