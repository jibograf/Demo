<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Transform;

use Monofony\Contracts\Core\Model\User\AdminUserInterface;
use Behat\Behat\Context\Context;
use Monofony\Bridge\Behat\Service\SharedStorageInterface;

final class AdminUserContext implements Context
{
    /** @var SharedStorageInterface */
    private $sharedStorage;

    public function __construct(SharedStorageInterface $sharedStorage)
    {
        $this->sharedStorage = $sharedStorage;
    }

    /**
     * @Transform /^(I|my)$/
     */
    public function getLoggedAdminUser(): ?AdminUserInterface
    {
        return $this->sharedStorage->get('administrator');
    }
}
