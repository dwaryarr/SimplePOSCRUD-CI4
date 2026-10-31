<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title . ' - POS System' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <?= $this->include('layouts/navbar') ?>

    <?= $this->renderSection('content') ?>

</body>

</html>