<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div class="content" style="margin-bottom: 61px;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 home-sidebar">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard">
                            Dashboard
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/favorites">
                            Favoritos
                        </a>
                    </li>
                </ul>

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/purchases">
                            Compras
                        </a>
                    </li>
                </ul>

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/address">
                            Endereço
                        </a>
                    </li>

                    <li class="list-group-item active">
                        <a href="<?= base_url() ?>index.php/dashboard/contact">
                            Contato
                        </a>
                    </li>
                </ul>

                <?php if (session()->has('user') && session('user.admin') === '1'): ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="<?= base_url() ?>index.php/dashboard/sell">
                                Vender
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= base_url() ?>index.php/dashboard/sales">
                                Vendas
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= base_url() ?>index.php/dashboard/products">
                                Anúncios
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= base_url() ?>index.php/dashboard/categories">
                                Categorias
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= base_url() ?>index.php/dashboard/links">
                                Links
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= base_url() ?>index.php/dashboard/env">
                                Env
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="col-12 col-md-9 col-lg-10">
                <h1 class="mb-4"><?= esc($title) ?></h1>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('dashboard/contact') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            Telefone
                        </label>

                        <input type="text" name="phone" id="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" maxlength="15"  value="<?= esc($phone) ?>" placeholder="(DDD) 00000-0000">

                        <?php if (isset($errors['phone'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['phone']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-dark">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    /**
     * Máscara simples de telefone (suporta 8 ou 9 dígitos)
     */
    $('#phone').on('input', function()
    {
        var v = $(this).val().replace(/\D/g, '');

        if (v.length > 11)
        {
            v = v.slice(0, 11);
        }

        if (v.length > 10)
        {
            v = v.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
        } else if (v.length > 5)
        {
            v = v.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
        } else if (v.length > 2)
        {
            v = v.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
        } else
        {
            v = v.replace(/^(\d*)/, '($1');
        }

        $(this).val(v);
    });
</script>
<?= $this->endSection() ?>
