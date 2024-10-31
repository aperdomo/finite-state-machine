<?php

namespace Tests\Unit\FSM\Chars;

use Src\FSM\Chars\Alphabet;
use Tests\BaseTestCase;
use Src\FSM\Core\Collection;

class AlphabetTest extends BaseTestCase
{
    public function test_it_can_construct(): void
    {
        $alphabet = new Alphabet(
            ['0', '1'],
        );

        $this->assertInstanceOf(Alphabet::class, $alphabet);
    }

    public function test_it_can_get_letters()
    {
        $alphabet = new Alphabet(
            ['0', '1'],
        );

        $this->assertEquals(['0', '1'], $alphabet->getLetters());
    }

    public function test_it_contains()
    {
        $alphabet = new Alphabet(
            ['0', '1'],
        );

        $this->assertTrue($alphabet->contains('1'));
    }
}
