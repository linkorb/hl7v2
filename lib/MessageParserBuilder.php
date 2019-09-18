<?php

namespace Hl7v2;

use Hl7v2\Encoding\CharacterEncodingNames;
use Hl7v2\Encoding\Codec;
use Hl7v2\Encoding\EncodingParametersBuilder;
use Hl7v2\Factory\DataTypeFactory;
use Hl7v2\Factory\MessageFactory;
use Hl7v2\Factory\SegmentFactory;
use Hl7v2\Factory\SegmentGroupFactory;

class MessageParserBuilder
{
    private $charEncNames;
    private $codec;
    private $dataTypeFac;
    private $encParamsBuilder;
    private $messageFac;
    private $segmentFac;
    private $segmentGroupFac;
    private $version = 'v251';

    /**
     * @return \Hl7v2\MessageParser
     */
    public function build()
    {
        $this
            ->buildDataTypeFactory()
            ->buildSegmentFactory()
            ->buildSegmentGroupFactory()
            ->buildMessageFactory()
            ->buildEncodingParametersBuilder()
            ->buildCodec()
        ;

        return new MessageParser(
            $this->codec,
            $this->encParamsBuilder,
            $this->messageFac,
            $this->segmentFac
        );
    }

    private function buildDataTypeFactory()
    {
        if (!$this->dataTypeFac) {
            $this->dataTypeFac = new DataTypeFactory($this->version);
        }

        return $this;
    }

    private function buildSegmentFactory()
    {
        if (!$this->segmentFac) {
            $this->segmentFac = new SegmentFactory($this->dataTypeFac, $this->version);
        }

        return $this;
    }

    private function buildSegmentGroupFactory()
    {
        if (!$this->segmentGroupFac) {
            $this->segmentGroupFac = new SegmentGroupFactory();
        }

        return $this;
    }

    private function buildMessageFactory()
    {
        if (!$this->messageFac) {
            $this->messageFac = new MessageFactory(
                $this->segmentFac,
                $this->segmentGroupFac
            );
        }

        return $this;
    }

    private function buildEncodingParametersBuilder()
    {
        if (!$this->encParamsBuilder) {
            $this->encParamsBuilder = new EncodingParametersBuilder;
        }

        return $this;
    }

    private function buildCodec()
    {
        if (!$this->codec && !$this->charEncNames) {
            $this->codec = new Codec(new CharacterEncodingNames);
        } elseif (!$this->codec) {
            $this->codec = new Codec($this->charEncNames);
        }

        return $this;
    }

    /**
     * @param \Hl7v2\Encoding\CharacterEncodingNames $charEncNames
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withCharacterEncodingNames(CharacterEncodingNames $charEncNames)
    {
        $this->charEncNames = $charEncNames;

        return $this;
    }

    /**
     * @param \Hl7v2\Encoding\Codec $codec
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withCodec(Codec $codec)
    {
        $this->codec = $codec;

        return $this;
    }

    /**
     * @param \Hl7v2\Factory\DataTypeFactory $dataTypeFac
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withDataTypeFactory(DataTypeFactory $dataTypeFac)
    {
        $this->dataTypeFac = $dataTypeFac;

        return $this;
    }

    /**
     * @param \Hl7v2\Encoding\EncodingParametersBuilder $encParamsBuilder
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withEncodingParametersBuilder(EncodingParametersBuilder $encParamsBuilder)
    {
        $this->encParamsBuilder = $encParamsBuilder;

        return $this;
    }

    /**
     * @param \Hl7v2\Factory\MessageFactory $messageFac
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withMessageFactory(MessageFactory $messageFac)
    {
        $this->messageFac = $messageFac;

        return $this;
    }

    /**
     * @param \Hl7v2\Factory\SegmentFactory $segmentFac
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withSegmentFactory(SegmentFactory $segmentFac)
    {
        $this->segmentFac = $segmentFac;

        return $this;
    }

    /**
     * @param \Hl7v2\Factory\SegmentGroupFactory $segmentGroupFac
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withSegmentGroupFactory(SegmentGroupFactory $segmentGroupFac)
    {
        $this->segmentGroupFac = $segmentGroupFac;

        return $this;
    }

    /**
     * @param string $version e.g. v231
     *
     * @return \Hl7v2\MessageParserBuilder
     */
    public function withVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
