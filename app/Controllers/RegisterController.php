<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('register', ['title' => 'Cadastro de Usuário']);
    }

    public function store()
    {
        $userModel = new UserModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'  => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'cpf' => 'required|exact_length[14]|is_unique[users.cpf]|is_cpf',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('register', [
                'title' => 'Cadastro de Usuário',
                'errors' => $validation->getErrors(),
            ]);
        }

        $userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'cpf' => preg_replace('/[^0-9]/', '', $this->request->getPost('cpf')),
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->to('/register')->with('success', 'Usuário cadastrado com sucesso!');
    }
}