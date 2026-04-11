<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class UserModel extends Model
    {
        /**
         *
         */
        protected $table = 'users';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $useAutoIncrement = true;

        /**
         *
         */
        protected $returnType = 'array';

        /**
         *
         */
        protected $allowedFields = [
            'name',
            'email',
            'cpf',
            'admin',
            'password',
            'created_at'
        ];

        /**
         *
         */
        protected $useTimestamps = false;

        /**
         * Antes de inserir, encripta a senha.
         */
        protected $beforeInsert = [
            'hashPassword'
        ];

        /**
         *
         */
        protected function hashPassword(array $data)
        {
            if (!isset($data['data']['password']))
            {
                return $data;
            }

            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            return $data;
        }

        /**
         *
         */
        public function getByCpf(string $cpf)
        {
            /**
             * remove pontos e traço
             */
            $cpf = preg_replace('/[^0-9]/', '', $cpf);

            return $this->where('cpf', $cpf)->first();
        }
    }
