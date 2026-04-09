<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    /**
     * Caminho do .env (ajuste se necessário)
     */
    $envPath = dirname(__DIR__) . '/.env';

    /**
     * Se não existir .env, redireciona para install.php
     */
    if (file_exists($envPath))
    {
        header('Location: index.php');
        exit;
    }

    /**
     * Valida sé o campo está vazio.
     * 
     * @param $key string | Nome do campo.
     * @return bool
     */
    function is_empty($key)
    {
        /**
         * Questão: A chave $key foi enviado nesse form ?
         */
        if (array_key_exists($key, $_POST))
        {
            /**
             * Obtem o valor de $key.
             */
            $value = $_POST[$key];

            /**
             * Limpa espaços em branco.
             */
            $value = trim($value);

            /**
             * Faz a validação.
             */
            return strlen($value) == 0;
        }

        /**
         * Devolve um false.
         */
        return false;
    }

    /**
     * Alterar um valor de uma chave .env
     * 
     * Exemplo:
     *     setEnvValue("app.name", "kwrite");
     *     setEnvValue("app.rate", "25");
     */
    function setEnvValue($key, $value)
    {
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . ".env";

        if (!file_exists($path))
        {
            return false;
        }

        $value = trim($value);

        $env = file_get_contents($path);

        /**
         * Filtros.
         */
        $env = str_replace("\t", " ", $env);
        $env = str_replace("  ", " ", $env);
        $env = str_replace(" =", "=", $env);
        $env = str_replace("= ", "=", $env);

        /**
         * Verifica se já existe.
         */
        if (preg_match("/^{$key}=.*/m", $env))
        {
            /**
             * Substitui a linha completa.
             */
            $env = preg_replace(
                "/^{$key}=.*/m",
                "{$key}=\"{$value}\"",
                $env
            );
        } else
        {
            /**
             * Adiciona ao final.
             */
            $env .= "\n{$key}=\"{$value}\"";
        }

        /**
         * Salva de volta
         */
        // file_put_contents($path, $env);

        $f = fopen($path, 'w');
        if ($f === false)
        {
            die('Erro ao abrir o arquivo');
        }

        fwrite($f, $env);
        fclose($f);

        return true;
    }

    /**
     * Variável com erros de formulário.
     */
    $errors = array();

    /**
     * Questão: é um envio de formulário ?
     */
    if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST")
    {
        /**
         * Questão: a variável de passo existe ?
         */
        if (array_key_exists("step", $_GET))
        {
            /**
             * Passo 1.
             */
            if ($_GET["step"] == "1")
            {
                /**
                 * Validação.
                 */
                if (is_empty("app_name"))
                {
                    if (!array_key_exists("app_name", $errors))
                    {
                        $errors["app_name"] = array();
                    }

                    array_push($errors["app_name"], "Você deve preencher esse campo.");
                }

                if (is_empty("app_url"))
                {
                    if (!array_key_exists("app_url", $errors))
                    {
                        $errors["app_url"] = array();
                    }

                    array_push($errors["app_url"], "Você deve preencher esse campo.");
                }

                if (is_empty("app_rate"))
                {
                    if (!array_key_exists("app_rate", $errors))
                    {
                        $errors["app_rate"] = array();
                    }

                    array_push($errors["app_rate"], "Você deve preencher esse campo.");
                }

                if (is_empty("database_hostname"))
                {
                    if (!array_key_exists("database_hostname", $errors))
                    {
                        $errors["database_hostname"] = array();
                    }

                    array_push($errors["database_hostname"], "Você deve preencher esse campo.");
                }

                if (is_empty("database_port"))
                {
                    if (!array_key_exists("database_port", $errors))
                    {
                        $errors["database_port"] = array();
                    }

                    array_push($errors["database_port"], "Você deve preencher esse campo.");
                }

                if (is_empty("database_name"))
                {
                    if (!array_key_exists("database_name", $errors))
                    {
                        $errors["database_name"] = array();
                    }

                    array_push($errors["database_name"], "Você deve preencher esse campo.");
                }

                if (is_empty("database_username"))
                {
                    if (!array_key_exists("database_username", $errors))
                    {
                        $errors["database_username"] = array();
                    }

                    array_push($errors["database_username"], "Você deve preencher esse campo.");
                }

                if (is_empty("database_password"))
                {
                    if (!array_key_exists("database_password", $errors))
                    {
                        $errors["database_password"] = array();
                    }

                    array_push($errors["database_password"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_from_email"))
                {
                    if (!array_key_exists("email_from_email", $errors))
                    {
                        $errors["email_from_email"] = array();
                    }

                    array_push($errors["email_from_email"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_from_name"))
                {
                    if (!array_key_exists("email_from_name", $errors))
                    {
                        $errors["email_from_name"] = array();
                    }

                    array_push($errors["email_from_name"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_protocol"))
                {
                    if (!array_key_exists("email_protocol", $errors))
                    {
                        $errors["email_protocol"] = array();
                    }

                    array_push($errors["email_protocol"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_host"))
                {
                    if (!array_key_exists("email_host", $errors))
                    {
                        $errors["email_host"] = array();
                    }

                    array_push($errors["email_host"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_user"))
                {
                    if (!array_key_exists("email_user", $errors))
                    {
                        $errors["email_user"] = array();
                    }

                    array_push($errors["email_user"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_password"))
                {
                    if (!array_key_exists("email_password", $errors))
                    {
                        $errors["email_password"] = array();
                    }

                    array_push($errors["email_password"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_port"))
                {
                    if (!array_key_exists("email_port", $errors))
                    {
                        $errors["email_port"] = array();
                    }

                    array_push($errors["email_port"], "Você deve preencher esse campo.");
                }

                if (is_empty("email_crypto"))
                {
                    if (!array_key_exists("email_crypto", $errors))
                    {
                        $errors["email_crypto"] = array();
                    }

                    array_push($errors["email_crypto"], "Você deve preencher esse campo.");
                }

                if (is_empty("token_melhorenvio"))
                {
                    if (!array_key_exists("token_melhorenvio", $errors))
                    {
                        $errors["token_melhorenvio"] = array();
                    }

                    array_push($errors["token_melhorenvio"], "Você deve preencher esse campo.");
                }

                if (is_empty("environment"))
                {
                    if (!array_key_exists("environment", $errors))
                    {
                        $errors["environment"] = array();
                    }

                    array_push($errors["environment"], "Você deve preencher esse campo.");
                }

                /**
                 * Questão: Existe errors no formulário ?
                 */
                if (count($errors) == 0)
                {
                    /**
                     * Vamos salvar a env.
                     */

                    /**
                     * Primeiramente vamos cópiar o arquivo .env.sample
                     * para .env
                     */
                    file_put_contents(
                        dirname(__DIR__) . DIRECTORY_SEPARATOR . ".env",
                        file_get_contents(
                            dirname(__DIR__) . DIRECTORY_SEPARATOR . ".env.sample"
                        )
                    );

                    /**
                     * App.
                     */
                    setEnvValue("app.name", $_POST["app_name"]);
                    setEnvValue("app.baseURL", $_POST["app_url"]);
                    setEnvValue("app.rate", $_POST["app_rate"]);

                    /**
                     * Database.
                     */
                    setEnvValue("database.default.hostname", $_POST["database_hostname"]);
                    setEnvValue("database.default.port", $_POST["database_port"]);
                    setEnvValue("database.default.database", $_POST["database_name"]);
                    setEnvValue("database.default.username", $_POST["database_username"]);
                    setEnvValue("database.default.password", $_POST["database_password"]);

                    /**
                     * Email.
                     */
                    setEnvValue("email.fromEmail", $_POST["email_from_email"]);
                    setEnvValue("email.fromName", $_POST["email_from_name"]);
                    setEnvValue("email.protocol", $_POST["email_protocol"]);
                    setEnvValue("email.SMTPHost", $_POST["email_host"]);
                    setEnvValue("email.SMTPUser", $_POST["email_user"]);
                    setEnvValue("email.SMTPPass", $_POST["email_password"]);
                    setEnvValue("email.SMTPPort", $_POST["email_port"]);
                    setEnvValue("email.SMTPCrypto", $_POST["email_crypto"]);

                    if (strlen(trim($_POST["email_protocol"])) == 0)
                    {
                        setEnvValue("email.protocol", "smtp");
                    }

                    /**
                     * Token.
                     */
                    setEnvValue("melhorenvio.token", $_POST["token_melhorenvio"]);

                    /**
                     * Others.
                     */
                    setEnvValue("CI_ENVIRONMENT", $_POST["environment"]);

                    /**
                     * Vamos redirecionar a página.
                     */
                    header('Location: /index.php');
                    exit;
                }
            }
        }
    }

    /**
     * Extensões do sistema
     */
    $extensions = array(
        /**
         * Para conexões com api's.
         */
        "curl",

        /**
         * Para tradução do sistema.
         */
        "intl",

        /**
         * Para extrair e compactar arquivos.
         */
        "zip",

        /**
         * Para banco de dados, deve existir ou um
         * ou outro.
         */
        "mysql" => array(
            "mysqli",
            "pdo_mysql"
        ),
    );

    /**
     * Permissões do sistema.
     */
    $permissions = array(
        /**
         * /
         */
        dirname(__DIR__) => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        ),

        /**
         * Writable
         */
        "writable" => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        ),

        /**
         * Cache
         */
        "writable/cache" => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        ),

        /**
         * debugbar
         */
        "writable/debugbar" => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        ),

        /**
         * Logs
         */
        "writable/logs" => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        ),

        /**
         * Session
         */
        "writable/session" => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        ),

        /**
         * Uploads
         */
        "writable/uploads" => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        ),

        /**
         * Photos
         */
        "public/dist/photos" => array(
            /**
             * Sem permissão de leitura.
             */
            "read" => false,

            /**
             * Sem permissão de escrita.
             */
            "write" => false
        )
    );

    /**
     * Vamos correr as permissões.
     */
    foreach ($permissions as $folder => $permission)
    {
        if ($folder == dirname(__DIR__))
        {
            if (is_readable($folder))
            {
                $permissions[$folder]["read"] = true;
            }

            if (is_writable($folder))
            {
                $permissions[$folder]["write"] = true;
            }
        } else
        {
            if (is_readable(dirname(__DIR__) . DIRECTORY_SEPARATOR . $folder))
            {
                $permissions[$folder]["read"] = true;
            }

            if (is_writable(dirname(__DIR__) . DIRECTORY_SEPARATOR . $folder))
            {
                $permissions[$folder]["write"] = true;
            }
        }
    }

    /**
     * Questão: O sistema tem permissão de leitura e gravação.
     */
    $have_permissions = true;

    foreach ($permissions as $folder => $permission)
    {
        foreach ($permission as $key => $value)
        {
            if (!$value)
            {
                $have_permissions = false;
            }
        }
    }

    $have_extensions = true;

    /**
     * Vamos correr as extensões.
     */
    foreach ($extensions as $key => $extension)
    {
        if ($key == "mysql")
        {
            if (!extension_loaded($extension[0]) && !extension_loaded($extension[1]))
            {
                $have_extensions = false;
            }

            /**
             * Pule para o proximo.
             */
            continue;
        }

        if (!extension_loaded($extension))
        {
            $have_extensions = false;
        }
    }


?>
<!DOCTYPE html>
<html>
<head>

    <!--
      - Charset.
     -->
    <meta charset="utf-8">

    <!--
      - Viewport.
     -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--
      - Título.
     -->
    <title>Kwrite Installer</title>

    <!--
      - Estilos.
     -->
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap-5.3.7.css">
    <link rel="stylesheet" type="text/css" href="dist/css/fontawesome-7.0.0.css">

    <!--
      - Scripts.
     -->
    <script type="text/javascript" src="dist/js/bootstrap.bundle-5.3.7.js"></script>

    <!--
      - Refresh
     -->
    <?php if (!$have_permissions): ?>
        <meta http-equiv="refresh" content="15">
    <?php endif; ?>

    <?php if (!$have_extensions): ?>
        <meta http-equiv="refresh" content="15">
    <?php endif; ?>

</head>
<body>

    <div style="text-align: center;" class="mt-5 mb-3">
        <img src="dist/img/logo.png" style="width: 75px; height: 75px;">
    </div>


    <?php if (!$have_extensions): ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger">
                                Você deve ativar as extensões do php.
                            </div>

                            <strong>
                                Extensões
                            </strong>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Extensão</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($extensions as $key => $extension): ?>
                                        <?php if ($key == "mysql"): ?>
                                            <?php foreach ($extension as $value): ?>
                                                <tr>
                                                    <th>
                                                        <?= $value; ?>
                                                    </th>

                                                    <td>
                                                        <?= extension_loaded($value) == 1 ? '<span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-check"></i></span>' : '<span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-xmark"></i></span>'; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>

                                            <?php continue; ?>
                                        <?php endif; ?>

                                        <tr>
                                            <th>
                                                <?= $extension; ?>
                                            </th>

                                            <td>
                                                <?= extension_loaded($extension) == 1 ? '<span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-check"></i></span>' : '<span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-xmark"></i></span>'; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php if (!$have_permissions): ?>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-danger">
                                    Sem permissão de arquivos
                                </div>

                                <strong>
                                    Permissões
                                </strong>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Pasta</th>
                                            <th scope="col">Leitura</th>
                                            <th scope="col">Gravação</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($permissions as $folder => $permission): ?>
                                            <tr>
                                                <th>
                                                    <?= $folder ?>
                                                </th>

                                                <td>
                                                    <?= $permission["read"] == 1 ? '<span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-check"></i></span>' : '<span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-xmark"></i></span>'; ?>
                                                </td>

                                                <td>
                                                    <?= $permission["write"] == 1 ? '<span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-check"></i></span>' : '<span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-xmark"></i></span>'; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php if (array_key_exists("step", $_GET)): ?>
                <?php if ($_GET["step"] == "1"): ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-8 offset-md-2">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="/install.php?step=1" method="POST">
                                            <!--
                                              - Nav tabs
                                             -->
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="app-tab" data-bs-toggle="tab" data-bs-target="#app" type="button" role="tab">
                                                        App
                                                    </button>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="database-tab" data-bs-toggle="tab" data-bs-target="#database" type="button" role="tab">
                                                        Database
                                                    </button>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab">
                                                        Email
                                                    </button>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="token-tab" data-bs-toggle="tab" data-bs-target="#token" type="button" role="tab">
                                                        Token
                                                    </button>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="others-tab" data-bs-toggle="tab" data-bs-target="#others" type="button" role="tab">
                                                        Outros
                                                    </button>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-3" id="myTabContent">
                                                <div class="tab-pane fade show active" id="app" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label for="app_name" class="form-label">
                                                            Nome do site
                                                        </label>

                                                        <input type="text" name="app_name" id="app_name" class="form-control">

                                                        <?php if (array_key_exists("app_name", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["app_name"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="app_url" class="form-label">
                                                            URL
                                                        </label>

                                                        <input type="text" name="app_url" id="app_url" class="form-control">

                                                        <?php if (array_key_exists("app_url", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["app_url"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="app_rate" class="form-label">
                                                            Taxa do site
                                                        </label>

                                                        <div class="input-group mb-3">
                                                            <input type="text" name="app_rate" id="app_rate" class="form-control">

                                                            <span class="input-group-text">
                                                                %
                                                            </span>
                                                        </div>

                                                        <?php if (array_key_exists("app_rate", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["app_rate"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="database" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label for="database_hostname" class="form-label">
                                                            Hostname
                                                        </label>

                                                        <input type="text" name="database_hostname" id="database_hostname" class="form-control">

                                                        <?php if (array_key_exists("database_hostname", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["database_hostname"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="database_port" class="form-label">
                                                            Porta
                                                        </label>

                                                        <input type="text" name="database_port" id="database_port" class="form-control">

                                                        <?php if (array_key_exists("database_port", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["database_port"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="database_name" class="form-label">
                                                            Nome do banco de dados
                                                        </label>

                                                        <input type="text" name="database_name" id="database_name" class="form-control">

                                                        <?php if (array_key_exists("database_name", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["database_name"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="database_username" class="form-label">
                                                            Usuário
                                                        </label>

                                                        <input type="text" name="database_username" id="database_username" class="form-control">

                                                        <?php if (array_key_exists("database_username", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["database_username"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="database_password" class="form-label">
                                                            Senha
                                                        </label>

                                                        <input type="text" name="database_password" id="database_password" class="form-control">

                                                        <?php if (array_key_exists("database_password", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["database_password"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="email" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label for="email_from_email" class="form-label">
                                                            Do Email
                                                        </label>

                                                        <input type="text" name="email_from_email" id="email_from_email" class="form-control" placeholder="nao-responder@kwrite.com.br">

                                                        <?php if (array_key_exists("email_from_email", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_from_email"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email_from_name" class="form-label">
                                                            Do Nome
                                                        </label>

                                                        <input type="text" name="email_from_name" id="email_from_name" class="form-control" placeholder="Kwrite">

                                                        <?php if (array_key_exists("email_from_name", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_from_name"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email_protocol" class="form-label">
                                                            Protocolo
                                                        </label>

                                                        <input type="text" name="email_protocol" id="email_protocol" class="form-control" value="smtp" disabled>

                                                        <?php if (array_key_exists("email_protocol", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_protocol"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email_host" class="form-label">
                                                            Host
                                                        </label>

                                                        <input type="text" name="email_host" id="email_host" class="form-control">

                                                        <?php if (array_key_exists("email_host", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_host"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email_user" class="form-label">
                                                            Usuário
                                                        </label>

                                                        <input type="text" name="email_user" id="email_user" class="form-control">

                                                        <?php if (array_key_exists("email_user", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_user"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email_password" class="form-label">
                                                            Senha
                                                        </label>

                                                        <input type="text" name="email_password" id="email_password" class="form-control">

                                                        <?php if (array_key_exists("email_password", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_password"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email_port" class="form-label">
                                                            Porta
                                                        </label>

                                                        <input type="text" name="email_port" id="email_port" class="form-control">

                                                        <?php if (array_key_exists("email_port", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_port"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email_crypto" class="form-label">
                                                            Criptografia
                                                        </label>

                                                        <input type="text" name="email_crypto" id="email_crypto" class="form-control" value="tls">

                                                        <?php if (array_key_exists("email_crypto", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["email_crypto"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="token" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label for="token_melhorenvio" class="form-label">
                                                            Melhor Envio
                                                        </label>

                                                        <textarea name="token_melhorenvio" id="token_melhorenvio" class="form-control"></textarea>

                                                        <?php if (array_key_exists("token_melhorenvio", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["token_melhorenvio"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="others" role="tabpanel">
                                                    <div class="mb-3">

                                                        <label class="form-label">
                                                            Ambiente
                                                        </label>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="environment" id="production" value="production" checked>

                                                            <label class="form-check-label" for="production">
                                                                Produção
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="environment" id="development" value="development">

                                                            <label class="form-check-label" for="development">
                                                                Desenvolvimento
                                                            </label>
                                                        </div>

                                                        <?php if (array_key_exists("environment", $errors)): ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                <?php foreach ($errors["environment"] as $value): ?>
                                                                    <?= $value; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-dark">
                                                Salvar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    Passo Desconhecido
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        Boas-vindas ao Kwrite. Antes de iniciar, você
                                        precisará conhecer os seguintes itens.
                                    </p>

                                    <ol>
                                        <li>Informações do banco de dados</li>
                                        <li>Informações do servidor smtp</li>
                                        <li>Informações da app</li>
                                        <li>Informações de tokens de serviços</li>
                                    </ol>

                                    <p>
                                        Esta informação está sendo usada para criar um arquivo
                                        <strong>.env</strong>. Se por algum motivo a criação
                                        automática deste arquivo não funcionar, não se preocupe.
                                        Tudo que isto faz é preencher as informações do banco de
                                        dados, smtp, app e token's de serviços em um arquivo de
                                        configuração. Você também pode simplesmente abrir
                                        <strong>.env.sample</strong> em um editor de texto,
                                        preencher suas informações e salvar como
                                        <strong>.env</strong>.
                                    </p>

                                    <p>
                                        Provavelmente esses itens foram fornecidos a você pela
                                        sua hospedagem. Se não tiver essa informação, então
                                        precisará entrar em contato com eles antes de continuar.
                                        Se estiver pronto…
                                    </p>

                                    <a href="/install.php?step=1" class="btn btn-outline-primary">
                                        Vamos lá!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
