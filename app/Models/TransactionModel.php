<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'plan_id', 'amount', 'hash'];
}
