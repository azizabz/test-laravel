<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
use App\Transformers\ReportTransformer;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'reports'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'registered_at' => $user->created_at->diffForHumans()
        ];
    }

    public function includeReports(User $user)
    {
        $reports = $user->reports;

        return $this->collection($reports, new ReportTransformer);
    }
}
