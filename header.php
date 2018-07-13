<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand col-sm-4" target="_blank" href="https://fracturesnumeriques.fr/">
            <img id="imgFract" class="img-responsive" src="images/fractures_logo.png"/>
            <img id="imgFractContrast" class="img-responsive" src="images/fractures_logo_contrast.png"/>
        </a>
        <a class="navbar-brand col-sm-3" href="accueil.php">
            <img id="imgDatac" class="img-responsive" src="images/logo_datac.svg"/>
            <img id="imgDatacContrast" class="img-responsive" src="images/logo_datac_contraste.svg"/>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav navbar-right">
          <li><a class="btn btn-primary changeContraste" href="#" onclick="changeContrast()">Contraste élevé</a></li>
          <li><?php include("bouton_recherche.php"); ?></li>
          <li><?php include("bouton_connexion.php"); ?></li>
      </ul>
    </div>
  </div>
</nav>

<script>
    function changeContrast() {
        console.log($('#css').attr('href'));
        if($('#css').attr('href') == 'mise_en_forme.css') {
            $('#css').replaceWith('<link id=css rel=stylesheet href=mise_en_forme_contrast.css>');
            $('.changeContraste').text('Contraste standard');
        }else{
            $('#css').replaceWith('<link id=css rel=stylesheet href=mise_en_forme.css>');
            $('.changeContraste').text('Contraste élevé');
        }
    }
</script>