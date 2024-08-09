<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserPlanHistoryModel;

class PlanModel extends Model
{
    protected $table = 'plans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['is_default'];
    protected $UserPlanHistoryModel;

    public function __construct()
    {
        $this->UserPlanHistoryModel = new UserPlanHistoryModel();
    }

    public function getDefaultPlan()
    {
        return $this->where('is_default', 1)->first();
    }

    public function getPaidPlans()
    {
        return $this->where('is_default', 0)->findAll();
    }

    public function plansCron(array $data_session): void
    {
        $plans = $this->UserPlanHistoryModel
                      ->where('user_id', $data_session['user_id'])
                      ->where('status', 'active')
                      ->where('expire_date IS NOT NULL', null, false)
                      ->findAll();

        foreach ($plans as $plan) {
            $now = time();
            $expire_date = strtotime($plan['expire_date']);

            if ($now >= $expire_date) {
                $this->userPlanHistoryModel->update($plan['id'], ['status' => 'inactive']);
            }
        }
    }
}
