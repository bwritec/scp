<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasswordResetModel;
use CodeIgniter\Controller;

class PasswordController extends BaseController
{
    public function forgot()
    {
        return view('auth/forgot', ['title' => 'Recuperar senha']);
    }

    public function sendResetLink()
    {
        helper(['form']);
        $email = $this->request->getPost('email');

        $userModel = new UserModel();
        $resetModel = new PasswordResetModel();

        $user = $userModel->where('email', $email)->first();

        if (!$user)
        {
            return view('auth/forgot', [
                'title' => 'Recuperar senha',
                'error' => 'E-mail não encontrado.'
            ]);
        }

        $token = $resetModel->createToken($email);
        $resetLink = site_url('reset/' . $token);

        /**
         * Envia o e-mail
         */
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Redefinição de senha');
        $emailService->setMessage("
            Olá {$user['name']},<br><br>
            Clique no link abaixo para redefinir sua senha:<br>
            <a href='{$resetLink}'>{$resetLink}</a><br><br>
            Se você não solicitou, ignore este e-mail.
        ");
        $emailService->send();

        return view('auth/forgot', [
            'title' => 'Recuperar senha',
            'success' => 'Enviamos um link para seu e-mail.'
        ]);
    }

    public function reset($token)
    {
        $resetModel = new PasswordResetModel();
        $reset = $resetModel->getByToken($token);

        if (!$reset)
        {
            return redirect()->to('/forgot')->with('error', 'Token inválido ou expirado.');
        }

        return view('auth/reset', [
            'title' => 'Redefinir senha',
            'token' => $token
        ]);
    }

    public function updatePassword()
    {
        helper(['form']);
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $resetModel = new PasswordResetModel();
        $userModel  = new UserModel();

        $reset = $resetModel->getByToken($token);

        if (!$reset)
        {
            return redirect()->to('/forgot')->with('error', 'Token inválido.');
        }

        if (strlen($password) < 6)
        {
            return view('auth/reset', [
                'title' => 'Redefinir senha',
                'token' => $token,
                'error' => 'A senha deve ter pelo menos 6 caracteres.'
            ]);
        }

        $userModel->where('email', $reset['email'])
                  ->set('password', password_hash($password, PASSWORD_DEFAULT))
                  ->update();

        $resetModel->deleteToken($token);

        return redirect()->to('/login')->with('success', 'Senha alterada com sucesso!');
    }
}
