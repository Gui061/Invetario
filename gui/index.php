<?php
session_start();

define('USERNAME', 'zelda');
define('PASSWORD', '1234');

function lerInventario() {
    $itens = [];
    if (file_exists('inventario.txt')) {
        $arquivo = fopen('inventario.txt', 'r');
        while ($linha = fgets($arquivo)) {
            $itens[] = trim($linha);
        }
        fclose($arquivo);
    }
    return $itens;
}

function adicionarItem($item) {
    $arquivo = fopen('inventario.txt', 'a');
    fwrite($arquivo, $item . PHP_EOL);
    fclose($arquivo);
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if (isset($_GET['add_item']) && isset($_GET['img_url'])) {
    $item = trim($_GET['add_item']);
    $img_url = trim($_GET['img_url']);
    if (!empty($item) && !empty($img_url)) {
        adicionarItem($item . '|' . $img_url);
        header('Location: index.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if ($username == USERNAME && $password == PASSWORD) {
            $_SESSION['logado'] = true;
            header('Location: index.php');
            exit;
        } else {
            $erro = "Usuário ou senha incorretos!";
        }
    }
    
    if (isset($_POST['cadastro_item']) && isset($_POST['img_url'])) {
        $item = $_POST['item'];
        $img_url = $_POST['img_url'];
        if ($item && $img_url) {
            adicionarItem($item . '|' . $img_url);
            header('Location: index.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário de Zelda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <?php if (!isset($_SESSION['logado']) || !$_SESSION['logado']): ?>
        <h2 class="text-center">Login</h2>
        <?php if (isset($erro)) { echo "<div class='alert alert-danger text-center'>$erro</div>"; } ?>
        <form method="POST" class="text-center">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Usuário" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Entrar</button>
        </form>
    <?php else: ?>
        <h2 class="text-center">Inventário de Zelda</h2>
        <div class="text-center mb-3">
            <a class="btn btn-danger" href="index.php?logout=true">Sair</a>
        </div>
        
        <h3 class="text-center">Inventário Atual</h3>
        <div class="inventario-container">
            <?php
            $itens = lerInventario();
            $contagem = [];
            foreach ($itens as $linha) {
                list($item, $img_url) = explode('|', $linha . '|');
                if (!isset($contagem[$item])) {
                    $contagem[$item] = ['quantidade' => 0, 'img_url' => $img_url];
                }
                $contagem[$item]['quantidade']++;
            }
            foreach ($contagem as $item => $dados): ?>
                <div class="inventario-item">
                    <img src="<?php echo $dados['img_url']; ?>" alt="<?php echo $item; ?>">
                    <span class="item-quantidade">x<?php echo $dados['quantidade']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <h3 class="text-center">Cadastrar Novo Item</h3>
        <form method="POST" class="text-center">
            <div class="mb-3">
                <input type="text" class="form-control" name="item" placeholder="Nome do Item" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="img_url" placeholder="URL da Imagem" required>
            </div>
            <button type="submit" class="btn btn-success" name="cadastro_item">Salvar</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>