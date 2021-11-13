<?php

use App\Models\Sentence;

require __DIR__ . '/../vendor/autoload.php';

$sentence = new Sentence('Привет, мир! Hello, world!!!');
echo $sentence->invert();
