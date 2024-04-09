<?php

namespace App\Contract\DataValidator;

use App\Exception\ReqFieldMissingException;
use SimpleXMLElement;

interface XmlDataValidatorInterface
{
    /**
     * Validates that all required fields in an XML element are present and non-empty.
     *
     * @param SimpleXMLElement $element The XML element to validate.
     * @param array $requiredFields The non-empty fields.
     * @throws ReqFieldMissingException If a required field is missing or empty.
     */
    public function validateRequiredFields(SimpleXMLElement $element, array $requiredFields): void;
}
