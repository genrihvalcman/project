
<?php $this->printPageBlock('slider'); ?>
<?php $this->printPageBlock('steps'); ?>


<div class=" container-fluid">
    <div class=' content col-sm-7 col-md-7 col-lg-7 '>
        <div class=' mainText col-sm-12 col-md-12 col-lg-12 '>
          <?=$textPage?>
		  
        </div>
      <div class='news col-sm-12 col-md-12 col-lg-12 '>
        </div>
    </div>
    <div class=' rightBlock col-sm-5 col-md-5 col-lg-5 '> 
        
        <?php  $this->printPageBlock('form');?>
    </div>
	<div class="col-md-12"><h3>Процесс постоянного совершенствования знаний - залог успешной практики адвоката.</h3>  </div>
    <?php $this->printPageBlock('portfolio'); ?>
</div>
