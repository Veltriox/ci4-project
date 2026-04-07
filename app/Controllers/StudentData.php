<?php

namespace App\Controllers;

use App\Models\UserModel; // Assuming you have a UserModel for students

class StudentData extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // We will fetch all users who are 'Students'
        // If you don't have a UserModel yet, I will help you create one
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $query = $builder->get();
        $students = $query->getResultArray();

        $data = [
            'students' => $students,
            'title'    => 'Student Data Table'
        ];

        return view('admin/student_list', $data);
    }
}
