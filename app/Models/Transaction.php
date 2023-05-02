<?php

namespace App\Models;

class Transaction
{

    public const TYPE_WITHDRAW = 'withdraw';
    public const TYPE_DEPOSIT = 'deposit';
    private string $date;
    private int $userId;
    private string $userType;
    private string $operationType;
    private float $amount;
    private string $currency;

    public function __construct($date, $userId, $userType, $operationType, $amount, $currency)
    {
        $this->date = $date;
        $this->userId = $userId;
        $this->userType = $userType;
        $this->operationType = $operationType;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * @return string
     */
    public function getOperationType(): string
    {
        return $this->operationType;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }


}
