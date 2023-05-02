<?php

namespace App\Services;


use App\Exceptions\NotFoundException;
use App\Helpers\Currency;
use App\Http\Transformers\Response\ApiResponse;
use App\Http\Transformers\Response\ErrorResponse;
use App\Http\Transformers\Response\SuccessResponse;
use App\Managers\TransactionManager;
use App\Models\Transaction;
use App\Store\UserStore;

class CommissionService
{

    private readonly UserStore $userStore;

    public function __construct(UserStore $userStore)
    {
        $this->userStore = $userStore;
    }


    /**
     * @param Transaction[] $transactions
     * @return ApiResponse
     */
    public function calculate(array $transactions): ApiResponse
    {
        $result = [];
        foreach ($transactions as $transaction) {
            try {

                //Get or create user.
                $user = $this->userStore->findOrCreate($transaction->getUserId(), $transaction->getUserType());

                //Calculate fee based on previous transactions
                $fee = TransactionManager::calculateTransactionFee($transaction, $user);

                //after this transaction gets processed we can add it into our transaction pool
                $user->addTransaction($transaction);

                //store fees result
                $result[] = number_format($fee, Currency::getPrecisions($transaction->getCurrency()));
            } catch (NotFoundException $e) {
                return new ErrorResponse(404, $e->getMessage());
            } catch (\Exception $e) {
                return new ErrorResponse(500, $e->getMessage());
            }
        }

        return new SuccessResponse(200, $result);
    }

}
