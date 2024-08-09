<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionHistoryModel extends Model
{
    protected $table = 'transactions_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'plan_id', 'amount', 'hash'];

    public function createTransaction(int $user_id, int $plan_id, float $amount, string $hash)
    {
        $this->insert([
            'user_id' => $user_id,
            'plan_id' => $plan_id,
            'amount' => $amount,
            'hash' => $hash,
        ]);
    }
}
