<?php
class WorksWidget extends WP_Widget
{
  function WorksWidget()
  {
    $widget_ops = array('classname' => 'WorksWidget', 'description' => 'Displays gallery of works.' );
    $this->WP_Widget('WorksWidget', 'Display Works', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	// Put description here or smth
?>
  <p></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
	
	global $post;
	$args = array( 'post_type' => 'works', 'order' => 'ASC', 'order_by' => 'date' );										// get all posts of type works
	$myposts = get_posts( $args );
	?>
	<div class="works-gallery">
	<?php
	foreach( $myposts as $post ) :	setup_postdata($post); ?>
		
		<div class="project" postid="<?php echo get_the_ID(); ?>">
		<div class="left-bubble">
			<div class="bubble"> 
			<a href="#" class="unslider-arrow prev">Previous |</a>
			<a href="#" class="unslider-arrow next"> Next</a>
			
			<a href="#" class="close-slider">X</a>
			<ul>
			<?php
			
			$images = get_posts(array(
				'post_parent'    => get_the_ID(),
				'post_type'      => 'attachment',
				'numberposts'    => -1, // show all
				'post_status'    => null,
				'post_mime_type' => 'image',
						'orderby'        => 'date',
						'order'           => 'ASC',
			));
			
			foreach($images as $image) {
				$attimg   = wp_get_attachment_image($image->ID,$size);
				echo '<li>' . $attimg . '</li>';
			}
			
			?>
			</ul>
			</div>
		</div>
		<div class="right-bubble">
			<div class="bubble">
			<h3><?php the_title(); ?></h3>
			<div class="desc">
			<span class="highlight">Year:</span> <?php echo esc_html( get_post_meta( get_the_ID(), 'year', true ) ); ?></br>
			<span class="highlight">Client:</span> <?php echo esc_html( get_post_meta( get_the_ID(), 'client', true ) ); ?></br>
			<span class="highlight">Role:</span> <?php echo esc_html( get_post_meta( get_the_ID(), 'role', true ) ); ?></br>
			<span class="highlight">Tools:</span> <?php echo esc_html( get_post_meta( get_the_ID(), 'tools', true ) ); ?></br>
			
			</br>
			<a href="<?php echo esc_html( get_post_meta( get_the_ID(), 'link', true ) ); ?>" class="project-link" >View Project</a>
			</br>
			
			<div class="desc-content">
			<?php the_content(); ?>
			</div>
			</div>
			</div>
		</div>
		</div>
		
	<?php endforeach; 
	
	// also create what it will expand to; make invisible with jquerys
	// for now can I write the code right in here? |D
	
	?>
	</div>
	
	<style type="text/css">
		.bubble { margin-bottom:20px }
		.left-bubble .bubble { position: relative; overflow: hidden; }
		.left-bubble .bubble li { list-style: none; text-align:center; }
		.left-bubble .bubble ul li { float: left; }
		.close-slider {	float:right; }
		.project-link { color:#3092a7; font-size:20px; }
		.project { height:300px; }
	</style>
	
	<script type="text/javascript"> 
	jQuery(document).ready(function() {
	
		
		var sliders = new Array();
	
		jQuery(".left-bubble img").hide();
		
		jQuery(".project").each(function(i) {
			jQuery(this).find(".left-bubble img:first").css('display', 'inline-block');
			
			// OR, turn all into slider at the start, put into array, access based on serialization or smth
			var slider = jQuery(this).find('.left-bubble .bubble').unslider({ dots:false, keys: false });
			
			sliders.push(slider);
			
			var slider_data = slider.data('unslider');
			
			slider_data.stop();
			
		});
		jQuery(".bubble .prev, .bubble .next").hide();
		jQuery(".close-slider").hide();
		
		jQuery(".left-bubble .bubble, .left-bubble .bubble ul").css('height', '250px');
		
		jQuery(".bubble .desc .desc-content").hide();
		jQuery('.project').click(function() {
			click_project(this);
		});
		
		
		jQuery(".bubble .prev").click(function(e) {
			e.preventDefault();
			var project = jQuery(this).parents(".project");
			var slider_data = sliders[jQuery(".project").index(project)].data('unslider');
			slider_data.prev();
			slider_data.stop();
		});
		
		jQuery(".bubble .next").click(function(e) {
			e.preventDefault();
			var project = jQuery(this).parents(".project");
			var slider_data = sliders[jQuery(".project").index(project)].data('unslider');
			slider_data.next();
			slider_data.stop();
		});
		
		jQuery(".close-slider").click(function(e) {
			e.stopPropagation();
			e.preventDefault();
			var project = jQuery(this).parents(".project");
			jQuery(project).find(".left-bubble").animate({ width: (jQuery(project).width() * 0.65) });
			jQuery(project).find(".right-bubble").animate({ width: (jQuery(project).width() * 0.30) });
			jQuery(project).find(".bubble").css('width', '100%');
			jQuery(project).find(".bubble ul, .left-bubble .bubble").animate({height: '250px'});
			jQuery(project).find(".left-bubble .bubble, .left-bubble .bubble ul").css('min-height', '0px');
			jQuery(project).find(".bubble .prev, .bubble .next").hide();
			jQuery(project).find(".bubble .desc .desc-content").hide();
			jQuery(project).find(".close-slider").hide();
			
			var slider_data = sliders[jQuery(".project").index(project)].data('unslider');
			slider_data.move(0);
			slider_data.stop();
			
			
			jQuery(project).on('click', function() {
				click_project(this);
			});
		});
		
		function click_project(project) {
			jQuery(project).off('click');
			jQuery(project).find(".left-bubble, .right-bubble, .bubble").animate({ width: (jQuery(project).width()) });
			jQuery(project).find(".left-bubble .bubble, .left-bubble .bubble ul").animate({height: 450});
			jQuery(project).find(".left-bubble .bubble, .left-bubble .bubble ul").css('min-height', '450px');
			jQuery(project).find(".bubble .desc .desc-content").show();
			jQuery(project).find(".bubble .prev, .bubble .next").show();
			jQuery(project).find(".close-slider").show();
			
			jQuery(project).find(".left-bubble img").css('display', 'inline-block');
			
			
			//var slider = jQuery(project).find('.left-bubble .bubble').unslider({ dots:false, keys: false });
			//var slider_data = slider.data('unslider');
			
			//current_slider = slider;
			
			//slider_data.stop();
		}
		
	});

	
	</script>
	<?php
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("WorksWidget");') );


?>