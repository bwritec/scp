<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\CategoryModel;
use App\Models\LinkModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * A lista de categorias do site.
     */
    protected $global_categories;

    /**
     * A lista de links do site.
     */
    protected $global_links;

    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        /**
         * Chama o helper
         */
        helper('category');

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');

        /**
         * Adicionar links ao menu do site.
         */
        $linkModel = new LinkModel();
        $this->global_links = $linkModel->orderBy('id', 'ASC')->findAll();

        /**
         * Adicionar categorias ao menu dropdown
         * do site.
         */
        $categories = new CategoryModel();
        $allCategories = $categories->orderBy('name', 'ASC')->findAll();

        /**
         * monta árvore de categorias (pai > filhos)
         */
        $this->global_categories = build_category_tree($allCategories);

        /**
         * --- disponibiliza 'categories' para todas as views ---
         * use o service 'renderer' em vez de view() sem parâmetros
         */
        $renderer = \Config\Services::renderer();

        /**
         * setData mantém/mescla dados compartilhados para as views
         * (setData espera um array associativo)
         */
        $renderer->setData([
            'global_categories' => $this->global_categories,
            'global_links' => $this->global_links
        ]);
    }
}
