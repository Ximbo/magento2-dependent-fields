<?php

namespace Acme\DependentFields\Model\Example;

/**
 * Class AttributeOptions
 * @package Acme\DependentFields\Model\Example
 */
class Attribute implements \Magento\Framework\Option\ArrayInterface
{
    /** @var \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory */
    private $collectionFactory;

    /** @var \Acme\DependentFields\Model\Example\AttributeScope */
    private $scope;

    /** @var array */
    private $items;

    /**
     * @param \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $collectionFactory
     * @param \Acme\DependentFields\Model\Example\AttributeScope $scope
     */
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $collectionFactory,
        \Acme\DependentFields\Model\Example\AttributeScope $scope
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->scope = $scope;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        if (is_null($this->items)) {
            $this->items = $this->getOptions();
        }

        return $this->items;
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Eav\Attribute[]|\Magento\Framework\DataObject[]
     */
    public function getAttributes()
    {
        $codes = $this->scope->getCodes();
        $collection = $this->getCollection();
        if (! empty($codes)) {
            $collection->addFieldToFilter('attribute_code', $codes);
        }
        return $collection->getItems();
    }

    /**
     * @return array
     */
    private function getOptions()
    {
        $items = [];
        foreach ($this->getAttributes() as $attribute) {
            $items[] = [
                'label' => $attribute->getStoreLabel(), 'value' => $attribute->getName(),
            ];
        }
        return $items;
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Attribute\Collection
     */
    private function getCollection()
    {
        return $this->collectionFactory->create();
    }
}
