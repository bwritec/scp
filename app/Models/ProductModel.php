<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class ProductModel extends Model
    {
        /**
         *
         */
        protected $table = 'products';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'user_id',
            'name',
            'conditions',
            'description',
            'amount',
            'price',
            'demonstration',
            'paused',
            'created_at'
        ];
    }
