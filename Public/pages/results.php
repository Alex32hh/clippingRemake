 <div class='container'>
     <div class='content-title'>Cerca de <em class="totalResults"></em> resultados (<em class="seconds-title-time"></em>
         segundos)</div>

     <?php

        $resul = 0;
        if (!isset($_GET['req']))
            foreach (feachData($_GET['p']) as $item) {
                //    echo $item->link;
                $resul++;
        ?>

     <div class='news-box' id="<?php echo 'b'.$resul;?>">
       
     <div style="background:url('<?php echo $item->imagem;?>'); cursor:pointer;" onclick="linkClick('<?php echo $request.'&req='.base64_encode($item->link);?>')" id="<?php echo 'b' . $resul; ?>">
        
       </div>
 
         <div class='news-box-description'>
             <div class='news-box-description-title'>
                 <a target="_blank" href="<?php echo $request.'&req='.base64_encode($item->link);?>')"  >
                     <?php echo $item->Titulo; ?>
                 </a>
             </div>
             <div class="box-news-font"><?php echo $item->fonte; ?> - <?php echo $item->dataT; ?></div>
             <div class="box-news-descricao"><?php echo $item->descricao; ?></div>
         </div>
        
     </div>

     <?php
            }
        ?>
 </div>

 <div class="spinner-body">
     <div class="spinner"></div>
     <div class="noMoreResult">Sem mais Resultados</div>
 </div>

 <?php

    if (isset($_GET['req'])) {
        $truUrl =  featchDataUrl(base64_decode($_GET['req']));
        echo "
        <script>

           $('.content-title').css('visibility','hidden'); 
           var link = ('".$truUrl."');
           window.open(link,'_self');

        </script>";
        exit;
    }

    ?>

 <script>
function linkClick(url) {
    window.open(url, '_blank');
}
 </script>