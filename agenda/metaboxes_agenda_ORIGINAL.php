<?php
/**
 * Registra o Metabox e adiciona ao Agenda.
 */
function agenda_events_meta_box() {
	add_meta_box('agenda-events-meta-box', 'Dados do Evento', 'agenda_events_create_meta_box', 'agenda', 'normal', 'high');
}
add_action('add_meta_boxes', 'agenda_events_meta_box');



/**
 * Cria o  HTML para o Metabox
 */
function agenda_events_create_meta_box($post) {
	// Get already-entered date.
	$date = get_post_meta($post->ID, 'Date', true);
	$endereco = get_post_meta($post->ID, 'Endereco', true);
 
	// Nonce for verification.
	wp_nonce_field( plugin_basename(__FILE__), 'agenda_events_nonce');
	?>
 
Data do Evento:
<input id="agenda-event-date" name="agenda-event-date" type="text" value="<?php echo $date; ?>" /><br />
Endereco
<input id="agenda-event-endereco" name="agenda-event-endereco" type="text" value="<?php echo $endereco; ?>" />


<?php }

/**
 * Saves the meta box value when the post is saved.
 */
function agenda_events_save_meta_box($post_id) {
 
	// Verification check.
	if ( !wp_verify_nonce( $_POST['agenda_events_nonce'], plugin_basename(__FILE__) ) )
	      return;
 
	// And they're of the right level?
	if(!current_user_can('edit_posts') )
		return;
 
	// Has the field been used?
	$date = trim( $_POST['agenda-event-date'] );
	if( empty($date) )
		return;
		
	// Validate that what was entered is of the form: 00/00/00
	if(preg_match('(^\d{1,2}\/\d{1,2}\/\d{4}$)', $date) ) {
		update_post_meta($post_id, 'Date', $date);

	//Salva os Campos
	$endereco = trim( $_POST['agenda-event-endereco'] );
	update_post_meta($post_id, 'Endereco', $endereco);


		
	}
}
add_action('save_post', 'agenda_events_save_meta_box');



/**
 * Adiciona os devidos jQuery DatePicker para a Agenda.
 */
function agenda_events_jquery_datepicker() {
	wp_enqueue_script(
		'jquery-ui-datepicker',
		get_bloginfo('stylesheet_directory') . '/agenda/datepicker/jquery-ui-1.8.11.custom.min.js',
		array('jquery')
	);
 
	wp_enqueue_script(
		'agenda-datepicker',
		get_bloginfo('stylesheet_directory') . '/agenda/datepicker/agenda-datepicker.js',
		array('jquery', 'jquery-ui-datepicker')
	);
}
add_action('admin_print_scripts-post-new.php', 'agenda_events_jquery_datepicker');
add_action('admin_print_scripts-post.php', 'agenda_events_jquery_datepicker');

/**
 * Adiciona o CSS para o jQuery DatePicker da Agenda.
 */
function agenda_events_jquery_datepicker_css() {
	wp_enqueue_style(
		'jquery-ui-datepicker',
		get_bloginfo('stylesheet_directory') . '/agenda/datepicker/css/smoothness/jquery-ui-1.8.11.custom.css'
	);
}
add_action('admin_print_styles-post-new.php', 'agenda_events_jquery_datepicker_css');
add_action('admin_print_styles-post.php', 'agenda_events_jquery_datepicker_css');

?>