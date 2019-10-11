<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Plum_Village
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php the_field('google_analytics_code', 'options'); ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', '<?php the_field('google_analytics_code', 'options'); ?>', { 'anonymize_ip': true });
	</script>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'plumvillage' ); ?></a>

<div class="mega-menu-container hidden">
		<button class="menu-toggle unbutton" aria-controls="primary-menu" aria-expanded="false"><span class="icon-close"></span></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'mega-menu',
			) );
			?>
		<h6>— <?php _e( 'Follow Plum Village', 'plumvillage' ); ?></h6>
		<?php include( locate_template( 'template-parts/social-links.php', false, false ) ); ?>
			
		<h6>— <?php _e( 'Plum Village Practice Centers', 'plumvillage' ); ?></h6>
		<div class="row">
			<?php $col = 'col-6 col-xl-4'; ?>
			<?php include( locate_template( 'template-parts/practise-centres.php', false, false ) ); ?>
		</div>
		<?php
			wp_nav_menu( array(
				'theme_location' => 'footer-menu',
				'menu_id'				 => 'footer-mega-menu',
				'menu_class'		 => 'footer-menu',
				'depth'					 => 1,
			) );
		?>
</div>

<div id="page" class="site">			<button class="menu-toggle unbutton float-left" aria-controls="primary-menu" aria-expanded="false"><span class="icon-hamburger"></span></button>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			<div id="top-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'mega-menu',
					'depth'					 => 1,
				) );
				?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'secondary-menu',
				) );
				?>
			</div>
		</nav><!-- #site-navigation -->
		<div class="container">		
			<div class="site-branding">
				<?php
				if($post){
					$image = (get_field('header_white', $post->ID) ? get_field('logo_white', 'options') : get_field('logo_black', 'options'));
				} else {
					$image = get_field('logo_black', 'options');
				}
				if ( is_front_page()  ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php 
						if( !empty($image) ): ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php bloginfo( 'name' ); ?>"" width="<?php the_field('logo_width', 'options'); ?>" />
						<?php endif; ?>
					</a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php 
						if( !empty($image) ): ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php bloginfo( 'name' ); ?>"" width="<?php the_field('logo_width', 'options'); ?>" />
						<?php endif; ?>					
					</a></p>
					<?php
				endif;
			 	?>
			</div><!-- .site-branding -->
		</div>

	</header><!-- #masthead -->
	<div id="content" class="site-content">
