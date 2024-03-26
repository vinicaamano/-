<?php
session_start();

if((!isset($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
   
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-02LPK3FDNY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-02LPK3FDNY');
</script>
<meta name="robots" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar Aluguel</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&display=swap" rel="stylesheet">
    <?php






if(isset($_POST['submit']))
{

  
  include_once('conexao.php');


  if(isset($_FILES["imagem"])) {

    $imagem = "img/".$_FILES["imagem"]["name"];
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem );

    
}

if(isset($_FILES["imagem2"])) {

    $imagem2 = "img/".$_FILES["imagem2"]["name"];
    move_uploaded_file($_FILES["imagem2"]["tmp_name"], $imagem2 );

    
}
if(isset($_FILES["imagem3"])) {

    $imagem3 = "img/".$_FILES["imagem3"]["name"];
    move_uploaded_file($_FILES["imagem3"]["tmp_name"], $imagem3 );

    
}
if(isset($_FILES["imagem4"])) {

    $imagem4 = "img/".$_FILES["imagem4"]["name"];
    move_uploaded_file($_FILES["imagem4"]["tmp_name"], $imagem4 );

    
}
if(isset($_FILES["imagem5"])) {

    $imagem5 = "img/".$_FILES["imagem5"]["name"];
    move_uploaded_file($_FILES["imagem5"]["tmp_name"], $imagem5 );

    
}
if(isset($_FILES["imagem6"])) {

    $imagem6 = "img/".$_FILES["imagem6"]["name"];
    move_uploaded_file($_FILES["imagem6"]["tmp_name"], $imagem6 );

    
}
if(isset($_FILES["imagem7"])) {

    $imagem7 = "img/".$_FILES["imagem7"]["name"];
    move_uploaded_file($_FILES["imagem7"]["tmp_name"], $imagem7 );

    
}
if(isset($_FILES["imagem8"])) {

    $imagem8 = "img/".$_FILES["imagem8"]["name"];
    move_uploaded_file($_FILES["imagem8"]["tmp_name"], $imagem8 );

    
}
if(isset($_FILES["imagem9"])) {

    $imagem9 = "img/".$_FILES["imagem9"]["name"];
    move_uploaded_file($_FILES["imagem9"]["tmp_name"], $imagem9 );

    
}
if(isset($_FILES["imagem10"])) {

    $imagem10 = "img/".$_FILES["imagem10"]["name"];
    move_uploaded_file($_FILES["imagem10"]["tmp_name"], $imagem10 );

    
}


$idimo = $_SESSION['email'];

$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$preco = $_POST['preco'];
$quartos = $_POST['quartos'];
$banheiros = $_POST['banheiros'];
$suites = $_POST['suites'];
$m2 = $_POST['m2'];
$vaga = $_POST['vaga'];
$desc_imo = $_POST['desc_imo'];
$condominio = $_POST['condominio'];
$iptu = $_POST['iptu'];

$sql2 = "SELECT * FROM aluguel WHERE codigo = '$codigo'";
$result5 = $conexao->query($sql2);

if(mysqli_num_rows($result5)){
  echo "Codigo em uso!";
}else{
  $result = mysqli_query($conexao, "INSERT INTO aluguel(email, codigo, titulo, imagem, imagem2, imagem3, imagem4, imagem5, imagem6, imagem7, imagem8, imagem9, imagem10, preco, quartos, banheiros, suites, m2, vaga, desc_imo, condominio ,iptu) 
  VALUES ('$idimo','$codigo','$titulo','$imagem','$imagem2','$imagem3','$imagem4','$imagem5','$imagem6','$imagem7','$imagem8','$imagem9','$imagem10', '$preco','$quartos','$banheiros','$suites','$m2','$vaga','$desc_imo','$condominio', '$iptu')");
  echo"imóvel cadastrado com sucesso!";


}


//criar pagina
$url = $_POST['codigo'];



$myfile = fopen("$url.php", "w") or die("Unable to open file!");
$txt = " 



<!DOCTYPE html>
<html lang='pt-br'>
<head>
<!-- Google tag (gtag.js) -->
<script async src='https://www.googletagmanager.com/gtag/js?id=G-02LPK3FDNY'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-02LPK3FDNY');
</script>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>$titulo</title>
    <link rel='icon' type='image/x-icon' href='img/favicon.ico'>
    <link rel='stylesheet' href='style.css'>
    <meta name='description' content='$desc_imo'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Protest+Riot&display=swap' rel='stylesheet'>
    <script async src='https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8805318137170390'
    crossorigin='anonymous'></script>
</head>

<body>
<header>
    <h1>Imóveis Caamaño</h1>
    <nav>
       <ul>
       <li><a href='index.php'>Inicio</a> </li>
       <li><a href='venda_imoveis.php'>Venda</a> </li>
       <li> <a href='aluguel_imoveis.php'>Aluguel</a></li>        
        <li><a href='cadastrar_venda.php'>Painel</a></li>
        <li><a href='contato.php'>contato</a></li>
        <li><a href='cadastrar.php'>Cadastrar</a></li> 
   
       </ul>
    </nav>
</header>

<main>

<div class='pagina_pai'>

<div class='pagina_fotos'>


  
<div class='slideshow-container'>

<div class='mySlides fade'>
  <div class='numbertext'>1 / 10</div>
  <img src='$imagem' style='width:100%'>
 
</div>

<div class='mySlides fade'>
  <div class='numbertext'>2 / 10</div>
  <img src='$imagem2' style='width:100%'>
  
</div>

<div class='mySlides fade'>
  <div class='numbertext'>3 / 10</div>
  <img src='$imagem3' style='width:100%'>
  
</div>
<div class='mySlides fade'>
  <div class='numbertext'>4 / 10</div>
  <img src='$imagem4' style='width:100%'>
  
</div>
<div class='mySlides fade'>
  <div class='numbertext'>5 / 10</div>
  <img src='$imagem5' style='width:100%'>
  
</div>
<div class='mySlides fade'>
  <div class='numbertext'>6 / 10</div>
  <img src='$imagem6' style='width:100%'>
 
</div>
<div class='mySlides fade'>
  <div class='numbertext'>7 / 10</div>
  <img src='$imagem7' style='width:100%'>
 
</div>
<div class='mySlides fade'>
  <div class='numbertext'>8 / 10</div>
  <img src='$imagem8' style='width:100%'>

</div>
<div class='mySlides fade'>
  <div class='numbertext'>9 / 10</div>
  <img src='$imagem9' style='width:100%'>
 
</div>
<div class='mySlides fade'>
  <div class='numbertext'>10 / 10</div>
  <img src='$imagem10' style='width:100%'>

</div>

<a class='prev' onclick='plusSlides(-1)'>❮</a>
<a class='next' onclick='plusSlides(1)'>❯</a>

</div>
<br>

<div style='text-align:center'>
  <span class='dot' onclick='currentSlide(1)'></span> 
  <span class='dot' onclick='currentSlide(2)'></span> 
  <span class='dot' onclick='currentSlide(3)'></span> 
  <span class='dot' onclick='currentSlide(4)''></span> 
  <span class='dot' onclick='currentSlide(5)'></span> 
  <span class='dot' onclick='currentSlide(6)'></span> 
  <span class='dot' onclick='currentSlide(7)''></span> 
  <span class='dot' onclick='currentSlide(8)'></span> 
  <span class='dot' onclick='currentSlide(9)'></span> 
  <span class='dot' onclick='currentSlide(10)''></span> 
</div>

<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName('mySlides');
  let dots = document.getElementsByClassName('dot');
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none';  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(' active', '');
  }
  slides[slideIndex-1].style.display = 'block';  
  dots[slideIndex-1].className += ' active';
}
</script>

</div>

<div class='pagina_cont'>
   
    <h1>$titulo</h1>
    <h2>R$: $preco</h2>
    <p>$desc_imo</p>
    <div class='pagina_q1'>

    <p>condominio: R$:$condominio</p> <p>iptu: R$:$iptu</p> 
    </div>
    <div class='pagina_q1'>
    <p>quartos: $quartos</p> <p>banheiros: $banheiros</p>
    </div>
    <div class='pagina_q1'>
    <p>área: $m2 m²</p> <p>vaga: $vaga</p><br>
    </div>
    <div class='pagina_q1'>
    <p>suítes: $suites</p>
  
    </div>
    <div class='pagina_q1'>
    <p>codigo: $codigo </p>
    </div>
    <div class='pagina_q1'>
    <div class='visita'>
 
    <h1>Apartamento mobiliado para alugar em Botafogo</h1>
    <h2>R$: 444444</h2>
    <p>aaaaaaa</p>
    <div class='pagina_q1'>

    <p>condominio: 1300</p> <p>iptu: </p> 
    </div>
    <div class='pagina_q1'>
    <p>quartos: 3</p> <p>banheiros: 2</p>
    </div>
    <div class='pagina_q1'>
    <p>área: 120 m²</p> <p>vaga: 1</p><br>
    </div>
    <div class='pagina_q1'>
    <p>suítes: 1</p>
  
    </div>
    <div class='pagina_q1'>
    <p>codigo: 13 </p>
    </div>
    <div class='pagina_q1'>
    
    <div class='visita'>
   
    <!-- Trigger/Open The Modal -->
<button id='myBtn'>Marcar visita</button>

<!-- The Modal -->
<div id='myModal' class='modal'>

  <!-- Modal content -->
  <div class='modal-content'>
    <span class='close'>&times;</span>
    <p>

    <?php
  if(isset($_POST['email']) && !empty($_POST['email'])){

$email = addslashes($_POST['email']);
$telefone = addslashes($_POST['telefone']);
$mensagem = addslashes($_POST['mensagem']);

$to = $idimo;
$subjet = 'Imoveiscaamano - visita';
$body = 'email: '.$email. '\r\n'.
       'telefone: '.$telefone. '\r\n'.
        'mensagem: '.$mensagem;


'$header' = 'from:atendimento@imoveiscaamano.com.br'.'\r\n'
.'reply-to:''.$email.'\e\n'
.'X=Mailer:PHP/'.phpversion();

if(mail('$to','$subjet','$body','$header')){

    echo('Email enviado.');
}else{
    echo('o email não foi enviado!');
}

}
?>
<div class='contato_c'>
<h1>Marcar Visita no imóvel</h1> 
<p>Atendimento de segunda à domingo horário comercial</p>
</div>
<div class='contato'>
<form action='$codigo.php' method='post'>
<p>Email</p>
<p><input type='field' name='email' placeholder='email'></p>
<p>Telefone</p>
<p><input type='field' name='telefone' placeholder='telefone'></p>
<p><textarea name='mensagem' cols='47' rows='20' placeholder='Digite sua menssagem..'>
</textarea></p>
<input type='submit' value='enviar' name='enviar'>

</form>
</div>

    </p>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById('myBtn');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName('close')[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = 'block';
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = 'none';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}
</script>



  </div>

</main>


<footer>
<div class='footer_cont'>
<p>Atendimento de segunda à domingo horário comercial</p>
<p>Telefone:<a href='tel:+552197627-6013'> (21)97627-6013</a></p>
<p>Email:<a href='contato.php'>atendimento@imoveiscaamano.com.br </a></p>
<p>CRECI:<a href='https://www.crecirj.conselho.net.br/form_pesquisa_cadastro_geral_site.php'>55911</a></p>
</div>

</footer>

</body>

</html>




";

fwrite($myfile, $txt);

fclose($myfile);


}

?>





</head>
<body>
<header>
    <h1>Imóveis Caamaño</h1>
    <nav>
       <ul>
       <a href="index.php"><li>Inicio</li></a> 
        <li><a href="cadastrar_venda.php">Add_venda</a></li>  
        <li><a href="deletar_venda.php">deletar_venda</a></li>      
        <li><a href="cadastrar_aluguel.php">Add_aluguel</a></li>
        <li><a href="deletar_aluguel.php">deletar_aluguel</a></li> 
        <li><a href="add_usuarios.php">Add_usuarios</a></li> 
        <li><a href="usuarios.php">deletar_usuarios</a></li> 

     
       </ul>
    </nav>
</header>
<main class="cadastro_imo">

    <div class="painel">
    <h1>Cadastrar imóvel para Alugar</h1>
    <form action="cadastrar_aluguel.php" method="POST" enctype="multipart/form-data">

<p>codigo: </p> <input type="text" name="codigo" required><br>

<p>titulo: </p> <input type="text" name="titulo" maxlength="55" placeholder="Titulo"  required><br>

<p>preco: </p><input type="text" name="preco" required><br>

<p>descrição: </p><textarea name="desc_imo"  cols="700" rows="15" maxlength="700" required></textarea><br>

<p>condominio: <input type="text" name="condominio" required> iptu: <input type="number" name="iptu" required></p>

<p>quartos: <input type="number" name="quartos" required> banheiros: <input type="number" name="banheiros" required></p>


<p>suites: <input type="number" name="suites" required> vaga: <input type="number" name="vaga" required> m²: <input type="number" name="m2" required></p><br><br>



<p><input  type="file" name="imagem" accept="image/*"></p>
<p><input  type="file" name="imagem2" accept="image/*" ></p>
<p><input  type="file" name="imagem3" accept="image/*" ></p>
<p><input  type="file" name="imagem4" accept="image/*" ></p>
<p><input  type="file" name="imagem5" accept="image/*" ></p>
<p><input  type="file" name="imagem6" accept="image/*" ></p>
<p><input  type="file" name="imagem7" accept="image/*" ></p>
<p><input  type="file" name="imagem8" accept="image/*" ></p>
<p><input  type="file" name="imagem9" accept="image/*" ></p>
<p><input  type="file" name="imagem10" accept="image/*" ></p>
<input name="submit" type="submit">
</form>

</div>


</main>

</form>
<footer>
<div class="footer_cont">
<p>Atendimento de segunda à domingo horário comercial</p>
<p>Telefone:<a href="tel:+552197627-6013"> (21)97627-6013</a></p>
<p>Email:<a href="contato.php">atendimento@imoveiscaamano.com.br </a></p>
<p>CRECI:<a href="https://www.crecirj.conselho.net.br/form_pesquisa_cadastro_geral_site.php" target="_blank">55911</a></p>
</div>

</footer>
</body>
</html>

