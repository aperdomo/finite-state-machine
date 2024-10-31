<?php

namespace Src\FSM\Chars;

class Alphabet
{
    /**
     * @var string[] $letters
     */
    private array $letters;

    /**
     * @param string[] $letters
     */
    public function __construct(array $letters)
    {
        $this->letters = $letters;
    }

    /**
     * @return string[]
     */
    public function getLetters(): array
    {
        return $this->letters;
    }

    /**
     * @param string $letter
     * @return bool
     */
    public function contains(string $letter): bool
    {
        return in_array($letter, $this->letters);
    }
}
