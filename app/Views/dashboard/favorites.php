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

                    <li class="list-group-item active">
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

                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/contact">
                            Contato
                        </a>
                    </li>
                </ul>

                <?php if (session()->has('user') && session('user.admin') === '1'): ?>
                    <ul class="list-group">
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
                <h1>
                    Meus Favoritos
                </h1>

                <?php if (count($favorites) == 0): ?>
                    <p>
                        Nenhum favorito disponível
                    </p>
                <?php else: ?>
                    <?php foreach ($favorites as $item): ?>
                        <div class="mb-3" style="width: 100%; float: left;">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <!-- imagem -->
                                    <?php if (!empty($item['thumbnail'])): ?>
                                        <div style="float: left;">
                                            <img src="<?= base_url() ?><?= $item['thumbnail'] ?>" class="card-img-top" alt="<?= esc($item['name']) ?>" style="width: 150px; margin-right: 1rem; display: block;">
                                        </div>
                                    <?php endif; ?>

                                    <h5 class="card-title">
                                        <?= esc($item['name']) ?>
                                    </h5>

                                    <?php if (!empty($item['price'])): ?>
                                        <p class="card-text">
                                            <strong>R$ <?= number_format($item['price'], 2, ',', '.') ?></strong>
                                        </p>
                                    <?php endif; ?>

                                    <a href="<?= site_url("product") ?>/<?= $item['id'] ?>" class="btn btn-primary">
                                        Ver Produto
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
