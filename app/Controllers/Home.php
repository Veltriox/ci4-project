<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        
        $data = [
            'users' => $userModel->paginate(10),
            'pager' => $userModel->pager,
        ];

        return view('admin/dashboard', $data); 
    }

    public function profile()
    {
        if (!session()->get('username')) {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $data = [
            'currentUser' => $userModel->find(session()->get('user_id'))
        ];

        return view('admin/profile', $data);
    }

    public function userList()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $data = [
            'users' => $userModel->paginate(10),
            'pager' => $userModel->pager
        ];

        return view('admin/user_list', $data);
    }

    public function addUser()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        return view('admin/add_user');
    }

    public function saveUser()
    {
        $username   = $this->request->getPost('username');
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');
        $phone      = $this->request->getPost('phone');
        $firstName  = $this->request->getPost('first_name');
        $lastName   = $this->request->getPost('last_name');

        // 1. EMPTY CHECK
        if (empty($username) || empty($email) || empty($password) || empty($phone)) {
            $f = empty($username) ? 'username' : (empty($email) ? 'email' : (empty($phone) ? 'phone' : 'password'));
            return $this->response->setJSON(['status' => 'error', 'field' => $f, 'message' => 'Please fill this field!']);
        }

        // 2. PHONE VALIDATION
        if (!is_numeric($phone) || strlen($phone) != 10) {
            return $this->response->setJSON(['status' => 'error', 'field' => 'phone', 'message' => 'Phone must be exactly 10 digits!']);
        }

        // 3. USERNAME FORMAT
        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'field'   => 'username',
                'message' => 'Username must be letters and numbers only!'
            ]);
        }

        // 3. EMAIL FORMAT
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'field'   => 'email',
                'message' => 'Please enter a valid email!'
            ]);
        }

        // 4. DOMAIN CHECK (DNS)
        $domain = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($domain, "MX")) {
            return $this->response->setJSON([
                'status'  => 'error',
                'field'   => 'email',
                'message' => 'This email domain does not exist!'
            ]);
        }

        $userModel = new \App\Models\UserModel();

        // 5. UNIQUENESS CHECK
        if ($userModel->where('email', $email)->first()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'field'   => 'email',
                'message' => 'This email is already registered!'
            ]);
        }

        // 6. SAVE
        $userModel->save([
            'username'   => $username,
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'phone'      => $phone, 
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return $this->response->setJSON([
            'status'   => 'success',
            'redirect' => site_url('home/userList')
        ]);
    }

    public function logout()
    {
        // 3. Destroy the "VIP Pass" (Session)
        session()->destroy();
        // Go back to login
        return redirect()->to('/login');
    }

    public function updateAccount()
    {
        $id = session()->get('user_id'); // Get the ID from memory
        $newName = $this->request->getPost('new_username');

        if ($id == null) {
            // If ID is empty, we are not logged in!
            return redirect()->to('/login');
        } else {
            // If we have an ID, we update the name
            $userModel = new \App\Models\UserModel();
            
            // 1. Save new name to database
            $userModel->update($id, ['username' => $newName]);

            // 2. Update memory (Session) so the UI shows the new name
            session()->set('username', $newName);

            return redirect()->to('/home');
        }
    }

    public function deleteAccount()
    {
        $id = session()->get('user_id'); // 1. Get your ID from memory

        if ($id == null) {
            return redirect()->to('/login');
        } else {
            $userModel = new \App\Models\UserModel();
            
            // 2. DELETE your row from the Database
            $userModel->delete($id);

            // 3. Clear your memory (Logout)
            session()->destroy();

            // 4. Go back to login with a message
            return redirect()->to('/login');
        }
    }

    // --- ADMIN ACTIONS (NEW) ---

    // 1. Show the Edit Page
    public function editUser($id)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id); // Get just THIS user

        if (!$user) {
            return redirect()->to('/home');
        }

        return view('admin/edit_user', ['user' => $user]);
    }

    // 2. Save the Update
    public function saveUserUpdate($id)
    {
        $userModel = new \App\Models\UserModel();
        $username   = $this->request->getPost('username');
        $firstName  = $this->request->getPost('first_name');
        $lastName   = $this->request->getPost('last_name');
        $phone      = $this->request->getPost('phone');
        $email      = $this->request->getPost('email');

        // 1. BLANK CHECKS
        if (empty($username) || empty($firstName) || empty($phone) || empty($email)) {
            $f = empty($username) ? 'username' : (empty($firstName) ? 'first_name' : (empty($phone) ? 'phone' : 'email'));
            return $this->response->setJSON(['status' => 'error', 'field' => $f, 'message' => 'This field cannot be blank!']);
        }

        // 2. PHONE VALIDATION
        if (!is_numeric($phone) || strlen($phone) != 10) {
            return $this->response->setJSON(['status' => 'error', 'field' => 'phone', 'message' => 'Phone must be exactly 10 digits!']);
        }

        // 3. EMAIL FORMAT
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON(['status' => 'error', 'field' => 'email', 'message' => 'Invalid email format!']);
        }

        // 4. DOMAIN CHECK
        $domain = substr(strrchr($email, "@"), 1);
        if (!@checkdnsrr($domain, "MX")) {
            return $this->response->setJSON(['status' => 'error', 'field' => 'email', 'message' => 'Email domain is invalid!']);
        }

        // 5. UNIQUE CHECK
        $existing = $userModel->where('email', $email)->where('id !=', $id)->first();
        if ($existing) {
            return $this->response->setJSON(['status' => 'error', 'field' => 'email', 'message' => 'Email is already in use by someone else!']);
        }

        // SAVE CHANGES
        $userModel->update($id, [
            'username'   => $username,
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'phone'      => $phone,
            'email'      => $email
        ]);

        // Sync session if the logged-in user edited THEIR OWN profile
        if ($id == session()->get('user_id')) {
            session()->set('username', $username);
        }

        return $this->response->setJSON([
            'status'   => 'success',
            'redirect' => site_url('home')
        ]);
    }

    // 3. Admin Delete
    public function deleteUser($id)
    {
        $userModel = new \App\Models\UserModel();
        $userModel->delete($id);
        
        return redirect()->to('/home/userList');
    }

    public function viewTemplate($page)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if the file exists before trying to load it
        if (!file_exists(APPPATH . 'Views/admin/' . $page . '.php')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/' . $page);
    }
}
