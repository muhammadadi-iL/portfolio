<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function storeOTP($user_id, $otp);

    public function resetOTP($user_id, $otp, $otp_expire);

    public function resetPassword($user_id, $password);
}
