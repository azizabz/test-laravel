<?php
/*
 * This file is part of the League\Fractal package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Serializers;

use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Resource\ResourceInterface;

abstract class CustomSerializer extends DataArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data, $message)
    {
        return [
            'status' => [
                'code'    => 0,
                'message' => 'success'
            ],
            'data' => $data
        ];
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return [
            'status' => [
                'code'    => 0,
                'message' => 'success'
            ],
            'data' => $data
        ];
    }
    /**
     * Serialize null resource.
     *
     * @return array
     */
    abstract public function null();
    /**
     * Serialize the included data.
     *
     * @param ResourceInterface $resource
     * @param array             $data
     *
     * @return array
     */
    abstract public function includedData(ResourceInterface $resource, array $data);
    /**
     * Serialize the meta.
     *
     * @param array $meta
     *
     * @return array
     */
    abstract public function meta(array $meta);
    /**
     * Serialize the paginator.
     *
     * @param PaginatorInterface $paginator
     *
     * @return array
     */
    abstract public function paginator(PaginatorInterface $paginator);
    /**
     * Serialize the cursor.
     *
     * @param CursorInterface $cursor
     *
     * @return array
     */

    abstract public function cursor(CursorInterface $cursor);
    public function mergeIncludes($transformedData, $includedData)
    {
        // If the serializer does not want the includes to be side-loaded then
        // the included data must be merged with the transformed data.
        if (!$this->sideloadIncludes()) {
            return array_merge($transformedData, $includedData);
        }
        return $transformedData;
    }
    /**
     * Indicates if includes should be side-loaded.
     *
     * @return bool
     */
    public function sideloadIncludes()
    {
        return false;
    }
    /**
     * Hook for the serializer to inject custom data based on the relationships of the resource.
     *
     * @param array $data
     * @param array $rawIncludedData
     *
     * @return array
     */
    public function injectData($data, $rawIncludedData)
    {
        return $data;
    }
    /**
     * Hook for the serializer to inject custom data based on the available includes of the resource.
     *
     * @param array $data
     * @param array $availableIncludes
     *
     * @return array
     */
    public function injectAvailableIncludeData($data, $availableIncludes)
    {
        return $data;
    }
    /**
     * Hook for the serializer to modify the final list of includes.
     *
     * @param array             $includedData
     * @param array             $data
     *
     * @return array
     */
    public function filterIncludes($includedData, $data)
    {
        return $includedData;
    }
    /**
     * Get the mandatory fields for the serializer
     *
     * @return array
     */
    public function getMandatoryFields()
    {
        return [];
    }
}
