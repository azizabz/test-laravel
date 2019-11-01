<?php

namespace App\Serializers;

use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Resource\ResourceInterface;

class CustomSerializer extends SerializerAbstract
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
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
    public function null()
    {
        return [];
    }
    /**
     * Serialize the included data.
     *
     * @param ResourceInterface $resource
     * @param array             $data
     *
     * @return array
     */
    public function includedData(ResourceInterface $resource, array $data)
    {
        return $data;
    }

    /**
     * Serialize the meta.
     *
     * @param array $meta
     *
     * @return array
     */
    public function meta(array $meta)
    {
        if (empty($meta)) {
            return [];
        }

        return ['meta' => $meta];
    }
    /**
     * Serialize the paginator.
     *
     * @param PaginatorInterface $paginator
     *
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        $currentPage = (int) $paginator->getCurrentPage();
        $lastPage = (int) $paginator->getLastPage();

        $pagination = [
            'total' => (int) $paginator->getTotal(),
            'count' => (int) $paginator->getCount(),
            'per_page' => (int) $paginator->getPerPage(),
            'current_page' => $currentPage,
            'total_pages' => $lastPage,
        ];

        $pagination['links'] = [];

        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }

        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }

        return ['pagination' => $pagination];
    }

    /**
     * Serialize the cursor.
     *
     * @param CursorInterface $cursor
     *
     * @return array
     */
    public function cursor(CursorInterface $cursor)
    {
        $cursor = [
            'current' => $cursor->getCurrent(),
            'prev' => $cursor->getPrev(),
            'next' => $cursor->getNext(),
            'count' => (int) $cursor->getCount(),
        ];

        return ['cursor' => $cursor];
    }

    public function mergeIncludes($transformedData, $includedData)
    {
        // If the serializer does not want the includes to be side-loaded then
        // the included data must be merged with the transformed data.
        $includedData = array_map(function ($include) {
            if (isset($include['data'])) {
                return $include['data'];
            }

            return $include;
        }, $includedData);

        return parent::mergeIncludes($transformedData, $includedData);
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
