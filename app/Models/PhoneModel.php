<?php

    namespace App\Models;

    use CodeIgniter\Model;

    /**
     *
     */
    class PhoneModel extends Model
    {
        /**
         *
         */
        protected $table = 'phones';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'user_id',
            'phone'
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
        public function saveOrUpdate($userId, $phone)
        {
            $existing = $this->getByUserId($userId);

            if ($existing)
            {
                $this->update($existing['id'], ['phone' => $phone]);
            } else
            {
                $this->insert(['user_id' => $userId, 'phone' => $phone]);
            }
        }
    }
