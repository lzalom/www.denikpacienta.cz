<div class="row">
	<div class="span6">
		<h1>Bannery</h1>
	</div>
	<div class="span6 text-right">
		<a href="?banners&action=newBanner" class="btn">Přidat banner</a>
		<a href="?banners" class="btn">Zpět na přehled</a>
	</div>
</div>

<hr />
      
<?php
    /* (!isset($_GET['action']))||(!isset($_GET['show']))|| */
    if ((!isset($_GET['action']))||($_GET['action']=='deleteBanner')){
?>      
      <div class="blockNews">
        <?php getBanners(); ?>
        <!--
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        -->
      </div>
<?php
    } /* end of news list */
?> 

<?php
    /* (!isset($_GET['action']))||(!isset($_GET['show']))|| */
    if (($_GET['action']=='activateBanner')||($_GET['action']=='deactivateBanner')){
?>      
      <div class="blockNews">
        <?php getBanners(); ?>
      </div>
<?php
    } /* end of news list */
?> 

<?php
    if ((isset($_GET['action']))&&($_GET['action']=='newBanner')){
?>    
      <div class="row">
        <form action="?banners" method="post" id="formBanners" enctype="multipart/form-data" data-validate="parsley">
        <div class="span8">
                <h2>Založit banner</h2>
                <label for="url">URL (bez http://)</label>
                <input type="text" name="url" id="url" data-required="true">
                <br>
                <label for="start">Začátek</label>
                <input type="text" name="start" id="start" data-required="true" class="datepicker">
                <br>
                <label for="end">Expirace</label>
                <input type="text" name="end" id="end" data-required="true" class="datepicker">
                <br>
                <label for="file1">Normální velikost</label>
                <input type="file" name="file1" id="file1" data-required="true">
                <br>
                <label for="file2">Velikost pro retinový displej</label>
                <input type="file" name="file2" id="file2" data-required="true">
                <br>

                <label for="interval">Interval v sekundách</label>
                <input type="text" name="interval" id="interval" data-required="true" data-type="number">
                <br>

        </div>
        <div class="span4 formPaddingTop">
                <button name="bannerSubmit" id="bannerSubmit" class="btn btn-large btn-primary">Uložit</button>
        </div>
        </form>
    </div>
<?php  
    } /* end of new item form */
?>

<?php
    if ((isset($_GET['action']))&&($_GET['action']=='editBanner')){
    
        fillBannerForm();
 
    } /* end of edit item form */
?>