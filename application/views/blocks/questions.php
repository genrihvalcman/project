<div id="celebs">
    <ul id="accordion">
        <?php $i = 1; foreach ($questions as $valueQuestions) { ?> 
            <li>
               <h1 class='<?php if($i == 1){echo "active"; }?>'><?=$valueQuestions['title_page']?></h1>
               <ul>
                   <li>
                       <div class="desc-acrd">
                          <?=$valueQuestions['text_page']?>
                       </div>
                   </li>
               </ul>
           </li>
        <?php $i++; }?>    
    </ul> 
</div>