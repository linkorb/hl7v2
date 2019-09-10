<?php

namespace Hl7v2\Encoding;

/**
 * Maintain various positional information during HL7 message decoding.
 */
class PositionalState
{
    const BEGIN_SEGMENT = 0x00;
    const BEGIN_FIELD = 0x01;
    const BEGIN_REPETITION = 0x02;
    const BEGIN_COMPONENT = 0x03;
    const BEGIN_SUBCOMPONENT = 0x04;

    const END_SEGMENT = 0x10;
    const END_FIELD = 0x11;
    const END_REPETITION = 0x12;
    const END_COMPONENT = 0x13;
    const END_SUBCOMPONENT = 0x14;

    /**
     * The position of the first character of a Segment.
     *
     * @var int|bool
     */
    public $sos = false;
    /**
     * The position of the first character of a Field.
     *
     * @var int|bool
     */
    public $sof = false;
    /**
     * The position of the first character of a Repeated Field.
     *
     * @var int|bool
     */
    public $sor = false;
    /**
     * The position of the first character of a Component.
     *
     * @var int|bool
     */
    public $soc = false;
    /**
     * The position of the first character of a Subcomponent.
     *
     * @var int|bool
     */
    public $sosc = false;
    /**
     * The position of the character after the last of a Sucomponent.
     *
     * @var int|bool
     */
    public $eosc = false;
    /**
     * The position of the character after the last of a Component.
     *
     * @var int|bool
     */
    public $eoc = false;
    /**
     * The position of the character after the last of a Repeated Field.
     *
     * @var int|bool
     */
    public $eor = false;
    /**
     * The position of the character after the last of a Field.
     *
     * @var int|bool
     */
    public $eof = false;
    /**
     * The position of the character after the last of a Segment.
     *
     * @var int|bool
     */
    public $eos = false;
    /**
     * The position of the _last character_ in a message.
     *
     * @var int|bool
     */
    public $eod = false;

    /**
     * The current decoder position.
     *
     * @var int
     */
    public $ptr = 0;
    /**
     * The decoder state, as per the current decoder position.
     *
     * @var int
     */
    public $state = self::BEGIN_SEGMENT;

    /**
     * Reset the Segment start and end positions.
     */
    public function resetSegmentBounds()
    {
        $this->sos = $this->eos = false;
    }

    /**
     * Reset the Field start and end positions.
     */
    public function resetFieldBounds()
    {
        $this->sof = $this->eof = false;
    }

    /**
     * Reset the Repetition start and end positions.
     */
    public function resetRepetitionBounds()
    {
        $this->sor = $this->eor = false;
    }

    /**
     * Reset the Component start and end positions.
     */
    public function resetComponentBounds()
    {
        $this->soc = $this->eoc = false;
    }

    /**
     * Reset the Component start and end positions.
     */
    public function resetSubcomponentBounds()
    {
        $this->sosc = $this->eosc = false;
    }
}
