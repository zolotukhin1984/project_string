<?php

namespace App\Tests\Models;

use App\Models\Sentence;
use PHPUnit\Framework\TestCase;

class SentenceTest extends TestCase
{
    public function testInvert()
    {
        $string = 'Привет, мир! Hello, world!!!';
        $sentence = new Sentence($string);

        $this->assertEquals(
            'Тевирп, рим! Olleh, dlrow!!!',
            $sentence->invert()
        );
    }

}