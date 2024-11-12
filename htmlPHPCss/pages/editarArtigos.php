<?php
include './includes/db.php';

$success = '';
$error = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   
    try {
        $stmt = $pdo->prepare("SELECT * FROM artigos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $artigo = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Erro ao buscar o artigo: " . $e->getMessage();
    }
} else {
    $error = "ID de artigo não fornecido!";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($artigo)) {
    $titulo = $_POST['titulo'] ?? '';
    $conteudo = $_POST['conteudo'] ?? '';

    if (!empty($titulo) && !empty($conteudo)) {
        try {
            $stmt = $pdo->prepare("UPDATE artigos SET titulo = :titulo, conteudo = :conteudo WHERE id = :id");
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':conteudo', $conteudo);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $success = "Artigo atualizado com sucesso!";
        } catch (PDOException $e) {
            $error = "Erro ao atualizar o artigo: " . $e->getMessage();
        }
    } else {
        $error = "Por favor, preencha todos os campos.";
    }
}
?>

<main>
    <h2>Editar Artigo</h2>

    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (isset($artigo)): ?>
        <form method="POST" action="">
            <label for="titulo">Título:</label><br>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($artigo['titulo']); ?>" required><br><br>

            <label for="conteudo">Conteúdo:</label><br>
            <textarea id="conteudo" name="conteudo" rows="5" required><?php echo htmlspecialchars($artigo['conteudo']); ?></textarea><br><br>

            <button type="submit">Atualizar Artigo</button>
        </form>
    <?php endif; ?>
</main>

<?php include './includes/footer.php'; ?>
