<?php

namespace Acme\DependentFields\Model\Example;

/**
 * Class Mapper
 * @package Acme\DependentFields\Model\Example
 */
class Mapper
{
    /** @var array */
    public $map;

    /** @var \Magento\Catalog\Model\ResourceModel\Eav\Attribute[] */
    private $attributes;

    /**
     * @param \Acme\DependentFields\Model\Example\Attribute $attribues
     */
    public function __construct(
        \Acme\DependentFields\Model\Example\Attribute $attribues
    ) {
        $this->attributes = $attribues;
        $this->map = $this->makeMap();
    }

    /**
     * @return array
     */
    private function makeMap()
    {
        if (is_null($this->map)) {
            $this->map = $this->buildMap();
        }

        return $this->map;
    }

    /**
     * @return array
     */
    private function buildMap()
    {
        $items = [];
        foreach ($this->attributes->getAttributes() as $attribute) {
            $options = [];
            foreach ($attribute->getOptions() as $option) {
                if (empty($option->getValue())) {
                    continue;
                }
                $options[] = [
                    'label' => $option->getLabel(), 'value' => $option->getValue()
                ];
            }
            $items[$attribute->getName()] = $options;
        }

        return $items;
    }
}
