<?php

namespace KGzocha\Searcher\Chain\Collection;

use KGzocha\Searcher\AbstractCollection;
use KGzocha\Searcher\Chain\CellInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class CellCollection extends AbstractCollection implements CellCollectionInterface
{
    const MINIMUM_CELLS = 2;

    /**
     * @inheritDoc
     */
    protected function isItemValid($item)
    {
        return $item instanceof CellInterface;
    }

    public function getIterator()
    {
        $this->validateNumberOfCells();

        return parent::getIterator();
    }

    public function getCells()
    {
        $this->validateNumberOfCells();

        return $this->getItems();
    }

    public function getNamedCell($name)
    {
        return $this->getNamedItem($name);
    }

    public function addCell(CellInterface $item)
    {
        return $this->addItem($item);
    }

    public function addNamedCell($name, CellInterface $cell)
    {
        return $this->addNamedItem($name, $cell);
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validateNumberOfCells()
    {
        $count = $this->count();
        if (self::MINIMUM_CELLS <= $count) {
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'At last %d cells are required, but there are only %d in collection %s',
            self::MINIMUM_CELLS,
            $count,
            get_class($this)
        ));
    }
}
