<?php
session_start();
include 'conexao.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$stmt = $conexao->prepare("SELECT * FROM post WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$sql = "UPDATE post SET visu = visu + 1 WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$cookies_recuse = isset($_COOKIE['cookies_recuse']) ? true : false;
$cookies_accepted = isset($_COOKIE['cookies_accepted']) && !isset($_COOKIE['cookies_recuse']) ? true : false;
if (isset($_GET['accept_cookies'])) {
    if ($_GET['accept_cookies'] === 'true') {
        setcookie('cookies_accepted', 'true', time() + (86400 * 30), '/');   
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
        $categorias_visitadas = isset($_COOKIE['categorias']) ? $_COOKIE['categorias'] . ',' . $categoria : $categoria;
        setcookie('categorias', $categorias_visitadas, time() + (86400 * 30), '/');
        header("Location: postagem.php?id=$id&categoria=$categoria");        
    } elseif ($_GET['accept_cookies'] === 'false') {
        $_SESSION['recuse_cookies'] = true;
        header("Location: postagem.php?id=$id&categoria=$categoria");        
    }
}
if ($cookies_accepted && $categoria) {
    $categorias_visitadas = isset($_COOKIE['categorias']) ? $_COOKIE['categorias'] . ',' . $categoria : $categoria;
    setcookie('categorias', $categorias_visitadas, time() + (86400 * 30), '/');
}
$resultado_relacionado = array();
if ($cookies_accepted && isset($_COOKIE['categorias'])) {    
  $categorias = explode(',', $_COOKIE['categorias']);
  $tipos = str_repeat('s', count($categorias)); 
  $placeholders = str_repeat('?,', count($categorias) - 1) . '?';
  $sql2 = "SELECT * FROM post WHERE categoria IN ($placeholders) AND id <> ? ORDER BY RAND() LIMIT 6";
  $stmt = $conexao->prepare($sql2);
  $params = array_merge($categorias, [$id]);
  $stmt->bind_param($tipos . 'i', ...$params);
  $stmt->execute();
  $resultado_relacionado = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else { 
  $sql2 = "SELECT * FROM post WHERE categoria = ? AND id <> ? ORDER BY RAND() LIMIT 6";
  $stmt = $conexao->prepare($sql2);
  $stmt->bind_param('si', $categoria, $id);
  $stmt->execute();
  $resultado_relacionado = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
$sql_comentarios = "SELECT nome, texto FROM comentario WHERE id = ?";
$stmt = $conexao->prepare($sql_comentarios);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado_comentarios = $stmt->get_result();
$sql_usu = "SELECT * FROM usuario ";
$stmt = $conexao->prepare($sql_usu);
$stmt->execute();
$resultado_usu = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8805318137170390" crossorigin="anonymous"></script>
<link rel="icon" href="img/favicon.ico">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php while ($row = $resultado->fetch_assoc()) {?>
<title><?php echo htmlspecialchars($row["titulo"]);?></title>
<link rel="canonical" href="https://www.viniciuscaamano.space/postagem.php?id=<?php echo htmlspecialchars($row["id"]);?>&categoria=<?php echo htmlspecialchars($row["categoria"]);?>" />
<meta name="robots" content="index, follow">
<link rel="stylesheet" href="style.css?v=46">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8805318137170390"
     crossorigin="anonymous"></script>
<meta name="description" content="<?php echo htmlspecialchars($row["desc_post"]);?>">
<meta name="twitter:site" content="@vini_caamano_">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="https://www.viniciuscaamano.space/postagem.php?id=<?php echo htmlspecialchars($row["id"]);?>&categoria=<?php echo htmlspecialchars($row["categoria"]);?>">
<meta name="twitter:title" content="<?php echo htmlspecialchars($row["titulo"]);?>">
<meta name="description" content="<?php echo htmlspecialchars($row["desc_post"]);?>">
<meta name="twitter:image" content="https://www.viniciuscaamano.space/img/<?php echo htmlspecialchars($row["imagem"]);?>">
<meta property="og:title" content="<?php echo htmlspecialchars($row["titulo"]);?>">
<meta property="og:description" content="<?php echo htmlspecialchars($row["desc_post"]);?>">
<meta property="og:image" content="https://www.viniciuscaamano.space/img/<?php echo htmlspecialchars($row["imagem"]);?>">
<meta property="og:url" content="https://www.viniciuscaamano.space/postagem.php?id=<?php echo htmlspecialchars($row["id"]);?>&categoria=<?php echo htmlspecialchars($row["categoria"]);?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">   
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L7PGCSNEWC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-L7PGCSNEWC');
</script>
</head>
<body>
<header>  
  <nav>
    <h2>Vinicius Caamaño blog</h2>    
    <div class="pes">
    <form action="pesquisar.php" method="post">
        <input type="search" name="pesquisar" required pattern="[a-zA-ZÀ-ú0-9\s]+" title="A pesquisa só aceita letras, números e espaços">
        <input type="submit" value="Pesquisar">
    </form>
    </div>    
    <ul>
    <li><a href="index.php">Inicio</a></li>
    <li><a href="gamer.php">Gamer</a></li>
    <li><a href="culinaria.php">Culinaria</a></li>
    <li><a href="seo.php">SEO</a></li>
    <li><a href="curtidas-u.php"><img src="img/CURTI.PNG" alt="curtidas"></a></li>
    <li><a href="painel.php">Painel</a></li>
    <li><a href="review.php">Review</a></li>
    </ul>   
</header>
<div id="mySidepanel" class="sidepanel">
  <a href="#" class="closebtn" onclick="closeNav()">x</a>
  <a href="index.php">Inicio</a>
  <a href="gamer.php">Gamer</a>
  <a href="culinaria.php">Culinaria</a>
  <a href="seo.php">SEO</a>
  <a href="curtidas-u.php"><img src="img/CURTI.PNG" alt="curtidas"></a>
  <a href="painel.php">Painel</a>
  <a href="review.php">Review</a>
</div>
<div class="mb">
<button class="openbtn" onclick="openNav()">☰</button>  
<div class="ti">
<h2>Vinicius Caamaño Blog</h2>
</div>
</div>
<script>
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}
function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}
</script>
</nav>
<main>
<div class='conteudo'>
<div class='cont_es' id="connes">
    <div class="con_p">
    <div class="imagem2">
 <img src="img/<?php echo htmlspecialchars($row["imagem"]); ?>" alt="<?php echo ($row["titulo"]); ?>">
  </div>
<div class="texto2">
<h1><?php echo ($row["titulo"]); ?></h1>
 <p><?php echo ($row["cont"]); ?></p>
 <hr>
 </div> 
</div>
<div class="curti">
<h2><img src="img/visu.png" alt=""> <?php echo htmlspecialchars($row["visu"]); ?><span></span><img src="img/CURTI.PNG" alt="Ícone de envio"><?php echo htmlspecialchars($row["curti"]); ?></h2>
<?php
$id = $_GET['id'];
$curtir_permitido = true;
if (isset($_COOKIE['curti']) && in_array($id, explode(',', $_COOKIE['curti']))) {
    $curtir_permitido = false;
}
if ($cookies_accepted) {    
    if ($curtir_permitido) {
        echo '
        <form action="curtidas.php?id='.$id.'" method="post">
            <button type="submit" class="custom-submit-button">
                <img src="img/CURTI.PNG" alt="Ícone de envio">
            </button>
        </form>
        ';
        setcookie('curti', $id, time() + (86400 * 30), '/');
    }
} elseif ($curtir_permitido && !isset($_SESSION['recuse_curtir_' . $id])) {   
    echo '
    <form action="curtidas.php?id='.$id.'" method="post">
        <button type="submit" class="custom-submit-button">
            <img src="img/CURTI.PNG" alt="Ícone de envio">
        </button>
    </form>
    ';
    $_SESSION['recuse_curtir_' . $id] = true;
}
?>
 </div>
<?php }?>
<h2>Comentários</h2>
<?php while ($row_comentario = $resultado_comentarios->fetch_assoc()) {?>
  <div class="coment">     
    <div class="ucomen">
        <h2><?php echo htmlspecialchars($row_comentario["nome"]); ?></h2>
        <p><?php echo htmlspecialchars($row_comentario["texto"]); ?></p>
    </div>
  </div>
<?php }?>
<div class="formcoment">
    <form action="processar_comentario.php?id=<?php echo $id?>&categoria=<?php echo $categoria?>" method="post">
        <p>Nome</p>
        <p><input type="text" name="nome" maxlength="50" required></p>
        <p>Seu comentário</p>
        <p><textarea name="comentario" id="" cols="30" rows="10" maxlength="200" required></textarea></p>
        <p><input type="submit" value="Comentar" name="submit"></p>
    </form>
</div>
<div class="post_usu">
<?php while ($row3 = $resultado_usu->fetch_assoc()) {?>
    <div class="profile">
    <img src="img/Usuarios/<?php echo htmlspecialchars($row3["avatar"]);?>">    
    </div> 
    <div class="bio">
    <p>Publicado por:<h3><?php echo htmlspecialchars($row3["nome"]);?></h3></p> 
    <p><?php echo htmlspecialchars($row3["bio"]);?></p>
    </div>
    <?php }?>
</div>
</div>
<div class='cont_di'>
<div class="rela_a">
    <h2>Para você</h2>
</div>
<?php
if (is_array($resultado_relacionado) && count($resultado_relacionado) > 0) {
    foreach ($resultado_relacionado as $row_relacionado) {
?>
    <a href="postagem.php?id=<?php echo htmlspecialchars($row_relacionado["id"]); ?>&categoria=<?php echo htmlspecialchars($row_relacionado["categoria"]); ?>">
    <div class="destaque">  
    <img src="img/<?php echo htmlspecialchars($row_relacionado["imagem"]); ?>" alt="<?php echo htmlspecialchars($row_relacionado["titulo"]); ?>"> 
    <h3><?php echo htmlspecialchars($row_relacionado["titulo"]); ?></h3>
    </div>
    </a>
<?php
    }
} else {
    echo "<p>Não há postagens relacionadas disponíveis.</p>";
}
?>
</div>
</div>
</main>
<footer>
    <a href="sobre.php">Sobre</a>
  <a href="politica_privacidade.php">Política Privacidade</a>
  <a href="termos.php">Termos e Condições</a>
  <a href="contato.php">Contato</a>
</footer>
<?php
if (!$cookies_accepted && !$_SESSION['recuse_cookies']){
  echo '
  <div class="coki">
      <p>Este site utiliza cookies para garantir a melhor experiência. Ao continuar, você concorda com o uso de cookies.<a href="politica_privacidade.php"> Politica de Privacidade</a></p>
      <form method="get" action="">
          <input type="hidden" name="id" value="'.$id.'">
          <input type="hidden" name="categoria" value="'.$categoria.'">            
          <button type="submit" name="accept_cookies" value="true">Aceitar</button>
          <button type="submit" name="accept_cookies" value="false">Recusar</button>
      </form>
  </div>';
} else {
  // Se os cookies foram aceitos ou recusados, não mostrar a mensagem.
}
exit();
?>
</body>
</html>
