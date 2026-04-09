<?php

    use CodeIgniter\Boot;
    use Config\Paths;


    /**
     * CHECK PHP VERSION
     */

    /**
     * Se você atualizar isso, não se esqueça de atualizar
     * também o `spark`.
     */
    $minPhpVersion = '8.2';

    if (version_compare(PHP_VERSION, $minPhpVersion, '<'))
    {
        $message = sprintf(
            'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
            $minPhpVersion,
            PHP_VERSION,
        );

        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo $message;

        exit(1);
    }

    /**
     * Caminho do .env (ajuste se necessário)
     */
    $envPath = dirname(__DIR__) . '/.env';

    /**
     * Se não existir .env, redireciona para install.php
     */
    if (!file_exists($envPath))
    {
        header('Location: install.php');
        exit;
    }

    /**
     * SET THE CURRENT DIRECTORY
     */

    /**
     * Caminho para o controller frontal (este arquivo)
     */
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

    /**
     * Certifique-se de que o diretório atual esteja apontando
     * para o diretório do controller frontal.
     */
    if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
        chdir(FCPATH);
    }

    /**
     *---------------------------------------------------------------
     * BOOTSTRAP THE APPLICATION
     *---------------------------------------------------------------
     * Este processo configura as constantes de caminho, carrega
     * e registra nosso autoloader, juntamente com o do Composer,
     * carrega nossas constantes e inicia uma inicialização
     * específica do ambiente.
     */

    /**
     * LOAD OUR PATHS CONFIG FILE
     * Essa é a linha que pode precisar ser alterada, dependendo
     * da sua estrutura de pastas.
     */
    require FCPATH . '../app/Config/Paths.php';
    // ^^^ Altere esta linha se você mover a pasta do seu aplicativo.

    $paths = new Paths();

    /**
     * LOAD THE FRAMEWORK BOOTSTRAP FILE
     */
    require $paths->systemDirectory . '/Boot.php';

    exit(Boot::bootWeb($paths));
