<?php
namespace App\Models;

use CodeIgniter\Model;

class UserWithdrawalModel extends Model
{
    protected $table = 'user_withdrawal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'type', 'amount', 'status', 'tx', 'date_paid'];
    protected $returnType = 'array';

    public function get_withdrawals($type='payment', $status=null)
    {
        if (session()->has('user_id') && session('user_id') != "") {
            $userWithdrawalModel = new \App\Models\UserWithdrawalModel();

            return $userWithdrawalModel->where('user_id', session('user_id'))
                                       ->where('type', $type)
                                       ->when($status, function($query) use ($status) {
                                           return $query->where('status', $status);
                                       })
                                       ->findAll();
        }

        return [];
    }
}

