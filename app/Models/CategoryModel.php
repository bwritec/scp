<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class CategoryModel extends Model
    {
        /**
         *
         */
        protected $table = 'categories';

        /**
         *
         */
        protected $primaryKey = 'id';

        /**
         *
         */
        protected $allowedFields = [
            'parent',
            'name',
            'slogan',
            'description'
        ];

        /**
         *
         */
        protected $useTimestamps = false;

        /**
         *
         */
        public function getAll()
        {
            return $this->select('c1.*, c2.name as parent_name')
                        ->from('categories c1')
                        ->join('categories c2', 'c2.id = c1.parent', 'left')
                        ->orderBy('c1.id', 'DESC')
                        ->findAll();
        }

        /**
         *
         */
        public function getParents()
        {
            return $this->where('parent', null)->findAll();
        }

        /**
         *
         */
        public function getPaginated($perPage = 10)
        {
            return $this->select('c1.*, c2.name as parent_name')
                        ->from('categories c1')
                        ->join('categories c2', 'c2.id = c1.parent', 'left')
                        ->orderBy('c1.id', 'DESC')
                        ->paginate($perPage);
        }
    }
