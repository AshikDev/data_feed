<?php

namespace App\Contract\DataStore;

use App\Exception\NoDataSavedException;
use Exception;
use SimpleXMLElement;

interface XmlDataStoreInterface
{
    /**
     * Processes and stores a collection of XML elements in the database in batches.
     *
     * @param SimpleXMLElement $elements The collection of XML elements to be processed and stored.
     * @return int The number of elements successfully processed and stored.
     * @throws Exception
     */
    public function store(SimpleXMLElement $elements): int;
}
