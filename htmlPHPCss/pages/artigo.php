<?php
include  './includes/db.php';


$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'] ?? '';
    $conteudo = $_POST['conteudo'] ?? '';

    if (!empty($titulo) && !empty($conteudo)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO artigos (titulo, conteudo) VALUES (:titulo, :conteudo)");
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':conteudo', $conteudo);
            $stmt->execute();
            $success = "Artigo adicionado com sucesso!";
        } catch (PDOException $e) {
            $error = "Erro ao adicionar o artigo: " . $e->getMessage();
        }
    } else {
        $error = "Por favor, preencha todos os campos.";
    }
}
?>

<main>
    <h2>Adicionar Novo Artigo</h2>

    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <textarea id="conteudo" name="conteudo" rows="5" required></textarea><br><br>

        <button type="submit" >Adicionar Artigo</button>
    </form>
</main>

<?php include './includes/footer.php'; ?>
