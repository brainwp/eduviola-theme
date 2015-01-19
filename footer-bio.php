	</div><!-- #main -->
    
    	</div><!-- #folha Obs.: Esta DIV � aberta no header-bio.php-->

	<div id="footer" role="contentinfo">
    
        <div id="foo-design"><span>design:</span><a class="a-design" href="http://www.mbnestudio.com/"></a></div>
        <div id="foo-tecnologia"><span>tecnologia:</span><a class="a-tec" href="http://www.etedesign.com.br/"></a></div>
        <div id="foo-desenvolvedor">Todos os direitos reservados &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></div>
        <div id="foo-facebook">
        <a class="a-foo" href="<?php echo get_option(mo_facebook) ?>"></a>
        </div>
		<div id="foo-twitter">
        <a class="a-foo" href="<?php echo get_option(mo_twitter) ?>"></a>
        </div>
        <div id="foo-youtube">
        <a class="a-foo" href="<?php echo get_option(mo_youtube) ?>"></a>
		</div>
        <div id="foo-rss">
        <a class="a-foo" href="<?php echo get_option(mo_rss) ?>"></a>
        </div>
        <div id="foo-email">
        <a class="a-foo" href="<?php bloginfo ( 'home' ); ?>/contato"></a>
        </div>
        

	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>
</body>
</html>
