<?php
/**
 * Display page content
 * */
function RPAdminPageScreen() {
    global $submenu;

    // access page settings
    $page_data = array();
    foreach ($submenu['tools.php'] as $i => $menu_item) {
        if ($submenu['tools.php'][$i][2] == 'redirection-plugin2') {
            $page_data = $submenu['tools.php'][$i];
        }
    }

    /**
     * Return data from database
     */
    global $wpdb;
    $tablename=$wpdb->prefix.'rplugin';
    // $db_results=$wpdb->get_row("SELECT * FROM $tablename WHERE id=0");
    $db_results=$wpdb->get_results("SELECT * FROM $tablename");
    ?>
    
    <div class="wrap">
        <h2>
            <?php echo $page_data[3]; ?>
        </h2>
        <hr>
        <h4>Enter data in the following format:</h4>
        <ul class="info">
            <li>Cookie name - <b>cookie_name</b> (string type);</li>
            <li>Name of slug - <b>why-sc</b> (use slug from admin page or from URL like this:
            http://stevenson-consulting/<b>why-sc</b>/);</li>
            <li>Url to redirect - <b>http://stevenson-consulting/why-sc/</b>;</li>
        </ul>
        <br>
        <h5>To add another redirect form, click - "+"</h5>
        <hr>
        <br>
        <div id="b-content" class="block-content">
        <?php

        if(!empty($db_results)){
            foreach($db_results as $item){
                $id = $item->id;
                $cenable = (($item->status) == 1) ? "checked" : "";
                $cname = ( !empty($item->cookie) ) ? $item->cookie : "";
                $slug = ( !empty($item->slug) ) ? $item->slug : "";
                $rurl = ( !empty($item->url) ) ? $item->url : "";
                $cenableUnique = wp_unique_id( 'cenable' );
                $deleteUnique = wp_unique_id( 'delete-btn' );
            ?>  
                <div
                class='hidden'
                data-id='<?= $deleteUnique ?>'
                ></div>
                <div class="block-wrapper" id="block<?php echo $id; ?>">
                    <form action="/action_page.php">
                        <label for="<?php echo $cenableUnique; ?>" class="check"><input type="checkbox" id="<?php echo $cenableUnique; ?>" name="cenable" <?php echo $cenable; ?> >Enable of redirect</label>
                        <label for="cname">Cookie name:</label>
                        <input type="text" name="cname" value="<?php echo $cname ?>">
                        <label for="slug">Name of slug:</label>
                        <input type="text" name="slug" value="<?php echo $slug ?>">
                        <label for="rurl">Url to redirect:</label>
                        <input type="text" name="rurl" value="<?php echo $rurl ?>"><br>
                        <input type="submit" value="Update"><input type="button" id="<?php echo $deleteUnique ?>" value="Delete">
                    </form> 
                </div>
            <?php
            }
        }else{
           ?>
           <div class="block-wrapper" id="block0">
                    <form action="/action_page.php">
                        <label for="cenable" class="check"><input type="checkbox" id="cenable" name="cenable" value="active">Enable of redirect</label>
                        <label for="cname">Cookie name:</label>
                        <input type="text" name="cname" value="">
                        <label for="slug">Name of slug:</label>
                        <input type="text" name="slug" value="">
                        <label for="rurl">Url to redirect:</label>
                        <input type="text" name="rurl" value=""><br>
                        <input type="submit" value="Save">
                    </form> 
                </div>
           <?php
        }
        ?>
            <button type="button" class="typical-btn" id="btnTypical">+</button>
        </div>
    </div>
    <?php
}