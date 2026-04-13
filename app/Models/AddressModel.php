<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class AddressModel extends Model
    {
        /**
         *
         */
        protected $table = 'addresses';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'user_id',
            'address',
            'neighborhood',
            'city',
            'state',
            'cep'
        ];

        /**
         *
         */
        protected $returnType = 'array';

        /**
         *
         */
        public function getByUserId($userId)
        {
            return $this->where('user_id', $userId)->first();
        }

        /**
         *
         */
        public function saveOrUpdate($userId, $data)
        {
            $existing = $this->getByUserId($userId);

            if ($existing)
            {
                $this->update($existing['id'], $data);
            } else
            {
                $data['user_id'] = $userId;
                $this->insert($data);
            }
        }
    }
