<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Antônio, Antoniocfilho.github.io">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css.css" media="screen"/>
  <link rel="shortcut icon" href="./image/icon_mask.ico">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<title>Corona Virus Global Update</title>
</head>
<body>
<?php
    if(isset($_POST['cadastre'])){
     $name = $_POST["name"];
  }
?>
<?php
if (empty($Flag_IMG)) {
    $Flag_IMG = "./image/totaldata.png";
}
?>
<div class="topnav">
  <a href="Antoniocfilho.github.io">Página Inicial</a>
  <a href="#" data-toggle="modal" data-target="#sobre">Sobre</a>
  <a href="#" data-toggle="modal" data-target="#prevencao">Prevenção</a>
  <a href="#" data-toggle="modal" data-target="#sintomas">Sintomas</a>
  <a href="#" data-toggle="modal" data-target="#duvidas">Dúvidas/Erros</a>
</div>
<section class="hero">
    <div class="background-image" style="background-image: url(./image/topo.jpg);"></div>
    <h1 style="padding-top: 250px; color: white; font-size:40px; text-shadow: black 0.1em 0.1em 0.2em">Corona Virus Global Update</h1>
    <div class="postman">
      <a style="opacity: 1;" href="covid-19-apis.postman.com" target="_blank">
      </a>
    </div>
  </section>
<form class="text-center border border-light p-5" action="" method="post" name="cadastre">
    <input type="text" name="name" id="search" class="form-control mb-4" placeholder="Procurar países. [Exemplo 'BR' ou 'brazil']">
    <button class="btn btn-info btn-block" name="cadastre"><span>Pesquisar</span></button>
</form>
</script>
<!-- API COVID 19 -->
<?php 
    $api_url = "https://api.covid19api.com/summary";
    @$json_data = file_get_contents($api_url);
    if (empty($json_data)) {
        header( "refresh:1;url=./index.php" );
        echo "<script type='text/javascript'>alert('Erro de conexão com a API que gera os dados, a página será atualizada');</script>";
        $NewConfirmed = 0; 
        $TotalConfirmed = 0;
        $NewDeaths = 0; 
        $TotalDeaths = 0; 
        $NewRecovered = 0; 
        $TotalRecovered = 0;
    }else{
    $user_data = json_decode($json_data,false);
      $NewConfirmed = number_format($user_data->Global->NewConfirmed,0,',','.'); 
      $TotalConfirmed = number_format($user_data->Global->TotalConfirmed,0,',','.');
      $NewDeaths = number_format($user_data->Global->NewDeaths,0,',','.'); 
      $TotalDeaths = number_format($user_data->Global->TotalDeaths,0,',','.'); 
      $NewRecovered = number_format($user_data->Global->NewRecovered,0,',','.'); 
      $TotalRecovered = number_format($user_data->Global->TotalRecovered,0,',','.');

      //String
      @$busca = $name;
      $tamanho = strlen($busca);
      if($tamanho>2){
       $busca = ucwords($busca);
      }else{
       $busca = strtoupper($busca);
      }
      //Busca Global
      if(($busca=='global')OR($busca=='GLOBAL')){
       $NewConfirmed = number_format($user_data->Global->NewConfirmed,0,',','.'); 
       $TotalConfirmed = number_format($user_data->Global->TotalConfirmed,0,',','.');
       $NewDeaths = number_format($user_data->Global->NewDeaths,0,',','.'); 
       $TotalDeaths = number_format($user_data->Global->TotalDeaths,0,',','.'); 
       $NewRecovered = number_format($user_data->Global->NewRecovered,0,',','.'); 
       $TotalRecovered = number_format($user_data->Global->TotalRecovered,0,',','.');
      }
      //Flags
      for($i = 0; $i < 186; $i++){
       $var = $user_data->Countries[$i]->Country;
       $CountryCode = $user_data->Countries[$i]->CountryCode;
        if(($var==$busca) OR ($CountryCode==$busca)){
         $NewConfirmed = number_format($user_data->Countries[$i]->NewConfirmed,0,',','.'); 
         $TotalConfirmed = number_format($user_data->Countries[$i]->TotalConfirmed,0,',','.'); 
         $NewDeaths = number_format($user_data->Countries[$i]->NewDeaths,0,',','.'); 
         $TotalDeaths = number_format($user_data->Countries[$i]->TotalDeaths,0,',','.');
         $NewRecovered = number_format($user_data->Countries[$i]->NewRecovered,0,',','.'); 
         $TotalRecovered = number_format($user_data->Countries[$i]->TotalRecovered,0,',','.'); 
         $Country = $user_data->Countries[$i]->Country; 
         $CountryCode = $user_data->Countries[$i]->CountryCode;
         $CountryCode_IMG=$CountryCode;
         $json_data_IMG = file_get_contents("http://raw.githubusercontent.com/Antoniocfilho/Project_Flags/master/countries.json"); 
         $user_data_IMG = json_decode($json_data_IMG);
           for($i = 0; $i < 186; $i++){
             $var_IMG = $user_data_IMG->Countries[$i]->CountryCode;
              if($var_IMG==$CountryCode_IMG){
                 $link_IMG = $user_data_IMG->Countries[$i]->Flag; 
              }
            }
            $Flag_IMG = "$link_IMG";
         }else{
         }
         }
         }  
      ?>
<div id="flag"><img style="width: 418px; height: 250px;" src="<?php echo $Flag_IMG; ?>"></div>
<div id="container">
<div class="card-deck">
<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
  <div class="card-header" style="text-align: center"><b>Novos Casos</b></div>
  <div class="card-body" style="padding-top: 50px;">
    <h5 style="text-align: center" class="card-text"><b><font style="font-size:30px" face="Arial"><?php echo $NewConfirmed; ?></font></b></h5>
    <p>&nbsp;</p><h5 style="text-align: center"><b><font style="font-size:10px" face="Arial"><?php echo $user_data->Date; ?></font></b></h5>
  </div>
</div>
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header" style="text-align: center"><b>Casos Confirmados</b></div>
  <div class="card-body" style="padding-top: 50px;">
    <h5 style="text-align: center" class="card-text"><b><font style="font-size:30px" face="Arial"><?php echo $TotalConfirmed; ?></font></b></h5>
    <p>&nbsp;</p><h5 style="text-align: center"><b><font style="font-size:10px" face="Arial"><?php echo $user_data->Date; ?></font></b></h5>
  </div>
</div>
<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header" style="text-align: center"><b>Novas Mortes</b></div>
  <div class="card-body" style="padding-top: 50px;">
    <h5 style="text-align: center" class="card-text"><b><font style="font-size:30px" face="Arial"><?php echo $NewDeaths; ?></font></b></h5>
    <p>&nbsp;</p><h5 style="text-align: center"><b><font style="font-size:10px" face="Arial"><?php echo $user_data->Date; ?></font></b></h5>
  </div>
</div>
<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-header" style="text-align: center"><b>Total de Mortes</b></div>
  <div class="card-body" style="padding-top: 50px;">
    <h5 style="text-align: center" class="card-text"><b><font style="font-size:30px" face="Arial"><?php echo $TotalDeaths; ?></font></b></h5>
   <p>&nbsp;</p><h5 style="text-align: center"><b><font style="font-size:10px" face="Arial"><?php echo $user_data->Date; ?></font></b></h5>
  </div>
</div>
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header" style="text-align: center"><b>Novos Recuperados</b></div>
  <div class="card-body" style="padding-top: 50px;">
    <h5 style="text-align: center" class="card-text"><b><font style="font-size:30px" face="Arial"><?php echo $NewRecovered; ?></font></b></h5>
    <p>&nbsp;</p><h5 style="text-align: center"><b><font style="font-size:10px" face="Arial"><?php echo $user_data->Date; ?></font></b></h5>
  </div>
</div>
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header" style="text-align: center"><b>Recuperados</b></div>
  <div class="card-body" style="padding-top: 50px;">
    <h5 style="text-align: center" class="card-text"><b><font size="6" face="Arial"><?php echo $TotalRecovered; ?></font></b></h5>
    <p>&nbsp;</p><h5 style="text-align: center"><b><font style="font-size:0.5vw" face="Arial"><?php echo $user_data->Date; ?></font></b></h5>
  </div>
</div>
</div>
</div>
</div>
</div>

<!-- Modal Sintomas -->
<div class="modal fade" id="sintomas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sintomas do COVID-19</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong><span style="color:#000000">Lembrete:</span></strong></p>
<ul>
  <li><span style="font-size:12px"><strong>Qualquer pessoa pode ter sintomas leves a graves.</strong></span></li>
</ul>
<ul>
  <li><strong>Adultos mais velhos e pessoas que t&ecirc;m condi&ccedil;&otilde;es m&eacute;dicas subjacentes graves,</strong>&nbsp;como doen&ccedil;a card&iacute;aca ou pulmonar ou diabetes, parecem estar em maior risco de desenvolver complica&ccedil;&otilde;es mais graves da doen&ccedil;a de COVID-19.</li>
</ul>
<p>Os sintomas podem aparecer&nbsp;<strong>2-14 dias ap&oacute;s a exposi&ccedil;&atilde;o&nbsp;</strong><strong>ao v&iacute;rus.&nbsp;</strong>Pessoas com esses sintomas podem ter COVID-19:</p>
<p><span style="color:#000000"><strong>Sintomas Comuns:</strong></span></p>
<ul>
  <li>Tosse</li>
  <li>Falta de ar ou dificuldade em respirar</li>
  <li>Febre</li>
  <li>Arrepios</li>
  <li>Dor muscular</li>
  <li>Dor de garganta</li>
  <li>Nova perda de paladar ou olfato</li>
</ul>
<p><span style="color:#000000"><strong>Sintomas menos comuns</strong></span></p>
<ul>
  <li>n&aacute;usea</li>
  <li>v&ocirc;mito</li>
  <li>diarr&eacute;ia</li>
</ul>
<p><strong>Quando procurar atendimento m&eacute;dico de emerg&ecirc;ncia?</strong></p>
<p>Olhe para&nbsp;<strong>sinais de alerta de emerg&ecirc;ncia *</strong>&nbsp;&nbsp;para COVID-19.&nbsp;Se algu&eacute;m apresentar algum destes sinais,&nbsp;<strong>procure atendimento m&eacute;dico de emerg&ecirc;ncia&nbsp;</strong><strong>imediatamente!!</strong></p>
<ul>
  <li><strong><span style="color:#000000">Problemas respirat&oacute;rios</span></strong></li>
  <li><strong><span style="color:#000000">Dor ou press&atilde;o persistente no peito</span></strong></li>
  <li><strong><span style="color:#000000">Nova confus&atilde;o</span></strong></li>
  <li><strong><span style="color:#000000">Incapacidade de acordar ou permanecer acordado</span></strong></li>
  <li><strong><span style="color:#000000">L&aacute;bios ou rosto azulados</span></strong></li>
</ul>
<p>* Esta lista n&atilde;o &eacute; todos os sintomas poss&iacute;veis.&nbsp;Entre em contato com seu m&eacute;dico para qualquer outro sintoma grave ou relacionado a voc&ecirc;.</p>
<p>Fonte: CDC - Centro de Controle e Preven&ccedil;&atilde;o de Doen&ccedil;as, <a href="https://www.cdc.gov/coronavirus/2019-ncov/symptoms-testing/symptoms.html"><strong>Link</strong></a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Sobre -->
<div class="modal fade" id="sobre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sobre o Projeto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h4 style="text-align: center;"><span style="font-size:20px"><strong>Projeto&nbsp;Corona Virus Global Update</strong></span></h4>
        <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
        <p style="text-align: center;"><span style="font-size:20px"><strong>&copy; 2020&nbsp;- Ant&ocirc;nio | Antoniocfilho.github.io</strong></span></p><h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="prevencao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prevencão do COVID-19</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3><strong>Preven&ccedil;&atilde;o</strong></h3>
<p><span style="color:#000000"><strong>Lave as m&atilde;os frequentemente:</strong></span></p>
<ul>
  <li>Lave as m&atilde;os&nbsp;frequentemente com &aacute;gua e sab&atilde;o por pelo menos 20 segundos, especialmente depois de estar em um local p&uacute;blico ou depois de assoar o nariz, tossir ou espirrar.</li>
  <li>Se &aacute;gua e sab&atilde;o n&atilde;o estiverem prontamente dispon&iacute;veis,&nbsp;<strong>use um desinfetante para as m&atilde;os que contenha pelo menos 60% de &aacute;lcool</strong>&nbsp;.&nbsp;Cubra todas as superf&iacute;cies de suas m&atilde;os e esfregue-as juntas at&eacute; que se sintam secas.</li>
  <li><strong>Evite tocar nos&nbsp;</strong><strong>olhos, nariz e boca</strong>&nbsp;com as m&atilde;os n&atilde;o lavadas.</li>
</ul>
<p><span style="color:#000000"><strong>Evite contato pr&oacute;ximo</strong></span></p>
<ul>
  <li><strong>Evite contato pr&oacute;ximo com pessoas doentes, mesmo dentro de sua casa.&nbsp;</strong>Se poss&iacute;vel, mantenha um metro e meio entre a pessoa doente e outros membros da fam&iacute;lia.</li>
  <li><strong>Coloque dist&acirc;ncia entre voc&ecirc; e outras pessoas fora de sua casa</strong>&nbsp;.
  <ul>
    <li>Lembre-se de que algumas pessoas sem sintomas podem espalhar v&iacute;rus.</li>
    <li>Fique a pelo menos 6 p&eacute;s (cerca de 2 bra&ccedil;os) de outras pessoas&nbsp;.</li>
    <li>N&atilde;o se re&uacute;na em grupos.</li>
    <li>Fique longe de lugares lotados e evite reuni&otilde;es de massa.</li>
    <li>Manter dist&acirc;ncia de outras pessoas &eacute; especialmente importante para&nbsp;pessoas com maior risco de ficarem muito doentes&nbsp;.</li>
  </ul>
  </li>
</ul>
<p>&iacute;cone de m&aacute;scara do lado da cabe&ccedil;a</p>
<p><span style="color:#000000"><strong>Cubra a boca e o nariz com uma capa de pano quando estiver perto de outras pessoas</strong></span></p>
<ul>
  <li>Voc&ecirc; pode espalhar o COVID-19 para outras pessoas, mesmo que n&atilde;o se sinta doente.</li>
  <li>Todos devem usar uma&nbsp;capa de pano&nbsp;quando tiverem que sair em p&uacute;blico, por exemplo, ao supermercado ou para atender a outras necessidades.
  <ul>
    <li>As coberturas faciais de pano n&atilde;o devem ser colocadas em crian&ccedil;as menores de 2 anos, em quem tem dificuldade em respirar ou est&aacute; inconsciente, incapacitado ou incapaz de remover a m&aacute;scara sem assist&ecirc;ncia.</li>
  </ul>
  </li>
  <li>A tampa do rosto de pano destina-se a proteger outras pessoas, caso voc&ecirc; esteja infectado.</li>
  <li>N&Atilde;O use uma m&aacute;scara destinada a um profissional de sa&uacute;de.</li>
  <li>Continue mantendo cerca de 1,80 m entre voc&ecirc; e os outros.&nbsp;A capa de pano n&atilde;o substitui o distanciamento social.</li>
</ul>
<p><span style="color:#000000"><strong>Cobrir tosses e espirros</strong></span></p>
<ul>
  <li><strong>Se voc&ecirc; estiver em um ambiente privado e n&atilde;o tiver cobertura de rosto em pano, lembre-se de sempre cobrir a boca e o nariz</strong>&nbsp;com um len&ccedil;o de papel quando tossir ou espirrar ou usar a parte interna do cotovelo.</li>
  <li><strong>Jogue tecidos usados</strong>&nbsp;no lixo.</li>
  <li><strong>Lave</strong>&nbsp;imediatamente&nbsp;<strong>as m&atilde;os</strong>&nbsp;com &aacute;gua e sab&atilde;o por pelo menos 20 segundos.&nbsp;Se sab&atilde;o e &aacute;gua n&atilde;o estiverem prontamente dispon&iacute;veis, limpe as m&atilde;os com um desinfetante para as m&atilde;os que contenha pelo menos 60% de &aacute;lcool.</li>
</ul>
<p><span style="color:#000000"><strong>Limpe e desinfete</strong></span></p>
<ul>
  <li><strong>Limpe e desinfete&nbsp;as superf&iacute;cies frequentemente tocadas&nbsp;&nbsp;diariamente</strong>&nbsp;.&nbsp;Isso inclui mesas, ma&ccedil;anetas, interruptores de luz, bancadas, pegas, mesas, telefones, teclados, banheiros, torneiras e pias.</li>
  <li><strong>Se as superf&iacute;cies estiverem sujas, limpe-as.&nbsp;</strong>Use detergente ou sab&atilde;o e &aacute;gua antes da desinfec&ccedil;&atilde;o.</li>
  <li><strong>Em seguida, use um desinfetante dom&eacute;stico.&nbsp;</strong>Desinfetantes dom&eacute;sticos&nbsp;mais comuns&nbsp;registrados na EPA&iacute;cone externo&nbsp;vai funcionar.</li>
</ul>
<address>&nbsp;</address>
      <p>Fonte: CDC - Centro de Controle e Preven&ccedil;&atilde;o de Doen&ccedil;as, <a href="https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/prevention.html"><strong>Link</strong></a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="duvidas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Dúvidas Sobre o Projeto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<p><strong>Se voc&ecirc; n&atilde;o conseguiu&nbsp;encontrar o seu p&aacute;is buscando, o sistema foi feito usando uma API de terceiros geradora de dados atualizados sobre a COVID-19&nbsp;e para buscar pa&iacute;ses deve-se digitar o nome do pa&iacute;s em ingl&ecirc;s ou o seu c&oacute;digo</strong></p>

<ul>
  <li>Caso digite um nome invalido de um p&aacute;is, a aplica&ccedil;&atilde;o retornar&aacute; mostrando os dados globais sobre a covid-19</li>
</ul>

<p><strong>&nbsp; &nbsp; &nbsp; Digite: global para mostrar os dados do mundo</strong></p>

<p>&nbsp; &nbsp; &nbsp; Digite: Afghanistan ou o C&oacute;digo: AF<br />
&nbsp; &nbsp; &nbsp; Digite: Albania ou o C&oacute;digo: AL&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Algeria ou o C&oacute;digo: DZ<br />
&nbsp; &nbsp; &nbsp; Digite: Andorra ou o C&oacute;digo: AD&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Angola ou o C&oacute;digo: AO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Antigua Barbuda ou o C&oacute;digo: AG<br />
&nbsp; &nbsp; &nbsp; Digite: Argentina ou o C&oacute;digo: AR<br />
&nbsp; &nbsp; &nbsp; Digite: Armenia ou o C&oacute;digo: AM<br />
&nbsp; &nbsp; &nbsp; Digite: Australia ou o C&oacute;digo: AU&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Austria ou o C&oacute;digo: AT<br />
&nbsp; &nbsp; &nbsp; Digite: Azerbaijan ou o C&oacute;digo: AZ<br />
&nbsp; &nbsp; &nbsp; Digite: Bahamas ou o C&oacute;digo: BS<br />
&nbsp; &nbsp; &nbsp; Digite: Bahrain ou o C&oacute;digo: BH<br />
&nbsp; &nbsp; &nbsp; Digite: Bangladesh ou o C&oacute;digo: BD&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Barbados ou o C&oacute;digo: BB&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Belarus ou o C&oacute;digo: BY&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Belgium ou o C&oacute;digo: BE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Belize ou o C&oacute;digo: BZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Benin ou o C&oacute;digo: BJ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Bhutan ou o C&oacute;digo: BT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Bolivia ou o C&oacute;digo: BO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Bosnia ou o C&oacute;digo: BA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Botswana ou o C&oacute;digo: BW&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Brazil ou o C&oacute;digo: BR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Brunei ou o C&oacute;digo: BN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Bulgaria ou o C&oacute;digo: BG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Burkina Faso ou o C&oacute;digo: BF&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Burundi ou o C&oacute;digo: BI&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Cambodia ou o C&oacute;digo: KH&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Cameroon ou o C&oacute;digo: CM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Canada ou o C&oacute;digo: CA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Cape Verde ou o C&oacute;digo: CV&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Central African Republic ou o C&oacute;digo: CF&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Chad ou o C&oacute;digo: TD&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Chile ou o C&oacute;digo: CL&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: China ou o C&oacute;digo: CN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Colombia ou o C&oacute;digo: CO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Comoros ou o C&oacute;digo: KM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Congo (Brazzaville) ou o C&oacute;digo: CG &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Congo (Kinshasa) ou o C&oacute;digo: CD &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Costa Rica ou o C&oacute;digo: CR &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Croatia ou o C&oacute;digo: HR &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Cuba ou o C&oacute;digo: CU &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Cyprus ou o C&oacute;digo: CY&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Czech Republic ou o C&oacute;digo: CZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: C&ocirc;te d&#39;Ivoire ou o C&oacute;digo: CI&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Denmark ou o C&oacute;digo: DK&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Djibouti ou o C&oacute;digo: DJ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Dominica ou o C&oacute;digo: DM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Dominican Republic ou o C&oacute;digo: DO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Ecuador ou o C&oacute;digo: EC &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Egypt ou o C&oacute;digo: EG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: El Salvador ou o C&oacute;digo: SV&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Equatorial Guinea ou o C&oacute;digo: GQ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Eritrea ou o C&oacute;digo: ER&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Estonia ou o C&oacute;digo: EE &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Ethiopia ou o C&oacute;digo: ET&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Fiji ou o C&oacute;digo: FJ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Finland ou o C&oacute;digo: FI&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: France ou o C&oacute;digo: FR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Gabon ou o C&oacute;digo: GA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Gambia ou o C&oacute;digo: GM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Georgia ou o C&oacute;digo: GE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Germany ou o C&oacute;digo: DE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Ghana ou o C&oacute;digo: GH&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Greece ou o C&oacute;digo: GR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Grenada ou o C&oacute;digo: GD&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Guatemala ou o C&oacute;digo: GT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Guinea ou o C&oacute;digo: GN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Guinea-Bissau ou o C&oacute;digo: GW&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Guyana ou o C&oacute;digo: GY<br />
&nbsp; &nbsp; &nbsp; Digite: Haiti ou o C&oacute;digo: HT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Holy See (Vatican City State) ou o C&oacute;digo: VA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Honduras ou o C&oacute;digo: HN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Hungary ou o C&oacute;digo: HU&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Iceland ou o C&oacute;digo: IS&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: India ou o C&oacute;digo: IN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Indonesia ou o C&oacute;digo: ID&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Iran ou &nbsp;Islamic Republic of ou o C&oacute;digo: IR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Iraq ou o C&oacute;digo: IQ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Ireland ou o C&oacute;digo: IE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Israel ou o C&oacute;digo: IL<br />
&nbsp; &nbsp; &nbsp; Digite: Italy ou o C&oacute;digo: IT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Jamaica ou o C&oacute;digo: JM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Japan ou o C&oacute;digo: JP&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Jordan ou o C&oacute;digo: JO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Kazakhstan ou o C&oacute;digo: KZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Kenya ou o C&oacute;digo: KE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Korea (South) ou o C&oacute;digo: KR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Kuwait ou o C&oacute;digo: KW&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Kyrgyzstan ou o C&oacute;digo: KG<br />
&nbsp; &nbsp; &nbsp; Digite: Lao PDR ou o C&oacute;digo: LA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Latvia ou o C&oacute;digo: LV&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Lebanon ou o C&oacute;digo: LB&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Lesotho ou o C&oacute;digo: LS&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Liberia ou o C&oacute;digo: LR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Libya ou o C&oacute;digo: LY&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Liechtenstein ou o C&oacute;digo: LI&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Lithuania ou o C&oacute;digo: LT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Luxembourg ou o C&oacute;digo: LU&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Macedonia ou &nbsp;Republic of ou o C&oacute;digo: MK&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Madagascar ou o C&oacute;digo: MG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Malawi ou o C&oacute;digo: MW&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Malaysia ou o C&oacute;digo: MY&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Maldives ou o C&oacute;digo: MV<br />
&nbsp; &nbsp; &nbsp; Digite: Mali ou o C&oacute;digo: ML&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Malta ou o C&oacute;digo: MT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Mauritania ou o C&oacute;digo: MR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Mauritius ou o C&oacute;digo: MU&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Mexico ou o C&oacute;digo: MX&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Moldova ou o C&oacute;digo: MD&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Monaco ou o C&oacute;digo: MC&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Mongolia ou o C&oacute;digo: MN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Montenegro ou o C&oacute;digo: ME&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Morocco ou o C&oacute;digo: MA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Mozambique ou o C&oacute;digo: MZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Myanmar ou o C&oacute;digo: MM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Namibia ou o C&oacute;digo: NA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Nepal ou o C&oacute;digo: NP&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Netherlands ou o C&oacute;digo: NL&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: New Zealand ou o C&oacute;digo: NZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Nicaragua ou o C&oacute;digo: NI&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Niger ou o C&oacute;digo: NE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Nigeria ou o C&oacute;digo: NG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Norway ou o C&oacute;digo: NO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Oman ou o C&oacute;digo: OM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Pakistan ou o C&oacute;digo: PK&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Palestinian Territory ou o C&oacute;digo: PS&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Panama ou o C&oacute;digo: PA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Papua New Guinea ou o C&oacute;digo: PG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Paraguay ou o C&oacute;digo: PY&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Peru ou o C&oacute;digo: PE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Philippines ou o C&oacute;digo: PH&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Poland ou o C&oacute;digo: PL&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Portugal ou o C&oacute;digo: PT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Qatar ou o C&oacute;digo: QA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Republic of Kosovo ou o C&oacute;digo: XK&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Romania ou o C&oacute;digo: RO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Russian Federation ou o C&oacute;digo: RU&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Rwanda ou o C&oacute;digo: RW&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Saint Kitts and Nevis ou o C&oacute;digo: KN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Saint Lucia ou o C&oacute;digo: LC&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Saint Vincent ou o C&oacute;digo: VC&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: San Marino ou o C&oacute;digo: SM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Sao Tome and Principe ou o C&oacute;digo: ST&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Saudi Arabia ou o C&oacute;digo: SA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Senegal ou o C&oacute;digo: SN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Serbia ou o C&oacute;digo: RS&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Seychelles ou o C&oacute;digo: SC&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Sierra Leone ou o C&oacute;digo: SL&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Singapore ou o C&oacute;digo: SG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Slovakia ou o C&oacute;digo: SK&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Slovenia ou o C&oacute;digo: SI&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Somalia ou o C&oacute;digo: SO&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: South Africa ou o C&oacute;digo: ZA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: South Sudan ou o C&oacute;digo: SS&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Spain ou o C&oacute;digo: ES&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Sri Lanka ou o C&oacute;digo: LK&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Sudan ou o C&oacute;digo: SD&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Suriname ou o C&oacute;digo: SR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Swaziland ou o C&oacute;digo: SZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Sweden ou o C&oacute;digo: SE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Switzerland ou o C&oacute;digo: CH&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Syrian Arab Republic (Syria) ou o C&oacute;digo: SY&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Taiwan ou &nbsp;Republic of China ou o C&oacute;digo: TW&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Tajikistan ou o C&oacute;digo: TJ ou&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Tanzania ou &nbsp;United Republic of ou o C&oacute;digo: TZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Thailand ou o C&oacute;digo: TH&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Timor-Leste ou o C&oacute;digo: TL &nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Togo ou o C&oacute;digo: TG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Trinidad and Tobago ou o C&oacute;digo: TT&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Tunisia ou o C&oacute;digo: TN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Turkey ou o C&oacute;digo: TR&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Uganda ou o C&oacute;digo: UG&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Ukraine ou o C&oacute;digo: UA&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: United Arab Emirates ou o C&oacute;digo: AE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: United Kingdom ou o C&oacute;digo: GB ou&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: United States of America ou o C&oacute;digo: US&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Uruguay ou o C&oacute;digo: UY&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Uzbekistan ou o C&oacute;digo: UZ&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Venezuela (Bolivarian Republic) ou o C&oacute;digo: VE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Viet Nam ou o C&oacute;digo: VN&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Western Sahara ou o C&oacute;digo: EH&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Yemen ou o C&oacute;digo: YE&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Zambia ou o C&oacute;digo: ZM&nbsp;<br />
&nbsp; &nbsp; &nbsp; Digite: Zimbabwe ou o C&oacute;digo: ZW&nbsp;</p>
<address>&nbsp;</address>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</div>
<footer>
  <div class="text-center">Copyright &copy; 2020 <span>Antônio | Antoniocfilho.github.io </span></div>
</footer>
</body>
</html>
