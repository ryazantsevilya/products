<?php

namespace App\Entity;

use DateTime;

class User extends AbstractEntity
{
    use SerializebleTrait;
    
    private string $firstName;
    private string $secondName;
    private DateTime $birthday;

    /**
     * @var Collection<Order>
     */
    private array $orders;
    
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return Collection<Order>
     */
    public function getOrders()
    {
        return $this->orders;
    }

    public function setOrders(array $orders): void
    {
        $this->orders = $orders;
    }
}
