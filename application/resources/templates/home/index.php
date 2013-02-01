<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Lyla</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="muted">Banco de Dados de Desaparecidos</h3>
      </div>

      <hr>

      <div class="jumbotron">
        <h1>Lyla</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <a class="btn btn-large btn-success" href="#">Comece a Colaborar </a>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <?php foreach($desaparecidos as $desaparecido): ?>
        <div class="span6">
          <h3><?=$desaparecido->getNome()?></h3>
          <p><?=sprintf('%s, %s, %s',$desaparecido->getCor(), $desaparecido->getAltura(),$desaparecido->getTipoFisico())?></p>

          <h4>Contato</h4>
          <p><?=$desaparecido->getContato()?></p>

          <h4>Obs</h4>
          <p><?=$desaparecido->getObservacoes()?></p>
        </div>
        <?php endforeach ?>
      </div>

      <hr>

      <div class="footer">
        <p></p>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/js/bootstrap.min.js"></script>

  </body>
</html>
