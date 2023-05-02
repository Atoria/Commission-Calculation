<?php

namespace App\Models;


use App\Interfaces\UserInterface;

abstract class User implements UserInterface
{
    public const TYPE_PRIVATE = 'private';
    public const TYPE_BUSINESS = 'business';

    protected int $id;
    /**
     * @var Transaction[]
     */
    protected array $transactions;



    public function __construct()
    {
        $this->transactions = [];
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

}
