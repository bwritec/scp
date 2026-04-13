<?php

    namespace App\Controllers;

    use App\Models\AddressModel;
    use CodeIgniter\Controller;


    /**
     *
     */
    class AddressController extends BaseController
    {
        /**
         *
         */
        public function index()
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            $addressModel = new AddressModel();
            $address = $addressModel->getByUserId($user['id']);

            return view('dashboard/address', [
                'title'   => 'Meu Endereço',
                'user'    => $user,
                'address' => $address ?? []
            ]);
        }

        /**
         *
         */
        public function save()
        {
            helper(['form']);
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            /**
             * Limpa o CEP antes da validação.
             */
            $rawCep = $this->request->getPost('cep');
            $cleanCep = preg_replace('/\D/', '', $rawCep);

            /**
             * substitui na request (para validar o valor limpo).
             */
            $this->request->setGlobal('post', array_merge($this->request->getPost(), ['cep' => $cleanCep]));

            /**
             * Validação.
             */
            $validation = \Config\Services::validation();
            $validation->setRules([
                'address' => 'required|min_length[3]',
                'neighborhood' => 'required|min_length[3]',
                'city' => 'required|min_length[2]',
                'state' => 'required|min_length[2]|max_length[2]',
                'cep' => 'required|regex_match[/^[0-9]{8}$/]',
            ], [
                'address' => ['required' => 'Informe o endereço.'],
                'neighborhood' => ['required' => 'Informe o bairro.'],
                'city' => ['required' => 'Informe a cidade.'],
                'state' => [
                    'required' => 'Informe o estado (UF).',
                    'max_length' => 'Use apenas a sigla do estado (ex: RS).'
                ],
                'cep' => [
                    'required' => 'Informe o CEP.',
                    'regex_match' => 'CEP inválido (use apenas números).'
                ]
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return view('dashboard/address', [
                    'title' => 'Meu Endereço',
                    'user' => $user,
                    'errors' => $validation->getErrors(),
                    'address' => $this->request->getPost()
                ]);
            }

            /**
             * Salva ou atualiza.
             */
            $addressModel = new AddressModel();
            $addressModel->saveOrUpdate($user['id'], [
                'address' => $this->request->getPost('address'),
                'neighborhood' => $this->request->getPost('neighborhood'),
                'city' => $this->request->getPost('city'),
                'state' => strtoupper($this->request->getPost('state')),
                'cep' => $cleanCep,
            ]);

            return redirect()->to('/dashboard/address')->with('success', 'Endereço salvo com sucesso!');
        }
    }
