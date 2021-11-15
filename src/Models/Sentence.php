<?php

namespace App\Models;

class Sentence
{
    /**
     * @var string
     */
    private string $content;

    /**
     * @var Word[]
     */
    private array $words;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
        $this->words = $this->setWords();
    }

    /**
     * @return array
     */
    private function setWords(): array
    {
        $words = preg_split(
            '/[^0-9a-zA-Zа-яА-ЯёЁ]+/ui',
            $this->content,
            -1,
            PREG_SPLIT_OFFSET_CAPTURE | PREG_SPLIT_NO_EMPTY
        );

        foreach ($words as &$word) {
            $word = new Word($word[0], $word[1]);
        }
        unset($word);

        return $words ?: [];
    }

    /**
     * @return string
     */
    public function invert(): string
    {
        $invertContent = $this->content;

        foreach ($this->words as $word) {
            $invertContent = substr_replace(
                $invertContent,
                $word->invert(),
                $word->getPosition(),
                $word->getLength()
            );
        }
        return $invertContent;
    }
}