<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LYLA</title>

<!-- colorpicker stylesheet -->
<link rel="stylesheet" type="text/css" href="colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="colorpicker/css/layout.css"/>

<!-- important stylesheets -->
<link rel="stylesheet" href="css/superfish.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:regular,bold" type="text/css" />
<link rel="stylesheet" href="css/default.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/pascal.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

<!-- important javascripts -->
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/supersubs.js" type="text/javascript"></script>
<script src="js/hoverIntent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/carousel.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js"></script>

<!-- colorpicker script -->
<script type="text/javascript" src="colorpicker/js/eye.js"></script>
<script type="text/javascript" src="colorpicker/js/utils.js"></script>
<script type="text/javascript" src="colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="colorpicker/js/scripts.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#testimonials_home')
	.after('<div id="nav2">')
	.cycle({
        fx: 'fade', // choose your transition type, ex: fade, scrollUp, scrollRight, shuffle
		speed: 3000,
		timeout: 2000
     });
});
</script>
</head>

<body>
<div class="main default-pat"> 
  
  <!---------------Begin header----------------------------------->
  <div class="header">
    <div class="head"> 
      <!---------------Begin Logo----------------------------------->
      <div class="logo">
        <h1><a href="index.php"><img src="images/logonew.png" alt="Logo" /></a></h1>
      </div>
      
      <!---------------End Logo-------------------------------------> 
      
      <!---------------Begin Menu--------------------------------->
      <div class="menu">
        <ul class="sf-menu">
          <li><a href="index.php">HOME</a></li>
          <li><a href="oque.php">O QUE É</a> </li>
          <li><a href="como.php">COMO FUNCIONA</a> </li>
          <li><a href="painel.php">PAINEL</a> </li>
          <li class="active"><a href="procurar.php">PROCURAR</a></li>
          <li><a href="contato.php">CONTATO</a></li>
        </ul>
      </div>
      <!---------------------------END Menu--------------------------> 
    </div>
    <div class="clear"></div>
  </div>
  <!---------------------EOF Header-------------------------->
  
  <div class="clear"></div>
  <div class="clear"></div>
  <!------------------------------Begin Row------------------------->
  <div class="row">
    <div style="text-align:center; width:960px; margin:0 auto; padding-bottom:30px;">
      <h1>PROCURAR</h1>
      <center>
        Funciona da seguinte forma: Preencha os campos com algumas 
        características da pessoa que quer encontrar, e não precisa ser exato. <br>
        Além disso, também <strong>não é necessário completar todos os campos</strong>. A intenção é resgatar todos os desaparecidos que sigam <strong>algum(ns)</strong> dos critérios 	determinados.<br>
        <br>
        <br />
        <form action="procurar.php" method="POST">
          <table>
            <tbody>
              <tr>
                <td>Nome</td>
                <td><input class="cad" id="nome" name="nome" type="text"></td>
              </tr>
              <tr>
                <td>Idade</td>
                <td>de
                  <select id="data_ini" name="data_ini">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    <option value="60">60</option>
                    <option value="61">61</option>
                    <option value="62">62</option>
                    <option value="63">63</option>
                    <option value="64">64</option>
                    <option value="65">65</option>
                    <option value="66">66</option>
                    <option value="67">67</option>
                    <option value="68">68</option>
                    <option value="69">69</option>
                    <option value="70">70</option>
                    <option value="71">71</option>
                    <option value="72">72</option>
                    <option value="73">73</option>
                    <option value="74">74</option>
                    <option value="75">75</option>
                    <option value="76">76</option>
                    <option value="77">77</option>
                    <option value="78">78</option>
                    <option value="79">79</option>
                    <option value="80">80</option>
                    <option value="" selected="selected"></option>
                  </select>
                  a
                  <select id="data_fim" name="data_fim">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    <option value="60">60</option>
                    <option value="61">61</option>
                    <option value="62">62</option>
                    <option value="63">63</option>
                    <option value="64">64</option>
                    <option value="65">65</option>
                    <option value="66">66</option>
                    <option value="67">67</option>
                    <option value="68">68</option>
                    <option value="69">69</option>
                    <option value="70">70</option>
                    <option value="71">71</option>
                    <option value="72">72</option>
                    <option value="73">73</option>
                    <option value="74">74</option>
                    <option value="75">75</option>
                    <option value="76">76</option>
                    <option value="77">77</option>
                    <option value="78">78</option>
                    <option value="79">79</option>
                    <option value="80">80</option>
                    <option value="" selected="selected"></option>
                  </select></td>
              </tr>
              <tr>
                <td>Altura</td>
                <td>entre
                  <input id="altura_ini" name="altura_ini" class="alt" type="text">
                  e
                  <input class="alt" id="altura_fim" name="altura_fim" type="text"></td>
              </tr>
              <tr>
                <td>Cor</td>
                <td><select class="cad" id="cor" name="cor">
                    <option value="" selected="selected"></option>
                    <option value="branco">branco</option>
                    <option value="negro">negro</option>
                    <option value="asiático">asiático</option>
                    <option value="indígena">indígena</option>
                    <option value="mulato">mulato</option>
                  </select></td>
              </tr>
              <tr>
                <td>Cidade do desaparecimento</td>
                <td><input class="cad" id="cidade_desap" name="cidade_desap" type="text"></td>
              </tr>
              <tr>
                <td>Estado do desaparecimento</td>
                <td><select class="cad" id="estado_desap" name="estado_desap">
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AM">AM</option>
                    <option value="AP">AP</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="" selected="selected"></option>
                    <option value="MG">MG</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RO">RO</option>
                    <option value="RS">RS</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SE">SE</option>
                    <option value="SP">SP</option>
                    <option value="TO">TO</option>
                  </select></td>
              </tr>
              <tr>
                <td>Cor dos olhos</td>
                <td><select class="cad" id="cor_olhos" name="cor_olhos">
                    <option value="castanho">castanho</option>
                    <option value="preto">preto</option>
                    <option value="azul">azul</option>
                    <option value="" selected="selected"></option>
                    <option value="verde">verde</option>
                    <option value="castanho-claro">castanho-claro</option>
                  </select></td>
              </tr>
              <tr>
                <td>Tipo físico</td>
                <td><select class="cad" id="tipo_fisico" name="tipo_fisico">
                    <option value="" selected="selected"></option>
                    <option value="obeso">obeso</option>
                    <option value="acima do peso">acima do peso</option>
                    <option value="normal">normal</option>
                    <option value="magro">magro</option>
                    <option value="muito magro">muito magro</option>
                  </select></td>
              </tr>
              <tr>
                <td>Contato</td>
                <td><input class="cad" id="contato" name="contato" type="text"></td>
              </tr>
              <tr>
                <td>Adicionais</td>
                <td><input class="cad" id="adicionais" name="adicionais" type="text"></td>
              </tr>
            </tbody>
          </table>
          <br>
         <a href="#"><img src="images/procurar.png" /></a>
        </form>
        <br>
        <br>
        <h2>Resultados</h2>
        <br>
        <br>
      </center>
    </div>
    <div class="clear"></div>
  </div>
</div>

<!------------------------------EOF Row-------------------------> 
<br />
<div class="clear"></div>
</div>

<!--------------------EOF lower_container--------------------------> 

<!--------------------EOF lower_container--------------------------> 

<!--------------------Begin lower_container-------------------------->

<div class="clear"></div>
</div>

<!--------------------EOF lower_container-------------------------->

<div class="clear"></div>
</div>
<div class="clear"></div>

<!------------------------EOF advert2-------------------------------------> 

<!-----------------EOF footer--------------------->

<div id="extra2">
  <div class="extra_main">
    <div class="extra_left">© 2012. Projeto LYLA</div>
    <div class="extra_right">
      <ul class="social">
        <li><a href="#"><img src="images/facebook-logo-square.png" width="32" height="32" alt="facebook" /></a></li>
        <li><a href="#"><img src="images/twitter-bird3-square.png" alt="twitter" width="32" height="32"/></a></li>
        <li><a href="#"><img src="images/rss-cube.png" width="32" height="32" alt="rss" /></a></li>
        <li><a href="#"><img src="images/linkedin-logo-square2.png" width="32" height="32" alt="linkedin" /></a></li>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!-----------------------------EOF extra2---------------------------------------->

</div>
<!---------------------------------EOF main---------------------------------------> 

<!--Nivo Slider script--> 
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script> 
<script type="text/javascript">
$(window).load(function() {
        $('#slider').nivoSlider({
		
        });
    });
    
</script>
</body>
</html>
