<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class LinkModel extends Model
    {
        /**
         *
         */
        protected $table = 'links';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'name',
            'url',
            'open_in_new_window'
        ];
    }
