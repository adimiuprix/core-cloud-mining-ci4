<?php

namespace App\Models;
use App\Models\PlanModel;
use App\Models\UserPlanHistoryModel;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $planModel;
    protected $UserPlanHistoryModel;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['unique_id', 'username', 'balance', 'cashouts', 'plan_id', 'reference_user_id', 'affiliate_earns', 'affiliate_paid', 'ip_addr',];
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    public function __construct()
    {
        parent::__construct();
        $this->planModel = new PlanModel();
        $this->UserPlanHistoryModel = new UserPlanHistoryModel();
    }

    public function getUserByUsername(string $username): array|false
    {
        $builder = $this->db->table('users');
        $builder->select('users.*, plans.*, users.id AS user_id')
            ->join('plans', 'users.plan_id = plans.id')
            ->where('users.username', $username);

        $query = $builder->get();

        return $query->getFirstRow('array') ?: false;
    }

    public function createUser(string $username, string $user_ip_addr): void
    {
        $plan = $this->db->table('plans')
            ->select('id')
            ->where('is_default', 1)
            ->get()
            ->getRow();

        $builder = $this->db->table('users');
        $builder->insert([
            'username'          => $username,
            'plan_id'           => $plan->id,
            'ip_addr'           => $user_ip_addr,
        ]);

        $user_id = $this->db->insertID();

        // Insert ke tabel user_plan_history
        $builder = $this->db->table('user_plan_history');
        $builder->insert([
            'user_id' => $user_id,
            'plan_id' => $plan->id,
            'status'  => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'expire_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 7 days')),
            'last_sum' => time()
        ]);
    }

    public function updateBalances(int $userId, float $balance, float $withdraws)
    {
        return $this->set('balance', 'balance + ' . $balance, false)
             ->set('cashouts', 'cashouts + ' . $withdraws, false)
             ->where('id', $userId)
             ->update();
    }

    public function getUserBalance(int $user_id) :string
    {
        $result = $this->db->table('users')
            ->select('balance')
            ->where('id', $user_id)
            ->get()
            ->getRow();

        return $result->balance;
    }

    function getBalance(array $data): string
    {
        $builder = $this->db->table('user_plan_history uph')
                      ->select('uph.id, uph.plan_id, uph.user_id, uph.last_sum, uph.created_at, p.earning_rate')
                      ->join('plans p', 'uph.plan_id = p.id')
                      ->where('uph.user_id', $data['user_id'])
                      ->where('uph.status', 'active');

        $result = $builder->get()->getResultArray();

        $earning = 0;
        if ($result) {
            foreach ($result as $val) {
                $date1 = time();
                $date2 = $val['last_sum'] ?: strtotime($val['created_at']);
                $sec = $date1 - $date2;
                $earning += $sec * ($val['earning_rate'] / 60);

                $this->UserPlanHistoryModel->update($val['id'], ['last_sum' => time()]);
            }
        }

        return number_format($earning, 8, '.', '');
    }
}
