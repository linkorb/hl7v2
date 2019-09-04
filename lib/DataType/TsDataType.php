<?php

namespace Hl7v2\DataType;

/**
 * Time Stamp (TS).
 */
class TsDataType extends ComponentDataType
{
    const MAX_LEN = 26;

    /**
     * @var DtmDataType
     */
    private $time;
    /**
     * @var IdDataType
     */
    private $degreeOfPrecision;

    /**
     * @param string $time
     */
    public function setTime(string $time = null)
    {
        $this->time = $this
            ->dataTypeFactory
            ->create('DTM', $this->encodingParameters)
        ;
        $this->time->setValue($time);
    }

    /**
     * @param string $degreeOfPrecision
     */
    public function setDegreeOfPrecision(string $degreeOfPrecision = null)
    {
        $this->degreeOfPrecision = $this
            ->dataTypeFactory
            ->create('ID', $this->encodingParameters)
        ;
        $this->degreeOfPrecision->setValue($degreeOfPrecision);
    }

    /**
     * @return \Hl7v2\DataType\DtmDataType
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return \Hl7v2\DataType\IdDataType
     */
    public function getDegreeOfPrecision()
    {
        return $this->degreeOfPrecision;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $s = '';

        $sep = $this->isSubcomponent
            ? $this->encodingParameters->getSubcomponentSep()
            : $this->encodingParameters->getComponentSep()
        ;

        if ($this->getTime() && $this->getTime()->hasValue()) {
            $s .= (string) $this->getTime()->getValue();
        }

        $emptyComponentsSinceLastComponent = 0;

        if (!$this->getDegreeOfPrecision() || !$this->getDegreeOfPrecision()->hasValue()) {
            ++$emptyComponentsSinceLastComponent;
        } else {
            $s .= str_repeat($sep, 1 + $emptyComponentsSinceLastComponent)
                . (string) $this->getDegreeOfPrecision()->getValue();
            ;
            $emptyComponentsSinceLastComponent = 0;
        }

        return $s;
    }
}
