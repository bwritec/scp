<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class FavoriteModel extends Model
    {
        /**
         *
         */
        protected $table = 'favorites';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'user_id',
            'product_id'
        ];

        /**
         *
         */
        protected $returnType = 'array';

        /**
         *
         */
        protected $useTimestamps = false;

        /**
         *
         */
        public function isFavorited($userId, $productId)
        {
            return $this->where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first() !== null;
        }
    }
