<?php

namespace Hl7v2\Factory;

use Hl7v2\DataType\ComponentInterface;
use Hl7v2\Exception\DataTypeError;

class DataTypeFactory
{
    /**
     * Create a Data Type.
     *
     * @param string $typeName
     * @param string $characterEncoding
     * @return \Hl7v2\DataType\DataTypeInterface
     * @throws \Hl7v2\Exception\DataTypeError
     */
    public function create($typeName, $characterEncoding)
    {
        $class = $this->determineClassname($typeName);
        $type = new $class;

        if ($type instanceof ComponentInterface) {
            $type->setDataTypeFactory($this);
        }

        $type->setCharacterEncoding($characterEncoding);

        return $type;
    }

    private function determineClassname($typeName)
    {
        $name = ucfirst(strtolower($typeName));
        $class = "\\Hl7v2\\DataType\\{$name}DataType";
        if (!class_exists($class)) {
            throw new DataTypeError("Unknown DataType \"{$typeName}\".");
        }
        return $class;
    }
}