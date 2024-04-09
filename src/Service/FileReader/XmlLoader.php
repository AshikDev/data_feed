<?php

namespace App\Service\FileReader;

use App\Contract\FileReader\XmlLoaderInterface;
use App\Exception\XmlParseException;
use DOMNode;
use SimpleXMLElement;

class XmlLoader implements XmlLoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(DOMNode|false $domNode): SimpleXMLElement
    {
        if ($domNode === false) {
            throw new XmlParseException("Failed to read XML data");
        }

        $simpleXmlElement = simplexml_import_dom($domNode);
        if ($simpleXmlElement === null) {
            throw new XmlParseException("Invalid XML data");
        }

        return $simpleXmlElement;
    }
}
