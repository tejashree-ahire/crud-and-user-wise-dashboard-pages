<?php

namespace App\Controllers;

use App\Models\ClientModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function index()
    {  $data['pagename'] = 'Client Registration';
        return view('templates/header',$data)
            . view('register_form')
            . view('templates/footer');
    }

    public function store()
    {
        
        $rules = [
            'fullname'      => 'required|min_length[3]',
            'age'           => 'required|integer',
            'gender'        => 'required',
            'password'      => 'required|min_length[6]',
            'email'         => 'required|valid_email|is_unique[client.email]',
            'customer_type' => 'required'
        ];
       
        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $clientModel = new ClientModel();

        // $data = [
        //     'fullname'      => $this->request->getPost('fullname'),
        //     'age'           => $this->request->getPost('age'),
        //     'gender'        => $this->request->getPost('gender'),
        //     'password'      => $this->request->getPost('password'),
        //     'email'         => $this->request->getPost('email'),
        //     'customer_type' => $this->request->getPost('customer_type'),
        // ];
        // $input = $this->request->getJSON(true); // decode JSON as array
    $data = [
        'fullname'      => $this->request->getPost('fullname')    ?? $this->request->getVar('fullname'),
        'age'           => $this->request->getPost('age')         ?? $this->request->getVar('age'),
        'gender'        => $this->request->getPost('gender')      ?? $this->request->getVar('gender'),
        'password'      => $this->request->getPost('password')    ?? $this->request->getVar('password'),
        'email'         => $this->request->getPost('email')       ?? $this->request->getVar('email'),
        'customer_type' => $this->request->getPost('customer_type') ?? $this->request->getVar('customer_type'),
    ];
        $saveResult = $clientModel->save($data);
        if ($saveResult) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Client registered successfully.',
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Failed to save client data.',
            ]);
        }
    }


    //Login page
     public function auth()
    {
        $session = session();
        $model = new ClientModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found');
        }


         if ($password !== $user['password']) {
            return redirect()->back()->with('error', 'Incorrect password');
        }

        // Set session data
        $sessionData = [
            'id'            => $user['id'],
            'fullname'      => $user['fullname'],
            'email'         => $user['email'],
            'customer_type' => $user['customer_type'],
            'logged_in'     => true
        ];

        $session->set($sessionData);


    if ($user['customer_type'] === 'Admin') {
        return redirect()->to('admindashboard')->with('success', 'Login successful');
    } else {
        return redirect()->to('dashboard')->with('success', 'Login successful');
    }
 
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }

    public function login()
    {
        $data['pagename'] = 'Login Here';
        return view('templates/header',$data)
            . view('Login')
            . view('templates/footer');
    }

     public function admindashboard(){
         $clientModel = new ClientModel();
         $data['pagename'] = 'Admin dashboard';
        $client['clients'] = $clientModel
            ->where('active_status', 1)
             ->where('customer_type !=', 'Admin')
            ->findAll();


             if (empty($client['clients']) && $this->request->hasHeader('Postman-Token')) {
              return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'User not found!',
            ]);
        }

             if ($this->request->hasHeader('Postman-Token')) {
            return $this->response->setJSON([
                'user' => $client
            ]);
        }else{
            return view('templates/header',$data)
            . view('Admindashboard',$client)
            . view('templates/footer');   
        }
     }

    public function dashboard($userIdapi= '')
    {
        $session = session();
        $data['pagename'] = 'Dashboard Here';

        $db = \Config\Database::connect();
       $userId = empty($session->get('id')) ? $userIdapi : $session->get('id');

$builder = $db->table('client c');
$builder->select('
    c.id AS client_id,
    c.*,
    bi.bill_no AS bill_no,
    g.policy_number AS gic_policy,
    go.goal_name AS goal_name,
    l.policy_number AS lic_policy,
    th.message AS thought
');

$builder->join('gic g', 'g.client_id = c.id', 'left');
$builder->join('lic l', 'l.client_id = c.id', 'left');
$builder->join('rto r', 'r.client_id = c.id', 'left');
$builder->join('mf m', 'm.client_id = c.id', 'left');
$builder->join('bill bi', 'bi.client_id = c.id', 'left');
$builder->join('goal go', 'go.client_id = c.id', 'left');
$builder->join('expenses ex', 'ex.client_id = c.id', 'left');
$builder->join('thought th', 'th.client_id = c.id', 'left');
$builder->where('c.id', $userId);
$query = $builder->get();
$user = $query->getResultArray();

// print_r($user);die();

if(!empty($user)) $user = $user[0];

 if (!$user && $this->request->hasHeader('Postman-Token')) {
              return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'User not found!',
            ]);
        }
        elseif (!$user){
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        if ($this->request->hasHeader('Postman-Token')) {
            return $this->response->setJSON([
                'user' => $user
            ]);
        }else{
            return view('templates/header',$data)
                . view('Dashboard', ['user' => $user])
                . view('templates/footer');       
        }

               
    }

    // edit and update code here
    public function edit($id)
{

    $data['pagename']= "Edit info here";
    $clientModel = new \App\Models\ClientModel();
    $db = \Config\Database::connect();

    $builder = $db->table('client c');
    $builder->select('
        c.id AS client_id,
        c.*,
        bi.bill_no AS bill_no,
        g.policy_number AS gic_policy,
        go.goal_name AS goal_name,
        l.policy_number AS lic_policy,
        th.message AS thought
    ');

    $builder->join('gic g', 'g.client_id = c.id', 'left');
    $builder->join('lic l', 'l.client_id = c.id', 'left');
    $builder->join('rto r', 'r.client_id = c.id', 'left');
    $builder->join('mf m', 'm.client_id = c.id', 'left');
    $builder->join('bill bi', 'bi.client_id = c.id', 'left');
    $builder->join('goal go', 'go.client_id = c.id', 'left');
    $builder->join('expenses ex', 'ex.client_id = c.id', 'left');
    $builder->join('thought th', 'th.client_id = c.id', 'left');

$query = $builder->get();
$user = $query->getResultArray();
if(!empty($user)) $user = $user[0];  
    return view('templates/header',$data)
            . view('Editpage', ['user' => $user])
            . view('templates/footer');
}

    public function update($id)
        {
            $clientModel = new \App\Models\ClientModel();
            $db = \Config\Database::connect();
             $data = [];


// List of expected string fields
$fields = [
    'fullname',
    'email',
    'age',
    'gender',
    'customer_type',
    'bill_no',
    'gic_policy',
    'goal_name',
    'lic_policy',
    'thought'
];

foreach ($fields as $field) {
    $value = $this->request->getPost($field);

    // Handle both array and string safely
    if (is_array($value)) {
        $value = implode(',', $value); // combine if it’s an array
    }

    $value = trim((string)$value);

    if ($value !== '') {
        $data[$field] = $value;
    }
}


            $clientModel->update($id, $data);

            // Update Bill table
            $bill = $this->request->getPost('bill_no');
            if ($bill !== null) {
                $db->table('bill')->where('client_id', $id)->update(['bill_no' => $bill]);
            }

            // Update GIC table
            $gic = $this->request->getPost('gic_policy');
            if ($gic !== null) {
                $db->table('gic')->where('client_id', $id)->update(['policy_number' => $gic]);
            }

            // Update Goal table
            $goal = $this->request->getPost('goal_name');
            if ($goal !== null) {
                $db->table('goal')->where('client_id', $id)->update(['goal_name' => $goal]);
            }

            // Update LIC table
            $lic = $this->request->getPost('lic_policy');
            if ($lic !== null) {
                $db->table('lic')->where('client_id', $id)->update(['policy_number' => $lic]);
            }

            // Update Thought table
            $thought = $this->request->getPost('thought');
            if ($thought !== null) {
                $db->table('thought')->where('client_id', $id)->update(['message' => $thought]);
            }
            if ($this->request->hasHeader('Postman-Token')) {
    return $this->response->setJSON([
        'status'  => 'success',
        'message' => 'Profile updated successfully!',
    ]);
        }else{
            return redirect()->to('/dashboard')->with('success', 'Profile updated successfully!');
        }
        }

    public function delete($id)
    {
        $clientModel = new ClientModel();
        $updated = $clientModel->update($id, ['active_status' => 0]);

        if ($updated) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Client deactivated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Failed to deactivate client.'
            ]);
        }
    }

}
