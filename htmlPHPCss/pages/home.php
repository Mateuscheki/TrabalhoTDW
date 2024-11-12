<?php
$title = "Página Inicial";
include 'includes/db.php';


$query = $pdo->query("SELECT * FROM artigos");
$artigos = $query->fetchAll();
?>

<main>
    <h2>artigos</h2>
    <?php foreach ($artigos as $artigo): ?>
        <article>
            <h3><?php echo htmlspecialchars($artigo['titulo']); ?></h3>
            <p><?php echo htmlspecialchars($artigo['conteudo']); ?></p>
        </article>
    <?php endforeach; ?>
</main>

<?php include './includes/footer.php'; ?>