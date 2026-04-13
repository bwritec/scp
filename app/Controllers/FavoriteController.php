<?php

    namespace App\Controllers;

    use App\Models\FavoriteModel;
    use CodeIgniter\RESTful\ResourceController;


    /**
     *
     */
    class FavoriteController extends BaseController
    {
        /**
         *
         */
        protected $favoriteModel;

        /**
         *
         */
        public function __construct()
        {
            $this->favoriteModel = new FavoriteModel();
        }

        /**
         * Adiciona aos favoritos
         */
        public function add()
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            $userId    = $this->request->getPost('user_id');
            $productId = $this->request->getPost('product_id');

            // Evitar duplicado
            $exists = $this->favoriteModel
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($exists) {
                return $this->respond([
                    'message' => 'Produto já está favoritado.'
                ]);
            }

            $this->favoriteModel->insert([
                'user_id'    => $userId,
                'product_id' => $productId
            ]);

            return redirect()->back();
        }

        /**
         * Remove dos favoritos
         */
        public function remove()
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            $userId    = $this->request->getPost('user_id');
            $productId = $this->request->getPost('product_id');

            $favorite = $this->favoriteModel
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if (!$favorite)
            {
                return $this->failNotFound('Favorito não encontrado.');
            }

            $this->favoriteModel->delete($favorite['id']);

            return redirect()->back();
        }

        /**
         * Lista favoritos do usuário
         */
        public function list()
        {
            $user = session()->get('user');

            if (!$user)
            {
                return redirect()->to('/login');
            }

            /**
             * ou outra forma.
             */
            $userId = $user["id"];

            $favoritesModel = new \App\Models\FavoriteModel();
            $productsModel  = new \App\Models\ProductModel();
            $thumbnailModel = new \App\Models\ProductThumbnailModel();

            /**
             * 1. Buscar todos os favoritos do usuário.
             */
            $favorites = $favoritesModel
                            ->where('user_id', $userId)
                            ->findAll();

            $products = [];

            /**
             * 2. Para cada favorito, buscar produto + thumbnail
             */
            foreach ($favorites as $fav)
            {
                $product = $productsModel->find($fav['product_id']);

                if ($product)
                {
                    $thumbnail = $thumbnailModel
                        ->where('product_id', $fav['product_id'])
                        ->first();

                    /**
                     * Calcula a taxa da aplicação.
                     */
                    $env = env('app.rate');
                    $taxa = (float) $env ?: 0;
                    $price = $product['price'];
                    $price = str_replace(",", ".", $price);
                    $price_final = $price + ($price * ($taxa / 100));

                    /**
                     * Criar estrutura combinada
                     */
                    $products[] = [
                        'id'        => $product['id'],
                        'name'      => $product['name'],
                        'price'     => $price_final,
                        'thumbnail' => $thumbnail['name'] ?? null,
                    ];
                }
            }

            return view('dashboard/favorites', [
                'title' => 'Favoritos',
                'favorites' => $products
            ]);
        }
    }