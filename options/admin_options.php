<?php

$themename = "Op&ccedil;&otilde;es";
$shortname = "mo";

/** Caminho para o ícone do menu */
$icone = get_bloginfo('stylesheet_directory').'/options/images/icone.png';

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

array_unshift($wp_cats, "Choose a category"); 

/** Início do formulário */
$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "Home",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Patroc&iacute;nio?",
	"desc" => "Marque para exibir o Patroc&iacute;nio Petrobras",
	"id" => $shortname."_patro",
	"type" => "checkbox",
	"std" => ""),

array( "name" => "Destaque 02",
	"desc" => "Adicione o nome para o segundo destaque",
	"id" => $shortname."_destaque_dois",
	"type" => "text",
	"std" => ""),

array( "name" => "Banner Destaque URL",
	"desc" => "Adicione o URL da imagem/banner",
	"id" => $shortname."_banner",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Descri&ccedil;&atilde;o do Banner Destaque",
	"desc" => "Escreva em poucas palavras uma chamada para o artigo relacionado ao Destaque",
	"id" => $shortname."_desc_banner",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Link Artigo Banner Destaque",
	"desc" => "Adicione o LINK para o artigo relacionado ao Destaque",
	"id" => $shortname."_link_banner",
	"type" => "text",
	"std" => ""),

array( "name" => "Ajuda",
	"desc" => "Clique para ver onde s&atilde;o os campos configurados acima.",
	"id" => $shortname."_ajuda",
	"type" => "ajuda",
	"std" => ""),
	
array( "type" => "close"),
 
 
array( "name" => "Redes Sociais",
	"type" => "section"),
array( "type" => "open"),
 

array( "name" => "Facebook",
	"desc" => "Adicione a url do Facebook",
	"id" => $shortname."_facebook",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Twitter",
	"desc" => "Adicione a url do Twitter",
	"id" => $shortname."_twitter",
	"type" => "text",
	"std" => ""),

array( "name" => "Youtube",
	"desc" => "Adicione a url do Youtube",
	"id" => $shortname."_youtube",
	"type" => "text",
	"std" => ""),
	
array( "name" => "RSS",
	"desc" => "Adicione a url do RSS",
	"id" => $shortname."_rss",
	"type" => "text",
	"std" => ""),
		
array( "name" => "Texto de Sauda&ccedil;&atilde;o",
	"desc" => "Escreva em poucas palavras uma sauda&ccedil;&atilde;o",
	"id" => $shortname."_text_saud",
	"type" => "textarea",
	"std" => ""),
	
array( "type" => "close"),
 
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options, $icone;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=admin_options.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=admin_options.php&reset=true");
die;
 
}
}

add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin', $icone, 3);
}

function mytheme_add_init() {

$file_dir=get_bloginfo('stylesheet_directory');
wp_enqueue_style("functions", $file_dir."/options/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/options/rm_script.js", false, "1.0");
wp_enqueue_script("thickbox", $file_dir."/options/thickbox/thickbox.js", false, "1.0");
wp_enqueue_style("thickbox", $file_dir."/options/thickbox/thickbox.css", false, "1.0", "all");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' salvas.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' resetadas.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> <?php bloginfo( 'blog_name' ); ?></h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>Use <?php echo $themename;?> para configurar algumas partes do seu tema.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 

case "ajuda":
?>

<div class="rm_input rm_ajuda">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>

<a href="<?php bloginfo( 'stylesheet_directory' ); ?>/options/images/ajuda.jpg" title="Ajuda para Home" class="thickbox">
  <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/options/images/thumb-ajuda.jpg" alt="Ajuda para Home" />
</a>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 

case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" class="button-primary" type="submit" value="Salvar Altera&ccedil;&otilde;es" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>