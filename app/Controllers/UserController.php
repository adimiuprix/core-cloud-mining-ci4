<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserPlanHistoryModel;
use App\Models\PlanModel;
use App\Models\TransactionHistoryModel;
use App\Models\UserWithdrawalModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $userPlanHistoryModel;
    protected $planModel;
    protected $transactionHistoryModel;
    protected $UserWithdrawalModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userPlanHistoryModel = new UserPlanHistoryModel();
        $this->planModel = new PlanModel();
        $this->transactionHistoryModel = new TransactionHistoryModel();
        $this->UserWithdrawalModel = new UserWithdrawalModel();
    }

    public function index(){
        return view('home');
    }

    public function authorize() {
        $user_ip_addr = $this->request->getIPAddress();
        $username = $this->request->getPost('username');

        $result = $this->userModel->getUserByUsername($username);

        if ($result) {
            $session = session();
            $session->set('user_data', $result);

            return redirect()->to('dashboard');
        } else {
            $this->userModel->createUser($username, $user_ip_addr);

            $result = $this->userModel->getUserByUsername($username);
            $session = session();
            $session->set('user_data', $result);

            return redirect()->to('dashboard');
        }
    }

    public function dashboard()
    {
        $user_session = session()->get('user_data');

        $this->planModel->plansCron($user_session);

        $balance = $this->userModel->getBalance($user_session);

        $withdrawals = $this->UserWithdrawalModel->get_withdrawals($user_session['user_id'], 'payment', null);

        $total_withdrawal = array_sum(array_column($withdrawals, 'amount'));

        $this->userModel->updateBalances($user_session['user_id'],$balance, $total_withdrawal);

        $getUserBalance = $this->userModel->getUserBalance($user_session['user_id']);

        $total_balance = number_format($getUserBalance,8,'.','');

        $active_plans = (array)$this->userPlanHistoryModel->getActiveUserPlans($user_session['user_id']);

        $userEarningRate = array_sum(array_column($active_plans, 'earning_rate'));

        return view('dashboard', [
            'address' => $user_session['username'],
            'balance' => $total_balance,
            'acplans' => $active_plans,
            'userEarningRate' => $userEarningRate
        ]);
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return view('home');
    }

}
