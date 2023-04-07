<?php

namespace App\Repositories;

use App\Models\CurrencySetting;
use App\Repositories\BaseRepository;

/**
 * Class CurrencySettingRepository
 * @package App\Repositories
 * @version September 30, 2022, 7:29 pm UTC
*/

class CurrencySettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CurrencySetting::class;
    }
}
