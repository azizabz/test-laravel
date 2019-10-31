<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use League\Fractal\Resource\ResourceAbstract;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Create the response for an item.
     *
     * @param  mixed                                $item
     * @param  \League\Fractal\TransformerAbstract  $transformer
     * @param  int                                  $status
     * @param  array                                $headers
     * @return Response
     */
    protected function responseSuccess($resource, $status = 200, array $headers = [])
    {
        return $this->buildResourceResponse($resource, $status, $headers);
    }

    /**
     * Create the response for a resource.
     *
     * @param  \League\Fractal\Resource\ResourceAbstract  $resource
     * @param  int                                        $status
     * @param  array                                      $headers
     * @return Response
     */
    protected function buildResourceResponse(ResourceAbstract $resource, $status = 200, array $headers = [])
    {
        $fractal = new Manager();

        return response()->json(
            $fractal->createData($resource)->toArray(),
            $status,
            $headers
        );
    }
}
