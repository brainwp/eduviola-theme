<?php

/**

Template name: bio

 */



get_header( 'home' ); ?>



		<div id="container">

			<div id="content-left">

			

            <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/titulo-bemvindo.png" alt="Biografia" />





<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



					<div class="entry-content">

						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>

						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>

					</div><!-- .entry-content -->

				</div><!-- #post-## -->



<?php endwhile; ?>

<h2 class="titulo-capa">Músicas</h2>

<div id="bandcamp">

<iframe width="300" height="500" style="position: relative; display: block; width: 300px; height: 500px;" src="http://bandcamp.com/EmbeddedPlayer/v=2/album=3022282088/size=grande3/linkcol=000000/" allowtransparency="true" frameborder="0"><a href="http://eduviola.bandcamp.com/album/edu-viola-e-o-bando-novo">Edu Viola e o Bando Novo by Edu Viola e o Bando Novo</a></iframe>

</div>

			</div><!-- #content-left -->

 			<div id="content-right">

            <div id="right-1a-linha">

           <div id="agenda">

                <p class="titulo-capa">Agenda de Shows</p>

<!-- Inicio Loop --> 

<?php

$args = array(

'post_type' => 'agenda',

'posts_per_page' => 3, /* Quantidade de Posts a exibir */

"meta_key" => "agenda-event-date", // Change to the meta key you want to sort by

"orderby" => "meta_value", // This stays as 'meta_value' or 'meta_value_num' (str sorting or numeric sorting)

"order" => "ASC"

);

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post();

global $post;

//Pega a data escolhida no admin e grava em $ag_data

$ag_data = get_post_meta($post->ID,'agenda-event-date',TRUE);

$ag_inicio = get_post_meta($post->ID,'agenda_horario_inic',TRUE);

$ag_local = get_post_meta($post->ID,'agenda_local',TRUE);

$ag_endereco = get_post_meta($post->ID,'agenda_endereco',TRUE);

$ag_bairro = get_post_meta($post->ID,'agenda_bairro',TRUE);

$ag_cidade = get_post_meta($post->ID,'agenda_cidade',TRUE);

$ag_estado = get_post_meta($post->ID,'agenda_estado',TRUE);

?>



<?php

// Seta a data atual - 1 dia

$datahoje = date('Y/m/d');

$dataexpira = strtotime( $datahoje );



// Transforma a $ag_data em tempo

$ag_data_time = strtotime( $ag_data );



// Condição: Se a data do evento for maior que a data de expiração, exibe!

if ( $ag_data_time == $dataexpira ) { ?>

Esse evento acontece hoje

<div class="evento-agenda">

<div id="titulo-evento-loop-archive">

+ <?php the_title(); ?>

</div>

<div class="data-evento-agenda">

<div id="data-loop-archive">

<?php

                            $data_invertida = $ag_data;

                            $data_explode = explode("/", $data_invertida);

?>

                            

                            <?php echo

                            $data_explode[2]

                            . "/" .

                            $data_explode[1]

                            . "/" .

                            $data_explode[0];

                            ?>

                        </div>

<div id="infos-agenda"> 

<p><?php echo $ag_local; ?></p>

</div>



</div><!-- .data-evento-agenda -->	

</div><!-- #evento-agenda -->



<?php }



if ( $ag_data_time > $dataexpira ) { ?>



<div class="evento-agenda">

<div id="titulo-evento-loop-archive">

+ <?php the_title(); ?>

</div>

<div class="data-evento-agenda">

<div id="data-loop-archive">

<?php

                            $data_invertida = $ag_data;

                            $data_explode = explode("/", $data_invertida);

?>

                            

                            <?php echo

                            $data_explode[2]

                            . "/" .

                            $data_explode[1]

                            . "/" .

                            $data_explode[0];

                            ?>

                        </div>



<div id="infos-agenda"> 

<p><?php echo $ag_inicio; ?></p>

</div>



</div><!-- .data-evento-agenda -->	

</div><!-- #evento-agenda -->





<?php } ?>

<?php endwhile; ?>

<!-- Fim Loop -->

        </div>

        <div id="facebook">

        	<p class="titulo-face">Curta nossa página<br />no Facebook</p>

        <div class="fb-like" data-href="http://www.facebook.com/EduViolaEOBandoNovo" data-send="false" data-width="200" data-show-faces="true"></div>        

        </div>

        </div>

            <h2 class="titulo-capa">Vídeos</h2>

            <?php $recent = get_page_by_path('videos', OBJECT, 'page'); ?>

       <?php echo apply_filters('the_content', $recent->post_content;); ?>

<?php endwhile; ?>

            <br />

            

			</div><!-- #content-right -->



		</div><!-- #container -->



<?php get_footer( 'home' ); ?>
