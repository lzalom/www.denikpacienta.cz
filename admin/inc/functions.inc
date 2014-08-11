<?php
   
    
    /* new banner item */
    if (isset($_POST['bannerSubmit'])){
        /*echo '<pre>';
        print_r($_POST);
        print_r($_FILES);
        echo '</pre>';*/    
        $now = date('Y-m-d H:i:s'); 
        $filename1 = date('Y-m-d_H-i-s') . '.jpg';
        $filename2 = date('Y-m-d_H-i-s') . '@2x.jpg';
        if (isset($_FILES['file1'])){        
            if ($_FILES['file1']['type']!='image/jpeg'){
                echo 'Invalid file ext';
            }else{            
                /* fullsize image */
                move_uploaded_file($_FILES["file1"]["tmp_name"],
                $rootPath."/admin/banners/" . $filename1);
            }
        }
        if (isset($_FILES['file2'])){        
            if ($_FILES['file2']['type']!='image/jpeg'){
                echo 'Invalid file ext';
            }else{            
                /* fullsize image */
                move_uploaded_file($_FILES["file2"]["tmp_name"],
                $rootPath."/admin/banners/" . $filename2);
            }
        }        
        mysql_query("INSERT INTO banners 
            (file1,file2,start,end,duration,url,date) 
            VALUES ('".$filename1."',
            '".$filename2."',
            '".$_POST['start']."', 
            '".$_POST['end']."', 
            '".$_POST['interval']."', 
            '".$_POST['url']."', 
            '".$now."')") or die(mysql_error());
        echo '<div class="message clickable"><p>Banner založen.</div>';
            
    }    
    /* edit banner item */
    if (isset($_POST['bannerEdit'])){
        /*echo $rootPath;        
        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';*/        
        echo '<div class="message clickable"><p>Banner upraven.</div>';
        mysql_query("UPDATE banners SET 
        url = '".$_POST['url']."',
        start = '".$_POST['start']."',
        end = '".$_POST['end']."',
        duration = '".$_POST['interval']."'
        WHERE id = ".$_POST['id']) or die(mysql_error());        
        if ($_FILES['file1']["name"]!=''){
        
            $filename1 = date('Y-m-d_H-i-s') . '.jpg';
            //$filename1 = date('Y-m-d') . '-' . $_FILES["file1"]["name"];      
            if ($_FILES['file1']['type']!='image/jpeg'){
                echo 'Invalid file ext';
            }else{            
                $x = mysql_query("SELECT * FROM banners WHERE id = ".$_POST['id']);
                while($y = mysql_fetch_array($x)){
                    unlink($rootPath.'/admin/banners/'.$y['file1']);
                }
                /* fullsize image */
                move_uploaded_file($_FILES["file1"]["tmp_name"],
                $rootPath."/admin/banners/" . $filename1);
                mysql_query("UPDATE banners SET 
                file1 = '".$filename1."'
                WHERE id = ".$_POST['id']) or die(mysql_error());
            }
        }
        if ($_FILES['file2']["name"]!=''){             
            $filename2 = date('Y-m-d_H-i-s') . '@2x.jpg';
            //$filename2 = date('Y-m-d') . '-' . $_FILES["file2"]["name"];       
            if ($_FILES['file2']['type']!='image/jpeg'){
                echo 'Invalid file ext';
            }else{                
                $x = mysql_query("SELECT * FROM banners WHERE id = ".$_POST['id']);
                while($y = mysql_fetch_array($x)){
                    unlink($rootPath.'/admin/banners/'.$y['file2']);
                }       
                /* fullsize image */
                move_uploaded_file($_FILES["file2"]["tmp_name"],
                $rootPath."/admin/banners/" . $filename2);
                mysql_query("UPDATE banners SET 
                file2 = '".$filename2."'
                WHERE id = ".$_POST['id']) or die(mysql_error());
            }
        }
    }
    /* de/aktivace item */
    if ((isset($_GET['action']))&&(($_GET['action']=='deactivateBanner')||($_GET['action']=='activateBanner'))){
        $x = mysql_query("SELECT * FROM banners WHERE id = ".$_GET['id']);
        if ($_GET['action']=='deactivateBanner'){
            $toggle = 0;
            $message = 'deaktivován';
        }else{
            $toggle = 1;
            $message = 'aktivován';
        }
        while ($y = mysql_fetch_array($x)){
            mysql_query("UPDATE banners SET active = ".$toggle." WHERE id = ".$_GET['id']);
            echo '<div class="message clickable"><p>Banner byl '.$message.'</p></div>';  
        }        
    }
    /* smazání banneru - krok 1 */
    if ((isset($_GET['action']))&&($_GET['action']=='deleteBanner')&&(!isset($_GET['confirm']))){
        $x = mysql_query("SELECT * FROM banners WHERE id = ".$_GET['id']);
        while ($y = mysql_fetch_array($x)){
            echo '<div class="message"><p>Smazat banner? Tento krok je nevratný.
            <a href="?banners&action=deleteBanner&id='.$y['id'].'&confirm">ANO</a> | <a href="?banners">NE</a>
            </p></div>';  
        }        
    }    
    /* smazání banneru - krok 2 */
    if ((isset($_GET['action']))&&($_GET['action']=='deleteBanner')&&(isset($_GET['confirm']))){
        $x = mysql_query("SELECT * FROM banners WHERE id = ".$_GET['id']);
        while ($y = mysql_fetch_array($x)){
            unlink($rootPath.'/admin/banners/'.$y['file1']);
            unlink($rootPath.'/admin/banners/'.$y['file2']); 
            mysql_query("DELETE FROM banners WHERE id = ".$_GET['id']);
            echo '<div class="message clickable"><p>Banner byl smazán</p></div>';  
        }        
    } 
    
    /**/
    /* login */
    if (isset($_POST['loginSubmit'])){
        $pass = $_POST['password'];
        $i=0;
        $x = mysql_query("SELECT * FROM admin_users WHERE username = '".$_POST['username']."' AND password = '".$pass."' LIMIT 0,1");
        while ($y = mysql_fetch_array($x)){
            $user = $y['username'];
            $userId = $y['id'];
            $i++;
        }
        if ($i==0){
            $loginMessage = '<p>Uživatel neexistuje nebo špatně zadané heslo.</p>';
        }else{
            $_SESSION['denikUserId'] = $userId;
            $_SESSION['denikUser'] = $user;
            header('location:index.php?banners');
        }
    }


    /* FUNCTIONS */
    /* editace pozice -> formulář */
    function fillBannerForm(){
        $x = mysql_query("SELECT * FROM banners WHERE id = ".$_GET['id']);
        while ($y = mysql_fetch_array($x)){
            echo '<div class="row">
                <form action="?banners" method="post" id="formBanners" enctype="multipart/form-data" data-validate="parsley">
                <input type="hidden" name="id" value="'.$y['id'].'">
                <div class="span8">
                        <h2>Upravit banner</h2>
                        <label for="url">URL (bez http://)</label>
                        <input type="text" name="url" id="url" data-required="true" value="'.$y['url'].'">
                        <br>
                        <label for="start">Začátek</label>
                        <input type="text" name="start" id="start" data-required="true" class="datepicker" value="'.$y['start'].'">
                        <br>
                        <label for="end">Expirace</label>
                        <input type="text" name="end" id="end" data-required="true" class="datepicker" value="'.$y['end'].'">
                        <br>
                        <label for="file1">Normální velikost</label>
                        <input type="file" name="file1" id="file1">
                        <img src="banners/'.$y['file1'].'" class="formImg">
                        <div class="clr"></div>
                        <br>
                        <label for="file2">Velikost pro retinový displej</label>
                        <input type="file" name="file2" id="file2">
                        <img src="banners/'.$y['file2'].'" class="formImg">
                        <div class="clr"></div>
                        <br>
        
                        <label for="interval">Interval v sekundách</label>
                        <input type="text" name="interval" id="interval" data-required="true" data-type="number" value="'.$y['duration'].'">
                        <br>
        
                </div>
                <div class="span4 formPaddingTop">
                        <button name="bannerEdit" id="bannerEdit" class="btn btn-large btn-primary">Uložit</button>
                </div>
                </form>
            </div>';
        }
    }

    /* výpis bannerů */
    function getBanners(){
        $pocet = mysql_result(mysql_query("SELECT * FROM banners ORDER BY id DESC"), 0);
        if ($pocet==0){
            echo '<p>Žádný banner nenalezen</p>';
        }else{
            echo '<div class="head bannerItem">';
            //echo '<div class="head img">Obrázek</div>';
            echo '<div class="head url">Url</div>';
            echo '<div class="head expire">Platnost</div>';
            echo '<div class="head duration">Interval</div>';
            echo '<div class="head buttons">Nástroje</div>';
            echo '<div class="clr"></div>';
            echo '</div>';
        } 
        echo '<div class="BannerListSortable">';
        $x = mysql_query("SELECT * FROM banners ORDER BY sortable ASC");
        while ($y = mysql_fetch_array($x)){
            if ($y['active']==1){
                $active = 'active';
                $activateButton = '<a href="?banners&action=deactivateBanner&id='.$y['id'].'" class="btn">Deaktivovat</a>';
            }else{
                $active = 'inactive';
                $activateButton = '<a href="?banners&action=activateBanner&id='.$y['id'].'" class="btn">Aktivovat</a>';
            }
            $now = date('U');
            $start = date('d. m. Y', strtotime($y['start']));
            $end = date('d. m. Y', strtotime($y['end']));
            if ($now>strtotime($y['end'])){ $expired = 'expired'; }else{ $expired = ''; }
            echo '<div class="bannerItem '.$active.'" id="item_'.$y['id'].'"><div class="handle"></div>';
            echo '<div class="img"><img src="banners/'.$y['file1'].'" alt=""></div><div class="clr"></div>';
            echo '<div class="url"><a href="http://'.$y['url'].'">http://'.$y['url'].'</a></div>';
            echo '<div class="expire"><span class="'.$expired.'">'.$start.' - '.$end.'</span></div>';
            echo '<div class="duration"><span>'.$y['duration'].' sec</span></div>';
            echo '<div class="buttons">'.$activateButton.' <a href="?banners&action=editBanner&id='.$y['id'].'" class="btn">Editovat</a> <a href="?banners&action=deleteBanner&id='.$y['id'].'" class="btn">Smazat</a></div>';
            echo '<div class="clr"></div>';
            echo '</div>';
        }
        echo '</div>';
    }
    
    
 
?>