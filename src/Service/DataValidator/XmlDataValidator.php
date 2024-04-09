<?php

namespace App\Service\DataValidator;

use App\Configuration\CatalogItemConfiguration;
use App\Contract\DataValidator\XmlDataValidatorInterface;
use App\Exception\ReqFieldMissingException;
use SimpleXMLElement;

class XmlDataValidator implements XmlDataValidatorInterface
{
    /**
     * Validates that all required fields in an XML element are present and non-empty.
     *
     * @param SimpleXMLElement $element The XML element to validate.
     * @param array $requiredFields The non-empty fields.
     * @throws ReqFieldMissingException If a required field is missing or empty.
     */
    public function validateRequiredFields(SimpleXMLElement $element, array $requiredFields): void
    {
        foreach ($requiredFields as $field => $fieldName) {
            if (!isset($element->$field) || trim(strval($element->$field)) === '') {
                throw new ReqFieldMissingException(sprintf('%s is required', $fieldName));
            }
        }
    }
}
