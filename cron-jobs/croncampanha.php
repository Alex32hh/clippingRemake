<?php
setlocale(LC_TIME, 'pt_PT', 'pt_BR.utf-8', 'pt_PT.utf-8', 'portuguese');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try { 
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'manifext_Alexandre');
        define('DB_PASSWORD', 'Francisco32hh01');
        define('DB_DATABASE', 'manifext_clipping');
        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
       
        // define('DB_SERVER', 'localhost');
        // define('DB_USERNAME', 'root');
        // define('DB_PASSWORD', 'root');
        // define('DB_DATABASE', 'id11598184_usuarios');
        // $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    $mail = new PHPMailer();


        $sql = "SELECT * FROM campanha";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            if($row['activado'] == '' ){
              if(date('H:i') == $row['frequencia'] ||  str_pad((explode(':',date('H:i'))[0]+1), 2, '0', STR_PAD_LEFT) == explode(':',$row['frequencia'])[0]){
              $mail->IsSMTP();
              $mail->CharSet = 'utf-8';
              $mail->Host       = "send.one.com";
              $mail->SMTPDebug  = 1;
              $mail->SMTPAuth   = true;
              $mail->Port       = 587;
              $mail->Username   = "noreply@manifexto.com"; 
              $mail->Password   = "Man1fexto!";  
              $mail->setFrom('noreply@manifexto.com','ManifextoClipping');
              $mail->isHTML(true);
             
              $mail->Body  = '<title>Push Email</title>
              <link rel="shortcut icon" href="favicon.ico">
              <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
              <style type="text/css">
              table[name="blk_permission"], table[name="blk_footer"] {display:none;} 
              </style>
              
              <meta name="googlebot" content="noindex" />
              <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"/><link rel="stylesheet" href="/style/dhtmlwindow.css" type="text/css" />
              <script type="text/javascript" src="/script/dhtmlwindow.js">
        
              </script>
              <link rel="stylesheet" href="/style/modal.css" type="text/css" />
              <script type="text/javascript" src="/script/modal.js"></script>
              <script type="text/javascript">
                function show_popup(popup_name,popup_url,popup_title,width,height) {var widthpx = width +  "px";var heightpx = height +  "px";emailwindow = dhtmlmodal.open(popup_name , \'iframe\', popup_url , popup_title , \'width=\' + widthpx + \',height=\'+ heightpx + \',center=1,resize=0,scrolling=1\');}
               function show_modal(popup_name,popup_url,popup_title,width,height){var widthpx = width +  "px";var heightpx = height +  "px";emailwindow = dhtmlmodal.open(popup_name , \'iframe\', popup_url , popup_title , \'width=\' + widthpx + \',height=\'+ heightpx + \',modal=1,center=1,resize=0,scrolling=1\');}
              var popUpWin=0;
                function popUpWindow(URLStr,PopUpName, width, height){if(popUpWin) { if(!popUpWin.closed) popUpWin.close();}var left = (screen.width - width) / 2;var top = (screen.height - height) / 2;popUpWin = open(URLStr, PopUpName, \'toolbar=0,location=0,directories=0,status=0,menub ar=0,scrollbar=0,resizable=0,copyhistory=yes,width=\'+width+\',height=\'+height+\',left=\'+left+\',   top=\'+top+\',screenX=\'+left+\',screenY=\'+top+\'\');}
              </script>
                  
              <meta content="width=device-width, initial-scale=1.0" name="viewport">    
              <style type="text/css">    
              /*** BMEMBF Start ***/    
              [name=bmeMainBody]{min-height:1000px;}    
              @font-face{font-family:"bo";src: url("http://burrinho.co.ao/cuyabra bold.otf");}
              @media only screen and (max-width: 480px){table.blk, table.tblText, .bmeHolder, .bmeHolder1, table.bmeMainColumn{width:100% !important;} }        
              @media only screen and (max-width: 480px){.bmeImageCard table.bmeCaptionTable td.tblCell{padding:0px 20px 20px 20px !important;} }        
              @media only screen and (max-width: 480px){.bmeImageCard table.bmeCaptionTable.bmeCaptionTableMobileTop td.tblCell{padding:20px 20px 0 20px !important;} }        
              @media only screen and (max-width: 480px){table.bmeCaptionTable td.tblCell{padding:10px !important;} }        
              @media only screen and (max-width: 480px){table.tblGtr{ padding-bottom:20px !important;} }        
              @media only screen and (max-width: 480px){td.blk_container, .blk_parent, .bmeLeftColumn, .bmeRightColumn, .bmeColumn1, .bmeColumn2, .bmeColumn3, .bmeBody{display:table !important;max-width:600px !important;width:100% !important;} }        
              @media only screen and (max-width: 480px){table.container-table, .bmeheadertext, .container-table { width: 95% !important; } }        
              @media only screen and (max-width: 480px){.mobile-footer, .mobile-footer a{ font-size: 13px !important; line-height: 18px !important; } .mobile-footer{ text-align: center !important; } table.share-tbl { padding-bottom: 15px; width: 100% !important; } table.share-tbl td { display: block !important; text-align: center !important; width: 100% !important; } }        
              @media only screen and (max-width: 480px){td.bmeShareTD, td.bmeSocialTD{width: 100% !important; } }        
              @media only screen and (max-width: 480px){td.tdBoxedTextBorder{width: auto !important;}}    
              @media only screen and (max-width: 480px){table.blk, table[name=tblText], .bmeHolder, .bmeHolder1, table[name=bmeMainColumn]{width:100% !important;} }    
              @media only screen and (max-width: 480px){.bmeImageCard table.bmeCaptionTable td[name=tblCell]{padding:0px 20px 20px 20px !important;} }    
              @media only screen and (max-width: 480px){.bmeImageCard table.bmeCaptionTable.bmeCaptionTableMobileTop td[name=tblCell]{padding:20px 20px 0 20px !important;} }    
              @media only screen and (max-width: 480px){table.bmeCaptionTable td[name=tblCell]{padding:10px !important;} }    
              @media only screen and (max-width: 480px){table[name=tblGtr]{ padding-bottom:20px !important;} }    
              @media only screen and (max-width: 480px){td.blk_container, .blk_parent, [name=bmeLeftColumn], [name=bmeRightColumn], [name=bmeColumn1], [name=bmeColumn2], [name=bmeColumn3], [name=bmeBody]{display:table !important;max-width:600px !important;width:100% !important;} }    
              @media only screen and (max-width: 480px){table[class=container-table], .bmeheadertext, .container-table { width: 95% !important; } }    
              @media only screen and (max-width: 480px){.mobile-footer, .mobile-footer a{ font-size: 13px !important; line-height: 18px !important; } .mobile-footer{ text-align: center !important; } table[class="share-tbl"] { padding-bottom: 15px; width: 100% !important; } table[class="share-tbl"] td { display: block !important; text-align: center !important; width: 100% !important; } }    
              @media only screen and (max-width: 480px){td[name=bmeShareTD], td[name=bmeSocialTD]{width: 100% !important; } }    
              @media only screen and (max-width: 480px){td[name=tdBoxedTextBorder]{width: auto !important;}}    
              @media only screen and (max-width: 480px){.bmeImageCard table.bmeImageTable{height: auto !important; width:100% !important; padding:20px !important;clear:both; float:left !important; border-collapse: separate;} }    
              @media only screen and (max-width: 480px){.bmeMblInline table.bmeImageTable{height: auto !important; width:100% !important; padding:10px !important;clear:both;} }    
              @media only screen and (max-width: 480px){.bmeMblInline table.bmeCaptionTable{width:100% !important; clear:both;} }    
              @media only screen and (max-width: 480px){table.bmeImageTable{height: auto !important; width:100% !important; padding:10px !important;clear:both; } }    
              @media only screen and (max-width: 480px){table.bmeCaptionTable{width:100% !important;  clear:both;} }    
              @media only screen and (max-width: 480px){table.bmeImageContainer{width:100% !important; clear:both; float:left !important;} }    
              @media only screen and (max-width: 480px){table.bmeImageTable td{padding:0px !important; height: auto; } }    
              @media only screen and (max-width: 480px){td.bmeImageContainerRow{padding:0px !important;}}    
              @media only screen and (max-width: 480px){img.mobile-img-large{width:100% !important; height:auto !important;} }    
              @media only screen and (max-width: 480px){img.bmeRSSImage{max-width:320px; height:auto !important;}}    
              @media only screen and (min-width: 640px){img.bmeRSSImage{max-width:600px !important; height:auto !important;} }    
              @media only screen and (max-width: 480px){.trMargin img{height:10px;} }    
              @media only screen and (max-width: 480px){div.bmefooter, div.bmeheader{ display:block !important;} }    
              @media only screen and (max-width: 480px){.tdPart{ width:100% !important; clear:both; float:left !important; } }    
              @media only screen and (max-width: 480px){table.blk_parent1, table.tblPart {width: 100% !important; } }    
              @media only screen and (max-width: 480px){.tblLine{min-width: 100% !important;}}     
              @media only screen and (max-width: 480px){.bmeMblCenter img { margin: 0 auto; } }       
              @media only screen and (max-width: 480px){.bmeMblCenter, .bmeMblCenter div, .bmeMblCenter span  { text-align: center !important; text-align: -webkit-center !important; } }    
              @media only screen and (max-width: 480px){.bmeNoBr br, .bmeImageGutterRow, .bmeMblStackCenter .bmeShareItem .tdMblHide { display: none !important; } }    
              @media only screen and (max-width: 480px){.bmeMblInline table.bmeImageTable, .bmeMblInline table.bmeCaptionTable, td.bmeMblInline { clear: none !important; width:50% !important; } }    
              @media only screen and (max-width: 480px){.bmeMblInlineHide, .bmeShareItem .trMargin { display: none !important; } }    
              @media only screen and (max-width: 480px){.bmeMblInline table.bmeImageTable img, .bmeMblShareCenter.tblContainer.mblSocialContain, .bmeMblFollowCenter.tblContainer.mblSocialContain{width: 100% !important; } }    
              @media only screen and (max-width: 480px){.bmeMblStack> .bmeShareItem{width: 100% !important; clear: both !important;} }    
              @media only screen and (max-width: 480px){.bmeShareItem{padding-top: 10px !important;} }    
              @media only screen and (max-width: 480px){.tdPart.bmeMblStackCenter, .bmeMblStackCenter .bmeFollowItemIcon {padding:0px !important; text-align: center !important;} }    
              @media only screen and (max-width: 480px){.bmeMblStackCenter> .bmeShareItem{width: 100% !important;} }    
              @media only screen and (max-width: 480px){ td.bmeMblCenter {border: 0 none transparent !important;}}    
              @media only screen and (max-width: 480px){.bmeLinkTable.tdPart td{padding-left:0px !important; padding-right:0px !important; border:0px none transparent !important;padding-bottom:15px !important;height: auto !important;}}    
              @media only screen and (max-width: 480px){.tdMblHide{width:10px !important;} }    
              @media only screen and (max-width: 480px){.bmeShareItemBtn{display:table !important;}}    
              @media only screen and (max-width: 480px){.bmeMblStack td {text-align: left !important;}}    
              @media only screen and (max-width: 480px){.bmeMblStack .bmeFollowItem{clear:both !important; padding-top: 10px !important;}}    
              @media only screen and (max-width: 480px){.bmeMblStackCenter .bmeFollowItemText{padding-left: 5px !important;}}    
              @media only screen and (max-width: 480px){.bmeMblStackCenter .bmeFollowItem{clear:both !important;align-self:center; float:none !important; padding-top:10px;margin: 0 auto;}}    
              @media only screen and (max-width: 480px){    
              .tdPart> table{width:100% !important;}    
              }    
              @media only screen and (max-width: 480px){.tdPart>table.bmeLinkContainer{ width:auto !important; }}    
              @media only screen and (max-width: 480px){.tdPart.mblStackCenter>table.bmeLinkContainer{ width:100% !important;}}     
              .blk_parent:first-child, .blk_parent{float:left;}    
              .blk_parent:last-child{float:right;}    
              /*** BMEMBF END ***/    
              .hov:hover{color:#000 !important;}
              .linkP{color: #2f2f2f;}
              .linkP:hover{color: #52D18D;}
        
              table[name="bmeMainBody"], body {background-color:#2f2f2f;}    
               td[name="bmePreHeader"] {background-color:#00ae54;}    
               td[name="bmeHeader"] {background:#ffffff;background-color:#00ae54;}    
               td[name="bmeBody"], table[name="bmeBody"] {background-color:#ffffff;}    
               td[name="bmePreFooter"] {background-color:#ffffff;}    
               td[name="bmeFooter"] {background-color:#ffffff;}    
               td[name="tblCell"], .blk {font-family:initial;font-weight:normal;font-size:initial;}    
               table[name="blk_blank"] td[name="tblCell"] {font-family:Arial, Helvetica, sans-serif;font-size:14px;}    
               [name=bmeMainContentParent] {border-color:#ffffff;border-width:0px;border-style:none;border-radius:0px;border-collapse:separate;border-spacing:0px;overflow:hidden;}    
               [name=bmeMainColumnParent] {border-color:transparent;border-width:0px;border-style:none;border-radius:0px;}    
               [name=bmeMainColumn] {border-color:transparent;border-width:0px;border-style:none;border-radius:0px;border-collapse:separate;border-spacing:0px;}    
               [name=bmeMainContent] {border-color:transparent;border-width:0px;border-style:none;border-radius:0px;border-collapse:separate;border-spacing:0px;}    
                  
              </style>    
              </head>    
              <body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0 style="height: 100% !important; margin: 0; padding: 0; width: 100% !important;min-width: 100%;">    
                  
              <table width="100%" cellspacing="0" cellpadding="0" border="0" name="bmeMainBody" style="background-color: rgb(255, 255, 255);" bgcolor="#2f2f2f"><tbody><tr><td width="100%" valign="top" align="center">    
              <table cellspacing="0" cellpadding="0" border="0" name="bmeMainColumnParentTable"><tbody><tr><td name="bmeMainColumnParent" style="border: 0px none transparent; border-radius: 0px; border-collapse: separate;">       
              <table name="bmeMainColumn" class="bmeHolder bmeMainColumn" style="max-width: 600px; border-radius: 0px; border-collapse: separate; border-spacing: 0px; overflow: visible;" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td width="100%" class="blk_container bmeHolder" name="bmePreHeader" valign="top" align="center" style="color: rgb(102, 102, 102); border: 0px none transparent; background-color:  #52D18D;" bgcolor="#00ae54"></td></tr>   <tr><td width="100%" class="bmeHolder" valign="top" align="center" name="bmeMainContentParent" style="border: 0px none rgb(102, 102, 102); border-radius: 0px; border-collapse: separate; border-spacing: 0px; overflow: hidden;">    
              <table name="bmeMainContent" style="border-radius: 0px; border-collapse: separate; border-spacing: 0px; border: 0px none transparent;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td width="100%" class="blk_container bmeHolder" name="bmeHeader" valign="top" align="center" style="color: rgb(56, 56, 56); border: 0px none transparent; background-color:  #52D18D;" bgcolor="#00ae54"><div id="dv_1" class="blk_wrapper" style="">    
              <table width="600" cellspacing="0" cellpadding="0" border="0" class="blk" name="blk_text"><tbody><tr><td>    
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="bmeContainerRow"><tbody><tr><td class="tdPart" valign="top" align="center">    
              
              </table></td></tr></tbody>    
              </table></td></tr></tbody>    
              </table></div><br>
               
              </td></tr> <tr><td width="100%" class="blk_container bmeHolder bmeBody" name="bmeBody" valign="top" align="center" style="color: rgb(56, 56, 56); border: 0px none transparent; background-color: rgb(255, 255, 255);" bgcolor="#ffffff"><div id="dv_15" class="blk_wrapper" style="">    
              <table width="600" cellspacing="0" cellpadding="0" border="0" class="blk" name="blk_divider" style=""><tbody><tr><td class="tblCellMain" style="padding: 10px 0px;">    
              <table class="tblLine" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-top-width: 0px; border-top-style: none; min-width: 1px;"><tbody><tr><td><span></span></td></tr></tbody>    
              </table></td></tr></tbody>    
              </table></div><div id="dv_11" class="blk_wrapper" style="">    
              <table width="600" cellspacing="0" cellpadding="0" border="0" class="blk" name="blk_image"><tbody><tr><td>    
              <table width="100%" cellspacing="0" cellpadding="0" ><tbody><tr><td align="center" class="bmeImage" style="border-collapse: collapse; padding: 20px;">
                <b style="font-family:bo !important; font-size:20px; font-weight:bold; "><img src="https://www.mediafire.com/convkey/909e/dtq9ozx0230kl39zg.jpg?size_id=6" width="205">
              </td></tr></tbody>    
              </table></td></tr></tbody>    
              </table></div><div id="dv_17" class="blk_wrapper" style="">    
              <table width="600" cellspacing="0" cellpadding="0" border="0" class="blk" name="blk_text"><tbody><tr><td>    
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="bmeContainerRow"><tbody><tr><td class="tdPart" valign="top" align="center">    
              <table cellspacing="0" cellpadding="0" border="0" width="600" name="tblText" style="float:left; background-color:transparent;" align="left" class="tblText"><tbody><tr><td valign="top" align="left" name="tblCell" style="padding: 10px 20px; font-family: Roboto; font-size: 14px; font-weight: bold; color: rgb(56, 56, 56); text-align: left;" class="tblCell"><div style="line-height: 150%; text-align: center;"><span style="font-size: 18px; font-family: Roboto; color: #464646; line-height: 150%; text-transform:uppercase;">Monitorização de Notícias Nacionais e Internacionais</span></div></td></tr></tbody>    
              </table></td></tr></tbody>    
              </table></td></tr></tbody>    
              </table></div><div id="dv_18" class="blk_wrapper" style="">    
              <table width="600" cellspacing="0" cellpadding="0" border="0" class="blk" name="blk_button" style=""><tbody><tr><td width="20"></td><td align="center">    
              <table class="tblContainer" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td height="15"></td></tr><tr><td align="center">    
              <table cellspacing="0" cellpadding="0" border="0" class="bmeButton"  style="border-collapse: separate; width:100%;"><tbody><tr><td style="text-align: left; width:270px;  font-family: Roboto; font-size: 14px; padding: 0px 0px; border-collapse: separate;" class="bmeButtonText"><span style="font-family: Roboto; font-size: 14px; color: rgb(66, 66, 66);">  <a href="https://manifexto.com//clipping/login/" class="hov" style="background:#52D18D;padding:8px; color:#ffffff;text-decoration:none;" >Gerir Conta</a>
              </span></td><td style="text-align: right;  font-family: Roboto;font-size: 14px;  border-collapse: separate;" class="bmeButtonText">  
              <td style="padding-left: 5px; width:270px;  font-family: Roboto; text-align:right; "> <a style="color: rgb(66, 66, 66); text-decoration: none;" target="_blank"></a></td> <td style="padding-left: 5px; width:300px;  font-family: Roboto; text-align:right; "> <a style="color: rgb(66, 66, 66); text-decoration: none;" target="_blank">'.strftime('%d %B %Y', strtotime('today')).'</a></td> </span></td></tr></tbody>  
              </table></td></tr><tr><td height="15"></td></tr></tbody>   
              </table></td><td width="20"></td></tr></tbody>    
              </table> <hr></div>
            ';  
                
                $mail->addAddress($row['idEmail']);
                $mail->Subject = 'Resumo de Notícias: '.ucwords($row['titulo']).' ('.(date('d-m-Y')).')';
                $count =0;
                for($a=1;$a < 5;$a++){
                  if($row['tag'.$a] != null){
                 
                $count++;
                 
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://wrapapi.com/use/tremetrex09/newsclipscrapper/pagesPost/latest");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                "p" => $row['tag'.$a],
                "wrapAPIKey" => "nEutonp6nd0EhAOCJ8Ti4lYFcF9dWUKo"
                ]));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $data = json_decode($response, true);
                $envia =  false;
               
                
                for($i = 0;$i < count($data['data']['output']['Titulo']);$i++){
                  if(strpos($data['data']['output']['data'][$i],'minutos') || strpos($data['data']['output']['data'][$i],'hora') && !strpos($data['data']['output']['data'][$i],'horas')){
                    $link = $data['data']['output']['link'][$i];

                     $mail->Body .= '<b style="float:left;">#'.ucwords($row['tag'.$a]).'</b><br>';

                    $url = curl_init();
                    curl_setopt($url, CURLOPT_URL, "https://wrapapi.com/use/CaracasX9/scrapper/Link/0.0.1");
                    curl_setopt($url, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                    curl_setopt($url, CURLOPT_POST, true);
                    curl_setopt($url, CURLOPT_POSTFIELDS, json_encode([
                      "id" => explode("/", $link)[2]
                      ,"wrapAPIKey" => "QUQT5jn3cznd09gx6qt4Ukz9LPlvwOZ9"
                    ]));
                    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
                    $rqu = curl_exec($url);
                    $resul = json_decode($rqu, true);
                     
                    $linkUrl =   $resul['data']['Article']['Link'];

                    $titulo = $data['data']['output']['Titulo'][$i];
                    $titulo= highlight($titulo,  $row['titulo']);

                    if($data['data']['output']['imagem'][$i] == null)
                       $imagem = "https://bhmlib.org/wp-content/themes/cosimo-pro/images/no-image-box.png";
                    else
                       $imagem = explode("=",$data['data']['output']['imagem'][$i])[0];

                    $fonteNot = ucfirst(strtolower($data['data']['output']['fonte'][$i]));
                    $input = $linkOfficial[1][0];
            
                    $descricao = $data['data']['output']['descricao'][$i];

                    $ano = substr($data['data']['output']['dataTime'][$i],0,4);
                    $mes = substr($data['data']['output']['dataTime'][$i],5,2);
                    $dia = substr($data['data']['output']['dataTime'][$i],8,2);
                    $dataT = $dia.'/'.$mes.'/'.$ano;
                  
                  $mail->Body .= '<table style="width: 99%; margin:auto;"><tr><td rowspan="3" style="width: 120px;padding:0px; background:url(\''.$imagem.'\') center; background-size:cover; height:120px; border-radius:12px;"></td><td colspan="6" style="padding: 5px;"><a href="'.$linkUrl.'" style="color:#00B28D; font-family: Roboto;  text-decoration:none;">'.$titulo.'</a></td></tr><tr><td colspan="3" style="padding-left:5px;font-size:10px; text-align:left; font-family: Roboto;"><b style="font-family: Roboto;">'.$fonteNot.'</b> - '.$dataT.'</td><td><i style="float: right;font-family: Roboto; font-style:normal; padding-right:5px; font-size:10px;">SOCIEDADE </i></td></tr><tr><td colspan="6" style="padding-left:5px; font-size:17px; text-align:justify"><p style="float: left; margin-top:0px;font-family: Roboto; font-size:17px;">'.$descricao.'</p></td></tr></table> <br>';
              }
            }
          }

      }
    }
    }

    if($count >0)$envia = true;  else  $envia = false;
    
    if($envia == true){
          
        $mail->Body .= '
        <div id="dv_20" class="blk_wrapper" style="">    
        <table width="600" cellspacing="0" cellpadding="0" border="0" class="blk" name="blk_text"><tbody><tr><td>    
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="bmeContainerRow"><tbody><tr><td class="tdPart" valign="top" align="center">    
        <table style=" background-color:transparent; width:100%; text-align:center;color:#333; font-size:10px;"  class="tblText">
        <br>Copyright ©'.date('Y').' <a href="https://simpluz.com/" style="color: #52D18D; text-decoration:none;" target="_blank" class="linkP" style=" text-decoration:none;">  Simpluz Tecnologias,Lda</a>, Todos os direitos reservados
        <div id="dv_20" class="blk_wrapper" style="">    
        <table width="600" cellspacing="0" cellpadding="0" border="0" class="blk" name="blk_text"><tbody><tr><td>    
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="bmeContainerRow"><tbody><tr><td class="tdPart" valign="top" align="center">                     <table cellspacing="0" cellpadding="0" border="0" width="600" name="tblText" style="float:left; background-color:transparent;" align="left" class="tblText">
        <br>
        </table></body></html>';
     
        $mail->send();
         echo "Email enviado";
      
         $upload = "UPDATE campanha SET activado='activo' WHERE id='".$row['id']."'";
           if ($db->query($upload) === TRUE) {
             echo "Record updated successfully";
           } else {
             echo "Error updating record: " . $db->error;
           }
       }else{
         echo "Sem Noticias a Relatar para ".$row['titulo'];
       } 
      
       $envia = false;
        return;
    }
      
}  


   


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



function highlight($text, $word){
  if(strlen($text) > 0 && strlen($word) > 0)
  {
    return (str_ireplace($word, "<b style='color:#00B28D;'>{$word}</b>", $text));
  }
  return ($text);
}

