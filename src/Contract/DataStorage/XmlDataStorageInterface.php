<?php

namespace App\Contract\DataStorage;

use App\Exception\NoDataSavedException;
use SimpleXMLElement;

interface XmlDataStorageInterface
{
    /**
     * Processes and stores a collection of XML elements in the database in batches.
     *
     * @param SimpleXMLElement $elements The collection of XML elements to be processed and stored.
     * @return int The number of elements successfully processed and stored.
     * @throws NoDataSavedException If no elements were successfully processed (i.e., no data saved).
     */
    public function store(SimpleXMLElement $elements): int;
}
