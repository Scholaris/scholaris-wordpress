<?php
// scholaris page definition

function scholaris_page() {
?>

<div class="wrap">
<h2>Scholaris - Ustawienia</h2>

<form method="post" action="options.php">

    <?php settings_fields( 'scholaris-settings-group' ); ?>
	
    <?php do_settings_fields( 'scholaris-settings-group', '' ); ?>
	
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Email użytkownika</th>
        <td><input type="text" name="user_email" value="<?php echo get_option('user_email'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Token użytkownika</th>
        <td><input type="text" name="user_token" value="<?php echo get_option('user_token'); ?>" /></td>
        </tr>
        
    </table>
 	 <?php submit_button('Zapisz zmiany'); ?>
</form>
</div>
<div class="wrap">

<h2>Scholaris - Zasoby</h2>
<?php
//adresy
$my = SCHOLARIS_CREATOR . '/external/publishlist/email/' . get_option('user_email');
$my2 = SCHOLARIS_CREATOR . '/external/search/email/' . get_option('user_email');

?>

<ul class="subsubsub">
	<li class="portal"><a href="<?php print $my2?>" target="scholaristarget">Wyszukiwarka zasobów portalu</a> |</li>
	<li class="my"><a href="<?php print $my?>" target="scholaristarget">Moje e-zasoby</a></li>
</ul>
</div>

<div class="clear"></div>

<div>
<iframe name="scholaristarget" width="900px;" height="800px;">
</iframe>
</div>


<?php } 

function scholaris_shortcode_handler($atts){
	$a = shortcode_atts( array(
		'sl_token' => '',
		'po_token' => '',
		'width' => 640,
		'color' => '#ddd',
	), $atts );

	$user_email = get_option('user_email');
	$user_token = get_option('user_token');
	
	$a['user_token'] = $user_token;
	$a['user_email'] = $user_email;
	
	if($a['sl_token']){
		$code =  '<iframe src="%1$s/preview/show/token/%2$s/email/%3$s" scrolling="no" frameborder="1" ';
		$code .= 'style="border:1px solid %4$s; overflow:hidden; width: %5$spx; height:%6$spx;" allowTransparency="true"></iframe>';

		return sprintf($code,
		SCHOLARIS_CREATOR,
		$a['sl_token'],
		$user_email,
		$a['color'],
		$a['width'],
		floor( ( (int)$a['width'] * 3 ) / 4 )
		);
	}else if($a['po_token']){
		$code =  '<iframe src="%1$s/resources/run/token/%2$s/email/%3$s" scrolling="no" frameborder="1" ';
		$code .= 'style="border:1px solid %4$s; overflow:hidden; width: %5$spx; height:%6$spx;" allowTransparency="true"></iframe>';
		
		return sprintf($code,
		SCHOLARIS_PORTAL,
		$a['po_token'],
		$user_email,
		$a['color'],
		$a['width'],
		floor( ( (int)$a['width'] * 3 ) / 4 )
);
	}
	
	
	
	//return '<div style="padding: 20px; border: 1px solid #59a;">' . print_r($a, true) . '</div>';

}


