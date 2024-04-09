<?php

namespace App\Contract\FileReader;

use App\Exception\XmlParseException;
use DOMNode;
use SimpleXMLElement;

interface XmlLoaderInterface
{
    /**
     * Loads XML content into a SimpleXMLElement.
     *
     * @param DOMNode $domNode
     * @return SimpleXMLElement The SimpleXMLElement instance.
     * @throws XmlParseException If the XML cannot be parsed.
     */
    public function load(DOMNode $domNode): SimpleXMLElement;
}
