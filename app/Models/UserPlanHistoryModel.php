<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPlanHistoryModel extends Model
{
    protected $table = 'user_plan_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'plan_id', 'status', 'last_sum', 'expire_date', 'created_at'];

    public function getActiveUserPlans(int $userId)
    {
        return $this->select('user_plan_history.*, plans.*')
            ->join('plans', 'plans.id = user_plan_history.plan_id')
            ->where('user_plan_history.user_id', $userId)
            ->where('user_plan_history.status', 'active')
            ->findAll();
    }
}
