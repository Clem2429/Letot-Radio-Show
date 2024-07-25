<?php
include_once '../systeme/config.php';
?>
<!DOCTYPE html>
<html lang="fr">
     <head>
<script src='../js/global.js' async></script>
        <meta charset="utf-8"><link rel="icon" href="../img/logo_lrs.png"/>
        <title>Mises à Jour</title>
        <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MisesàJour</title>
    <link rel="stylesheet" href="../css/MaJ.css" />
    <link rel="stylesheet" href="../css/site.css" />
    <link rel="stylesheet" href="../css/la_lrs.css" />
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/Accueil.css">
    </head>
    <body class="MisesàJour" >       
<?php include('../includes/nav.php'); ?>
<main>
     
    <div class="container">
      <h1>Découvrir la LRS</h1> 
      <br>
      <div class="accordion">
        <div style="display: yes;" class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <span class="accordion-title">Qu'est-ce que la LRS ?</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p class="txt5">
              La LRS, ou Letot Radio Show, c'est une webradio équipée d'un studio radio situé au CDI. Elle publie des émissions qui portent sur divers sujets tels que le sport, l'actualité, la littérature, etc.
              <br>
              Elle est ouverte à tous et permet la diffusion de quelques informations dans le collège !
            </p>
          </div>
        </div>
        <div style="display: yes;" class="accordion-item">
          <button id="accordion-button-2" aria-expanded="false">
            <span class="accordion-title">Qui sont à la LRS ?</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p class="txt5">
              La Webradio est composée d'une trentaine d'élèves qui vont de la 6e à la 3e, les 6e et 5e étant les plus représentés ! C'est aussi une équipe de 4 adultes, trois profs et un assistant d'éducation, qui gèrent, organisent et encadrent la LRS !
            </p>
          </div>
        </div>
        <div style="display: yes;" class="accordion-item">
          <button id="accordion-button-3" aria-expanded="false">
            <span class="accordion-title">Que fait-on à la LRS ?</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p class="txt5">
              À la radio, on fait de nombreuses choses telles que des reportages pour des rubriques spécifiques ou encore, des reportages portant sur l'actualité, qu'elle soit dans le collège ou à un autre niveau ! Ainsi, on ne s'ennuie jamais puisqu'il y a toujours une émission, une rubrique, un reportage ou même une interview à préparer !
            </p>
          </div>
        </div>
      </div>
    </div>
    <hr>

    <div class="first_container_about">
    <div class="box_container_about">
    <blockquote class="twitter-tweet"><p lang="fr" dir="ltr">Il n’y a pas que le prix Bayeux, à Bayeux. Une semaine avant cet événement <a href="https://twitter.com/hashtag/EducMediasInfo?src=hash&amp;ref_src=twsrc%5Etfw">#EducMediasInfo</a> incontournable, nous sommes allés à la rencontre d’une enseignante et de ses élèves à l’origine d’une webradio exceptionnelle de l’académie <a href="https://twitter.com/ac_normandie?ref_src=twsrc%5Etfw">@ac_normandie</a>, le Letot Show. <a href="https://twitter.com/hashtag/Thread?src=hash&amp;ref_src=twsrc%5Etfw">#Thread</a> <a href="https://t.co/KMVqTWAXxX">pic.twitter.com/KMVqTWAXxX</a></p>&mdash; Moussy Maud (@MaudMoussy) <a href="https://twitter.com/MaudMoussy/status/1710245467676709162?ref_src=twsrc%5Etfw">October 6, 2023</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
      <div class="box_container_about">
        <p>
        <h1>Apprenez-en plus sur la LRS</h1>
        <h3>à travers le Reportage de <a title="Maud Moussy - X" href="https://twitter.com/MaudMoussy">Maud Moussy</a> pour le <a title="Site du CLEMI (Le Centre pour l'éducation aux médias et à l'information)" href="https://www.clemi.fr/">CLEMI</a></h3>
          <a href="https://twitter.com/MaudMoussy/status/1710245467676709162?ref_src=twsrc%5Etfw%7Ctwcamp%5Etweetembed%7Ctwterm%5E1710245467676709162%7Ctwgr%5E300efe7f4324eb98377fb3fc958c3a068949aae9%7Ctwcon%5Es1_&ref_url=http%3A%2F%2Flocalhost%2Flrs%2Fla_lrs.php"><button>Voir sur 𝕏</button></a>
          <a href="https://www.clemi.fr/ressources/series-de-ressources-videos/clemi-face-cam/letot-show-la-webradio-des-eleves-du-college-charles-letot"><button>Découvrir le Reportage complet</button></a>
        </p>
      </div>
</div>
<div class="second_container_about">
  <div class="box_container_about">
    <h1>OU...</h1>
  </div>
</div>
<div class="third_container_about">
      <div class="box_container_about">
        <video src="video/genese_lrs.mp4" preload controls width="95%" height="auto"></video>
      </div>
      <div class="box_container_about">
        <p>
        <h1>Découvrez la génèse de la LRS</h1>
        <h3>à travers ce magnifique <a href="https://pod.ac-normandie.fr/video/47671-radio-letot-show-le-genesemp4/">teaser</a> !</h3>
        <br>
        <a href="https://pod.ac-normandie.fr/video/47671-radio-letot-show-le-genesemp4/"><button>Pod Académie de Normandie</button></a>
        </p>
      </div>
    </div>










    <script src="../js/maj.js"></script>
    </main>
    <div class="footer">
    <?php include('../includes/footer.php'); ?>  </div> 
    </body>
    </html>


