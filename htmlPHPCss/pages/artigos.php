<?php
include './includes/db.php';

$success = '';
$error = '';


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM artigos WHERE id = :id");
        $stmt->bindParam(':id', $delete_id);
        $stmt->execute();
        $success = "artigo excluído com sucesso!";
    } catch (PDOException $e) {
        $error = "Erro ao exlcuir" . $e->getMessage();
    }
}


try {
    $stmt = $pdo->query("SELECT * FROM artigos ORDER BY id ASC");
    $artigos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Erro ao listar" . $e->getMessage();
}
?>

<main>
    <h2>Listagem  de Artigos</h2>

    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Título</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($artigos as $artigo): ?>
            <tr>
                <td><?php echo htmlspecialchars($artigo['titulo']); ?></td>
                <td>
                    <a href="./editarArtigos?id=<?php echo $artigo['id']; ?>">Editar</a> |
                    <a href="?delete_id=<?php echo $artigo['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este artigo?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php include './includes/footer.php'; ?>