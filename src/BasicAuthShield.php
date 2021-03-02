<?php

namespace Thtg88\LaravelBaseClasses;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Vinkla\Shield\Shield;

class BasicAuthShield extends Shield
{
    /**
     * Create a new shield instance.
     *
     * @param array $users
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = config('shield.users');
    }

    /**
     * Verify the user input.
     *
     * @param string|null $username
     * @param string|null $password
     * @param string|null $user
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     *
     * @return bool
     */
    public function verify(
        ?string $username,
        ?string $password,
        ?string $user = null
    ): bool {
        if ($username === null || $password === null) {
            return false;
        }

        $users = $this->getUsers($user);

        foreach ($users as $user => $credentials) {
            if (
                $username === reset($credentials) &&
                $password === end($credentials)
            ) {
                $this->currentUser = $user;

                return true;
            }
        }

        throw new UnauthorizedHttpException('Basic');
    }
}
