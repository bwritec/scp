<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">
                    <?= esc($title) ?>
                </h1>

                <form action="<?= site_url('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">
                            CPF
                        </label>

                        <input type="text" name="cpf" id="cpf" maxlength="14" class="form-control <?= isset($errors['cpf']) ? 'is-invalid' : '' ?>" value="<?= old('cpf') ?>" placeholder="000.000.000-00">

                        <?php if (isset($errors['cpf'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['cpf']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Senha
                        </label>

                        <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">

                        <?php if (isset($errors['password'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['password']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-dark">
                        Entrar
                    </button>

                    <p class="mt-3">
                        <a href="<?= site_url('register') ?>">
                            Não tem uma conta ? Cadastre-se
                        </a>
                    </p>

                    <p class="mt-3">
                        <a href="<?= site_url('forgot') ?>">
                            Esqueci minha senha
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /**
     * máscara de CPF
     */
    document.getElementById('cpf').addEventListener('input', function (e)
    {
        let value = e.target.value.replace(/\D/g, '');

        if (value.length > 11)
        {
            value = value.slice(0, 11);
        }

        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    });
</script>
<?= $this->endSection() ?>