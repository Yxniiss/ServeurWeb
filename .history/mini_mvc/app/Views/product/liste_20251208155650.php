<h1>liste Page</h1>

<h1><?= $title ?></h1>

<ul>
<?php foreach ($products as $product): ?>
    <li>
        <?= $product['name'] ?> - <?= $product['price'] ?> €
    </li>
<?php endforeach; ?>
</ul>
