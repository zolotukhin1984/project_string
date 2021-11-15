<?php

namespace App\Models;

class Word
{
    /**
     * @var string
     */
    private string $content;

    /**
     * @var ?int
     */
    private ?int $position;

    /**
     * @var int
     */
    private int $length;

    /**
     * @var array
     */
    private array $characters;

    /**
     * @var array
     */
    private array $positionsOfUppercaseLetters;

    /**
     * @param string $content
     * @param ?int $position
     */
    public function __construct(string $content, ?int $position = null)
    {
        $this->content = $content;
        $this->position = $position;
        $this->length = strlen($this->content);
        $this->characters = $this->setCharacters();
        $this->positionsOfUppercaseLetters = $this->setPositionsOfUppercaseLetters();
    }

    /**
     * @return array
     */
    private function setPositionsOfUppercaseLetters(): array
    {
        $uppercaseLetters = [];
        foreach ($this->characters as $position => $character) {
            if ( mb_ereg('[A-ZА-ЯЁ]', $character) ) {
                $uppercaseLetters[] = $position;
            }
        }
        return $uppercaseLetters;
    }

    /**
     * @return array
     */
    private function setCharacters(): array
    {
        return mb_str_split($this->content) ?: [];
    }

    /**
     * @return string
     */
    public function invert(): string
    {
        $invertContent = $this->characters;

        foreach ($this->positionsOfUppercaseLetters as $position) {
            $invertContent[$position] = mb_strtolower($invertContent[$position]);
        }

        $invertContent = array_reverse($invertContent);

        foreach ($this->positionsOfUppercaseLetters as $position) {
            $invertContent[$position] = mb_strtoupper($invertContent[$position]);
        }

        return implode('', $invertContent);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }
}