<?php

namespace App\Controllers;

use App\Models\PhoneModel;
use CodeIgniter\Controller;

class PhoneController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');

        if (!$user) {
            return redirect()->to('/login');
        }

        $phoneModel = new PhoneModel();
        $phone = $phoneModel->getByUserId($user['id']);

        return view('dashboard/contact', [
            'title' => 'Atualizar Telefone',
            'user'  => $user,
            'phone' => $phone ? $phone['phone'] : ''
        ]);
    }

    public function save()
    {
        helper(['form']);
        $user = session()->get('user');

        if (!$user) {
            return redirect()->to('/login');
        }

        /**
         * Limpa o telefone antes da validação.
         */
        $rawPhone = $this->request->getPost('phone');

        /**
         * remove tudo que não for número.
         */
        $cleanPhone = preg_replace('/\D/', '', $rawPhone);

        /**
         * substitui o valor na request (para a validação
         * usar o número limpo).
         */
        $this->request->setGlobal('post', ['phone' => $cleanPhone]);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'phone' => [
                'label' => 'Telefone',
                'rules' => 'required|regex_match[/^[0-9]{10,12}$/]',
                'errors' => [
                    'required' => 'Informe o número de telefone.',
                    'regex_match' => 'Formato de telefone inválido (use apenas números, DDD + número).'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('dashboard/contact', [
                'title' => 'Atualizar Telefone',
                'user'  => $user,
                'errors' => $validation->getErrors(),
                'phone'  => $this->request->getPost('phone')
            ]);
        }

        $phoneModel = new PhoneModel();
        $phone = preg_replace('/\D/', '', $this->request->getPost('phone')); // limpa máscara

        $phoneModel->saveOrUpdate($user['id'], $phone);

        return redirect()->to('/dashboard/contact')->with('success', 'Telefone atualizado com sucesso!');
    }
}