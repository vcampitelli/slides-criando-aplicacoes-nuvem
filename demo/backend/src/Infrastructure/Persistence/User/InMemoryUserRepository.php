<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{
    /**
     * @var User[]
     */
    private array $users;

    /**
     * @param User[]|null $users
     */
    public function __construct(array $users = null)
    {
        $this->users = $users ?? [
            1 => new User(1, 'bill.gates', 'Bill Gates'),
            2 => new User(2, 'steve.jobs', 'Steve Jobs'),
            3 => new User(3, 'mark.zuckerberg', 'Mark Zuckerberg'),
            4 => new User(4, 'evan.spiegel', 'Evan Spiegel'),
            5 => new User(5, 'jack.dorsey', 'Jack Dorsey'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }

    public function findByUsername(string $username): User
    {
        foreach ($this->users as $user) {
            if ($user->getUsername() === $username) {
                return $user;
            }
        }
        throw new UserNotFoundException();
    }

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $userId = $user->getId();
        if (!$userId) {
            $userId = max($this->users) + 1;
            $user = new User($userId, $user->getUsername(), $user->getName());
        }
        $this->users[$userId] = $user;
        return $user;
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     * @throws UserNotFoundException
     */
    public function delete(User $user): UserRepositoryInterface
    {
        $userId = $user->getId();
        if ($userId) {
            foreach ($this->users as $index => $user) {
                if ($user->getId() === $userId) {
                    unset($this->users[$index]);
                    return $this;
                }
            }
        }
        throw new UserNotFoundException();
    }
}
