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
                    <li class="list-group-item active">
                        <a href="<?= base_url() ?>index.php/dashboard/address">
                            Endereço
                        </a>
                    </li>

                    <li class="list-group-item">
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

                <form action="<?= site_url('dashboard/address') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="address" class="form-label">Endereço</label>

                        <input type="text" name="address" id="address" class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" value="<?= esc($address['address'] ?? '') ?>">

                        <?php if (isset($errors['address'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['address']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="neighborhood" class="form-label">Bairro</label>

                        <input type="text" name="neighborhood" id="neighborhood" class="form-control <?= isset($errors['neighborhood']) ? 'is-invalid' : '' ?>" value="<?= esc($address['neighborhood'] ?? '') ?>">

                        <?php if (isset($errors['neighborhood'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['neighborhood']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Cidade</label>

                        <input type="text" name="city" id="city" class="form-control <?= isset($errors['city']) ? 'is-invalid' : '' ?>" value="<?= esc($address['city'] ?? '') ?>">

                        <?php if (isset($errors['city'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['city']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">Estado (UF)</label>

                            <input type="text" name="state" id="state" maxlength="2" class="form-control text-uppercase <?= isset($errors['state']) ? 'is-invalid' : '' ?>" value="<?= esc($address['state'] ?? '') ?>">

                            <?php if (isset($errors['state'])): ?>
                                <div class="invalid-feedback">
                                    <?= esc($errors['state']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cep" class="form-label">CEP</label>

                            <input type="text" name="cep" id="cep" maxlength="9" class="form-control <?= isset($errors['cep']) ? 'is-invalid' : '' ?>" value="<?= esc($address['cep'] ?? '') ?>" placeholder="00000-000">

                            <?php if (isset($errors['cep'])): ?>
                                <div class="invalid-feedback">
                                    <?= esc($errors['cep']) ?>
                                </div>
                            <?php endif; ?>
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

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    /**
     * Máscara simples de CEP
     */
    $('#cep').on('input', function()
    {
        var v = $(this).val().replace(/\D/g, '');

        if (v.length > 8)
        {
            v = v.slice(0, 8);
        }

        if (v.length > 5)
        {
            v = v.replace(/^(\d{5})(\d{0,3})/, '$1-$2');
        }

        $(this).val(v);
    });
</script>
<?= $this->endSection() ?>
