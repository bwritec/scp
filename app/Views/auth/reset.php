<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?= esc($title) ?></h1>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= esc($error) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('reset-password') ?>" method="post">
                    <?= csrf_field() ?>

                    <input type="hidden" name="token" value="<?= esc($token) ?>">

                    <div class="mb-3">
                        <label for="password" class="form-label">Nova senha</label>

                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-dark">
                        Redefinir senha
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
