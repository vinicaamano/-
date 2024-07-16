<?php
 include 'conexao.php'; 
 session_start();
 $cookies_recuse = isset($_COOKIE['cookies_recuse']) ? true : false;
 $cookies_accepted = isset($_COOKIE['cookies_accepted']) && !isset($_COOKIE['cookies_recuse']) ? true : false;
 if (isset($_GET['accept_cookies'])) {
     if ($_GET['accept_cookies'] === 'true') {
         setcookie('cookies_accepted', 'true', time() + (86400 * 30), '/');
         // Criar o cookie de categorias apenas se os cookies forem aceitos
         $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
         $categorias_visitadas = isset($_COOKIE['categorias']) ? $_COOKIE['categorias'] . ',' . $categoria : $categoria;
         setcookie('categorias', $categorias_visitadas, time() + (86400 * 30), '/');
         header("Location: seo.php");        
     } elseif ($_GET['accept_cookies'] === 'false') {
         $_SESSION['recuse_cookies'] = true;
         header("Location: seo.php");        
     }
 }
 $sql = "SELECT * FROM post where categoria = 3 ORDER BY data_post DESC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$resultado = $stmt->get_result();
$sql2 = "SELECT * FROM post where categoria = 3 ORDER BY visu desc limit 6";
$stmt2 = $conexao->prepare($sql2);
$stmt2->execute();
$resultado2 = $stmt2->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="icon"  href="img/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEO de sites</title>     
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="style.css?v=46">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8805318137170390"
     crossorigin="anonymous"></script>
    <meta name="description" content="Dicas de SEO de sites, rede social e outros">
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
     <meta name="twitter:site" content="@vini_caamano_">
    <meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="SEO de sites">
<meta name="twitter:description" content="Dicas de SEO de sites, rede social e outros">
<meta name="twitter:image"content="https://www.viniciuscaamano.space/img/41iem3i4o3qrhu89wqq6lhjea.webp">
<meta property="og:title" content="SEO de sites">
<meta property="og:description" content="Dicas de SEO de sites, rede social e outros">
<meta property="og:image" content="https://www.viniciuscaamano.space/img/41iem3i4o3qrhu89wqq6lhjea.webp">
<meta property="og:url" content="https://www.viniciuscaamano.space/seo.php">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
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
<div class="conteudo">
<div class="cont_es">
<?php while ($row = $resultado->fetch_assoc()) {?>
 <a href="postagem.php?id=<?php echo htmlspecialchars($row["id"]); ?>&categoria=<?php echo htmlspecialchars($row["categoria"]); ?>">
    <div class="con">
    <div class="cont_post">
<div class="imagem">
 <img src="img/<?php echo htmlspecialchars($row["imagem"]); ?>" alt="<?php echo htmlspecialchars($row["titulo"]); ?>">
  </div>
  <div class="texto">
<?php                    
 $sql_comentarios = mysqli_query($conexao, "SELECT COUNT(*) AS total_comentarios FROM comentario WHERE id = ".$row["id"]) or die(mysqli_error($conexao));
 $row_comentarios = mysqli_fetch_assoc($sql_comentarios);
 $total_comentarios = $row_comentarios['total_comentarios'];
 ?>
 <h3><?php echo htmlspecialchars($row["data_post"]); ?></h3>
 <h2><?php echo htmlspecialchars($row["titulo"]); ?></h2>
 <p><?php echo htmlspecialchars(substr($row["desc_post"], 0, 75));?>...</p>
 <br>
 <p><?php echo htmlspecialchars($row["curti"]); ?><img src="img/curti.png" alt=""><span></span><?php echo $total_comentarios; ?> <img src="img/comenn.png" alt=""></p>
</div>
</div>
</div>
</a>
<?php }?>
</div>
<div class="cont_di">
<div class="rela_a">
    <h2>Destaque</h2>
    </div>
    <?php while ($row2 = $resultado2->fetch_assoc()) {?>
    <a href="postagem.php?id=<?php echo htmlspecialchars($row2["id"]); ?>&categoria=<?php echo htmlspecialchars($row2["categoria"]); ?>">
    <div class="destaque">
    <img src="img/<?php echo htmlspecialchars($row2["imagem"]); ?>" alt="<?php echo htmlspecialchars($row2["titulo"]); ?>"> 
    <h3><?php echo htmlspecialchars($row2["titulo"]); ?></h3>
    </div>
    </a>
    <?php }?>
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