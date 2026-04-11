<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?= esc($title) ?></h1>

                <?php if (session()->getFlashdata('error') || isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->getFlashdata('error') ?? $error) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <?= esc($success) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('forgot') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-dark">
                        Enviar link
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
