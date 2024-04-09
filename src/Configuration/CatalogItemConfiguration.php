<?php

namespace App\Configuration;

class CatalogItemConfiguration
{
    public static array $xmlDataPropertyMap = [
        'entity_id' => ['setter' => 'setEntityId', 'type' => 'int'],
        'CategoryName' => ['setter' => 'setCategoryName', 'type' => 'string'],
        'sku' => ['setter' => 'setSku', 'type' => 'string'],
        'name' => ['setter' => 'setName', 'type' => 'string'],
        'description' => ['setter' => 'setDescription', 'type' => 'string'],
        'shortdesc' => ['setter' => 'setShortDesc', 'type' => 'string'],
        'price' => ['setter' => 'setPrice', 'type' => 'string'],
        'link' => ['setter' => 'setLink', 'type' => 'string'],
        'image' => ['setter' => 'setImage', 'type' => 'string'],
        'Brand' => ['setter' => 'setBrand', 'type' => 'string'],
        'Rating' => ['setter' => 'setRating', 'type' => 'int'],
        'CaffeineType' => ['setter' => 'setCaffeineType', 'type' => 'string'],
        'Count' => ['setter' => 'setCount', 'type' => 'int'],
        'Flavored' => ['setter' => 'setFlavored', 'type' => 'string'],
        'Seasonal' => ['setter' => 'setSeasonal', 'type' => 'string'],
        'Instock' => ['setter' => 'setInStock', 'type' => 'string'],
        'Facebook' => ['setter' => 'setFacebook', 'type' => 'int'],
        'IsKCup' => ['setter' => 'setIsKCup', 'type' => 'int']
    ];

    public static array $requiredFields = [
        'entity_id' => 'Entity ID',
        'CategoryName' => 'Category name',
        'sku' => 'Sku name',
        'name' => 'Name',
        'price' => 'Price'
    ];
}
