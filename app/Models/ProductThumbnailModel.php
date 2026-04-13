<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class ProductThumbnailModel extends Model
    {
        /**
         *
         */
        protected $table = 'product_thumbnails';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'user_id',
            'product_id',
            'name'
        ];
    }
