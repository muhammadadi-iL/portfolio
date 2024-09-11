<?php

namespace App\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;


/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @throws ValidatorException
     */
    public function storeOTP($user_id, $otp)
    {
        return $this->update([
            'otp' => $otp,
            'otp_expire' => Carbon::now()->addMinutes(5)
        ], $user_id);
    }

    /**
     * @throws ValidatorException
     */
    public function resetOTP($user_id, $otp, $otp_expire)
    {
        return $this->update([
            'otp' => $otp,
            'otp_expire' => $otp_expire
        ], $user_id);
    }

    /**
     * @throws ValidatorException
     */
    public function resetPassword($user_id, $password)
    {
        return $this->update([
            'password' => $password
        ], $user_id);
    }
}
