<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    /**
     *
     */
    public function index()
    {
        /**
         * Se já estiver logado, redireciona
         */
        if (session()->get('user'))
        {
            return redirect()->to('/dashboard');
        }

        return view('login', ['title' => 'Login']);
    }

    /**
     *
     */
    public function auth()
    {
        /**
         * Se já estiver logado, redireciona
         */
        if (session()->get('user'))
        {
            return redirect()->to('/dashboard');
        }

        helper(['form']);
        $session    = session();
        $validation = \Config\Services::validation();
        $userModel  = new UserModel();

        $validation->setRules([
            'cpf'      => 'required|is_cpf',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run())
        {
            return view('login', [
                'title'  => 'Login',
                'errors' => $validation->getErrors()
            ]);
        }

        $cpf  = $this->request->getPost('cpf');
        $pass = $this->request->getPost('password');

        $user = $userModel->getByCpf($cpf);

        if (!$user || !password_verify($pass, $user['password']))
        {
            return view('login', [
                'title'  => 'Login',
                'errors' => [
                    'login' => 'CPF ou senha inválidos.'
                ]
            ]);
        }

        /**
         * cria sessão.
         */
        $session->set('user', [
            'id'   => $user['id'],
            'name' => $user['name'],
            'cpf'  => $user['cpf'],
            'email' => $user['email'],
            'admin' => $user['admin'] // 1 ou 0
        ]);

        return redirect()->to('/dashboard');
    }

    /**
     *
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}