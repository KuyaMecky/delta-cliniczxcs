<?php

namespace App\Repositories;

use App\Models\Secretary;
use App\Models\Address;
use App\Models\Department;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class AccountantRepository
 * @version February 5, 2023, 5:34 am UTC
 */
class AccountantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'full_name',
        'email',
        'phone',
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
        return Secretary::class;
    }

    /**
     * @param  array  $input
     * @param  bool  $mail
     *
     * @return bool
     */
    public function store($input, $mail = true)
    {
        try {
            $input['department_id'] = Department::whereName('Secretary')->first()->id;
            $input['password'] = Hash::make($input['password']);
            /** @var User $user */
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            $user = User::create($input);
            if ($mail) {
                $user->sendEmailVerificationNotification();
            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = storeProfileImage($user, $input['image']);
            }
            $accountant = Secretary::create(['user_id' => $user->id]);
            $ownerId = $accountant->id;
            $ownerType = Secretary::class;

            if (! empty($address = Address::prepareAddressArray($input))) {
                Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
            }

            $user->update(['owner_id' => $ownerId, 'owner_type' => $ownerType]);
            $user->assignRole($input['department_id']);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  Secretary  $accountant
     * @param  array  $input
     *
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($accountant, $input)
    {
        try {
            unset($input['password']);

            /** @var User $user */
            $user = User::find($accountant->user->id);
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }
            if (isset($input['image']) && !empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }

            /** @var Secretary $accountant */
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['dob'] = (!empty($input['dob'])) ? $input['dob'] : null;
            $accountant->user->update($input);
            $accountant->update($input);

            if (!empty($accountant->address)) {
                if (empty($address = Address::prepareAddressArray($input))) {
                    $accountant->address->delete();
                }
                $accountant->address->update($input);
            } else {
                if (! empty($address = Address::prepareAddressArray($input)) && empty($accountant->address)) {
                    $ownerId = $accountant->id;
                    $ownerType = Secretary::class;
                    Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
                }
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
