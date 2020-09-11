<?php

use MadeITBelgium\SeoAnalyzer\Seo;

class SeoTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSimpleText()
    {
        $seo = new Seo();
        $seo->analyze('https://www.madeit.be/haal-meer-uit-linkedin-met-deze-7-tips/');
    }
}
