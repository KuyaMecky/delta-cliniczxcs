<?php

namespace App\Queries;

use App\Models\Secretary;
use Illuminate\Database\Query\Builder;

/**
 * Class AccountantData
 */
class AccountantDataTable
{
    /**
     * @param  array  $input
     *
     * @return Secretary|Builder
     */
    public function get($input = [])
    {
        /** @var Secretary $query */
        $query = Secretary::whereHas('user')->with('user')->select('accountants.*');

        $query->when(isset($input['status']) && $input['status'] != Secretary::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->whereHas('user', function ($q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });
            });

        return $query;
    }
}
