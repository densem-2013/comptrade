<?php
/**
 * Plugin Name: Social Media Gallery
 * Version: 1.1
 * Description: Social Media Gallery is the most complete and advance plugin to display your social media streams on your wordpress site. Social Media Gallery is indeed the ultimate responsive gallery. It runs on all major browsers with support for older browsers like IE8 and mobile devices like iPhone, iPad, IOS, Android or Windows mobile.
 * Author: WebHunt Infotech
 * Author URI: http://webhuntinfotech.com
 * Plugin URI: http://demo.webhuntinfotech.com/social-media-gallery-pro/
 */

/** Constant Variable */

define("SMGL_TEXT_DOMAIN","SMGL_TEXT_DOMAIN" );
define("SMGL_PLUGIN_URL", plugin_dir_url(__FILE__));

add_action('plugins_loaded', 'SMGL_GetReadyTranslation');
function SMGL_GetReadyTranslation() {
	load_plugin_textdomain('SMGL_TEXT_DOMAIN', FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

// Function To Remove Feature Image
function SMGL_remove_image_box() {
	remove_meta_box('postimagediv','smgl_cpt','side');
}
add_action('do_meta_boxes', 'SMGL_remove_image_box');

/** Short Code Detect Function To UpLoad JS And CSS */
function SMGL_ShortCodeDetect() {
    global $wp_query;
    $Posts = $wp_query->posts;
    $Pattern = get_shortcode_regex();

	/** js scripts */
        wp_enqueue_script('jquery');
		
		wp_enqueue_script('SMGL-FWDUGP-js', SMGL_PLUGIN_URL.'js/FWDUGP.js', array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'SMGL_ShortCodeDetect' );
add_filter( 'widget_text', 'do_shortcode' );

class SMGL {
    private static $instance;
	var $counter;

    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

	private function __construct() {
		$this->counter = 0;
        add_action('admin_print_scripts-post.php', array(&$this, 'smgl_admin_print_scripts'));
        add_action('admin_print_scripts-post-new.php', array(&$this, 'smgl_admin_print_scripts'));
        add_shortcode('smglgallery', array(&$this, 'shortcode'));
        if (is_admin()) {
			add_action('init', array(&$this, 'socialMediaGalleryPlugin'), 1);
			add_action('add_meta_boxes', array(&$this, 'add_all_smgl_meta_boxes'));
			add_action('admin_init', array(&$this, 'add_all_smgl_meta_boxes'), 1);

			add_action('save_post', array(&$this, 'SMGL_image_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'SMGL_settings_meta_save'), 9, 1);
			
			add_action('wp_ajax_smglgallery_get_thumbnail', array(&$this, 'ajax_get_thumbnail'));
		}
    }
	
	//Required JS & CSS
	public function smgl_admin_print_scripts() {
		if ( 'smgl_cpt' == $GLOBALS['post_type'] ) {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('media-uploader-js', SMGL_PLUGIN_URL . 'js/multiple-media-uploader.js', array('jquery'));

			wp_enqueue_media();
			//custom add image box css
			wp_enqueue_style('image-box-css', SMGL_PLUGIN_URL.'css/image-box.css');

			wp_enqueue_style('smart-forms-css', SMGL_PLUGIN_URL.'css/smart-forms.css');
			wp_enqueue_script('jquery-ui-slider');

			//font awesome css
			wp_enqueue_style('smgl-font-awesome', SMGL_PLUGIN_URL.'css/font-awesome.min.css');
		}
	}
	
	function socialMediaGalleryPlugin() {
		register_post_type('smgl_cpt',
			array(
				'labels' => array(
					'name' => __('Social Media Gallery','SMGL_TEXT_DOMAIN' ),
					'singular_name' => __('Social Media Gallery','SMGL_TEXT_DOMAIN' ),
					'add_new' => __('Add New Gallery', 'SMGL_TEXT_DOMAIN' ),
					'add_new_item' => __('Add New Gallery', 'SMGL_TEXT_DOMAIN' ),
					'edit_item' => __('Edit Gallery', 'SMGL_TEXT_DOMAIN' ),
					'new_item' => __('New Gallery', 'SMGL_TEXT_DOMAIN' ),
					'view_item' => __('View Gallery', 'SMGL_TEXT_DOMAIN' ),
					'search_items' => __('Search Gallery', 'SMGL_TEXT_DOMAIN' ),
					'not_found' => __('No Gallery found', 'SMGL_TEXT_DOMAIN' ),
					'not_found_in_trash' => __('No Gallery found in Trash', 'SMGL_TEXT_DOMAIN' ),
					'parent_item_colon' => __('Parent Gallery:', 'SMGL_TEXT_DOMAIN' ),
					'all_items' => __('All Galleries', 'SMGL_TEXT_DOMAIN' ),
					'menu_name' => __('Social Media Gallery', 'SMGL_TEXT_DOMAIN' ),
				),
				'supports' => array('title', 'thumbnail'),
				'show_in' => true,
				'show_in_nav_menus' => false,
				'public' => true,
				'menu_icon' => 'dashicons-format-gallery',
			)
		);
	}

	public function add_all_smgl_meta_boxes() {
		add_meta_box( __('Add Album', 'SMGL_TEXT_DOMAIN'), __('Add Album', 'SMGL_TEXT_DOMAIN'), array(&$this, 'SMGL_generate_add_image_meta_box_function'), 'smgl_cpt', 'normal', 'low' );
		add_meta_box( __('Apply Setting On Gallery', 'SMGL_TEXT_DOMAIN'), __('Apply Setting On Gallery', 'SMGL_TEXT_DOMAIN'), array(&$this, 'SMGL_settings_meta_box_function'), 'smgl_cpt', 'normal', 'low');
		add_meta_box ( __('Gallery Shortcode', 'SMGL_TEXT_DOMAIN'), __('Gallery Shortcode', 'SMGL_TEXT_DOMAIN'), array(&$this, 'SMGL_shotcode_meta_box_function'), 'smgl_cpt', 'side', 'low');
		
		// Rate Us Meta Box
		add_meta_box(__('We need your reviews in order to improve our services', 'SMGL_TEXT_DOMAIN') , __('We need your reviews in order to improve our services', 'SMGL_TEXT_DOMAIN'), array(&$this,'Rate_us_meta_box_smgl'), 'smgl_cpt', 'side', 'low');

		// Pro Features Meta Box
		add_meta_box(__('Pro Features', 'SMGL_TEXT_DOMAIN') , __('Pro Features', 'SMGL_TEXT_DOMAIN'), array(&$this,'smgl_pro_features'), 'smgl_cpt', 'side', 'low');
	}
	
	// Rate Us Meta Box Function
	function Rate_us_meta_box_smgl() { ?>
		<script>
		jQuery(function() {
			jQuery("input[name$='star']").change(function() {
				window.open('https://wordpress.org/plugins/photo-video-gallery-master/', '_blank');
			});
		});
		</script>
		<div class="stars">
			<input class="star star-5" id="star-5" type="radio" name="star"/>
			<label class="star star-5" for="star-5"></label>
			<input class="star star-4" id="star-4" type="radio" name="star"/>
			<label class="star star-4" for="star-4"></label>
			<input class="star star-3" id="star-3" type="radio" name="star"/>
			<label class="star star-3" for="star-3"></label>
			<input class="star star-2" id="star-2" type="radio" name="star"/>
			<label class="star star-2" for="star-2"></label>
			<input class="star star-1" id="star-1" type="radio" name="star"/>
			<label class="star star-1" for="star-1"></label>
		</div>
		<div class="" style="text-align:center;margin-bottom:15px;margin-top:25px;">
			<a href="https://wordpress.org/support/view/plugin-reviews/social-media-gallery" target="_blank" class="btn-web button-3"><?php _e('RATE US','SMGL_TEXT_DOMAIN'); ?></a>
		</div>
		<?php
	}

	function smgl_pro_features(){
	?>
		<ul style="">
			<li class="plan-feature">(1) <?php _e('Support for 5 social networks from which can load and display playlists, albums, sets and more (Facebook, Flickr, Soundcloud, Pinterest, Youtube).','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(2) <?php _e('Two grid layouts included with vertical and horizontal variation (classic and infinite).','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(3) <?php _e('Beautiful hover effects.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(4) <?php _e('Super easy to use for beginners.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(5) <?php _e('Quick and easy setup.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(6) <?php _e('100% responsive design','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(7) <?php _e('Developer friendly.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(8) <?php _e('Mobile optimized.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(9) <?php _e('SEO optimized.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(10) <?php _e('Light Box View.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(11) <?php _e('Two Light box skins included.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(12) <?php _e('Single or multiple categories selection.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(13) <?php _e('Filterable categories.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(14) <?php _e('Total count on categories.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(15) <?php _e('Optional menu.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(16) <?php _e('Customizable menu position with variation based on layout.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(17) <?php _e('Optional search box.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(18) <?php _e('Optional lazy loading with load more button or scroll.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(19) <?php _e('Multiple thumbnails hide / show animation types.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(20) <?php _e('Thumbnails multimedia icons.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(21) <?php _e('Adjustable thumbnails number to display / load per set.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(22) <?php _e('Adjustable thumbnail spacings / size and much more.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(23) <?php _e('Adjustable thumbnail geometry and styling.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(24) <?php _e('Social networks sharing.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(25) <?php _e('500+ Google fonts.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(26) <?php _e('Fully customizable Lightbox.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(27) <?php _e('Custom CSS Option.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(28) <?php _e('Translation ready.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(29) <?php _e('Updates and support.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(30) <?php _e('Extensive documentation.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(31) <?php _e('And many more..','SMGL_TEXT_DOMAIN'); ?></li>
		</ul>
	<?php
	}
	/**
	 * This function display Add New Album interface also loads all saved Albums 
	 */
    public function SMGL_generate_add_image_meta_box_function($post) { ?>
		<div class="" style="padding:20px;text-align: center;">
			  <a  href="http://www.webhuntinfotech.com/social-media-gallery-documentation/" target="_blank" class="btn-web button-1"><?php _e('Documention','SMGL_TEXT_DOMAIN'); ?></a>
			  <a href="http://demo.webhuntinfotech.com/social-media-gallery-pro/" target="_blank" class="btn-web button-2"><?php _e('View Live Demo (Pro)','SMGL_TEXT_DOMAIN'); ?></a>
			  <a href="http://www.webhuntinfotech.com/webhunt_plugin/social-media-gallery-pro/" target="_blank" class="btn-web button-3"><?php _e('Upgrade To Pro','SMGL_TEXT_DOMAIN'); ?></a>
		</div>
		<div >
		<?php 
		$PostId = $post->ID;
		$SMGL_Settings = smgl_get_gallery_value($PostId);

		if($SMGL_Settings['SMGP_Grid_Layout']) {
			$SMGL_Album_Type				= $SMGL_Settings['SMGP_Album_Type'];
		}
		?>
			<table class="form-table" style="background-color:#1ABC9C; margin-bottom:10px;">
				<tr>
					<th scope="row" style="padding-left:10px; color:#ffffff; width:20%"><label><?php _e('Album Type','SMGL_TEXT_DOMAIN')?>:</label></th>
					<td>
						<select name="SMGL_Album_Type" id="SMGL_Album_Type" style="padding-left:10px; width:60%">
							<optgroup label="Select Album Type">
								<option value="flickr" <?php if($SMGL_Album_Type == 'flickr') echo "selected=selected"; ?>><?php _e('Flickr Gallery','SMGL_TEXT_DOMAIN')?></option>
								<option disabled ><?php _e('Facebook Gallery (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
								<option disabled ><?php _e('Pinterest Gallery (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
								<option disabled ><?php _e('Soundcloud Gallery (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
								<option disabled ><?php _e('Youtube Gallery (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
							</optgroup>
						</select>
						<p class="description" style="color:#ffffff">
							<?php _e('Choose Album Type.','SMGL_TEXT_DOMAIN')?>
						</p>
					</td>
				</tr>
			</table>
			<input id="SMGL_delete_all_button" class="button" type="button" value="Delete All" rel="">
			<input type="hidden" id="SMGL_wl_action" name="SMGL_wl_action" value="SMGL-save-settings">
            <ul id="smgl_gallery_thumbs" class="clearfix">
				<?php
				/* load saved Ablum Details into gallery */
				$WPGP_AllAlbumsDetails = unserialize(get_post_meta( $post->ID, 'SMGP_all_albums_details', true));
				$TotalLinks =  get_post_meta( $post->ID, 'SMGP_total_album_count', true );
				if($TotalLinks) {
					foreach($WPGP_AllAlbumsDetails as $WPGP_SingleAlbumDetails) {
						$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
						$albumName = $WPGP_SingleAlbumDetails['SMGP_albumName'];
						$albumlink = $WPGP_SingleAlbumDetails['SMGP_albumlink'];
						?>
						<li class="smgl-image-entry" id="smgl_img">
							<a class="image_gallery_remove smglgallery_remove" href="#gallery_remove" id="smgl_remove_bt" ><img src="<?php echo  esc_url(SMGL_PLUGIN_URL.'images/image-close-icon.png'); ?>" /></a>
							<div class="smgl-admin-inner-div1" >
								<p>
									<label class="smgl_label"><?php _e('Ablum Name: ','SMGL_TEXT_DOMAIN')?></label>
									<input type="text" id="SMGL_albumName[]" name="SMGL_albumName[]" value="<?php echo esc_attr($albumName); ?>" placeholder="Enter Ablum Name" class="smgl_label_text">
								</p>
								<p>
									<label class="smgl_label"><?php _e('Album Link: ','SMGL_TEXT_DOMAIN')?></label>
									<input type="text" id="SMGL_albumlink[]" name="SMGL_albumlink[]" value="<?php echo esc_url($albumlink); ?>" placeholder="Enter Link URL" class="smgl_label_text">
								</p>
							</div>
							
						</li>
						<?php
					} // end of foreach
				} else {
					$TotalLinks = 0;
				}
				?>
            </ul>
        </div>

		<!--Add New Album Button-->
		<div class="smgl-image-entry add_smgl_new_image" id="smgl_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select" >
			<div class="dashicons dashicons-plus"></div>
			<p>
				<?php _e('Add New Album', 'SMGL_TEXT_DOMAIN'); ?>
			</p>
		</div>
		<div style="clear:left;"></div>
        <?php
    }

	/**
	 * Gallery Setting Meta Box
	 */
    public function SMGL_settings_meta_box_function($post) {

		require_once('social-media-gallery-settings.php');
	}

	public function SMGL_shotcode_meta_box_function() { ?>
		<p><?php _e("Use below shortcode in any Page/Post to publish your gallery", 'SMGL_TEXT_DOMAIN');?></p>
		<input readonly="readonly" type="text" value="<?php echo "[SMGP id=".get_the_ID()."]"; ?>">
		<?php
	}

	public function admin_thumb() {
		$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        ?>
		<li class="smgl-image-entry" id="smgl_img">
			<a class="image_gallery_remove smglgallery_remove" href="#gallery_remove" id="smgl_remove_bt" ><img src="<?php echo  esc_url(SMGL_PLUGIN_URL.'images/image-close-icon.png'); ?>" /></a>
			<div class="smgl-admin-inner-div1" >
				<p>
					<label class="smgl_label"><?php _e('Ablum Name: ','SMGL_TEXT_DOMAIN')?></label>
					<input type="text" id="SMGL_albumName[]" name="SMGL_albumName[]" placeholder="Enter Ablum Name" class="smgl_label_text">
				</p>
				<p>
					<label class="smgl_label"><?php _e('Album Link: ','SMGL_TEXT_DOMAIN')?></label>
					<input type="text" id="SMGL_albumlink[]" name="SMGL_albumlink[]" placeholder="Enter Link URL" class="smgl_label_text">
				</p>
			</div>
		</li>
        <?php
    }

    public function ajax_get_thumbnail() {
        echo $this->admin_thumb();
        die;
    }

	//save album details meta box values
    public function SMGL_image_meta_box_save($PostID) {
		if(isset($PostID) && isset($_POST['SMGL_wl_action'])) {
			if(isset($_POST['SMGL_albumlink'])){
				$TotalLinks = count($_POST['SMGL_albumlink']);
				$AlbemArray = array();
				if($TotalLinks) {
					for($i=0; $i < $TotalLinks; $i++) {
						$albumName 			= stripslashes($_POST['SMGL_albumName'][$i]);
						$albumlink 			= $_POST['SMGL_albumlink'][$i];
						$AlbemArray[] = array(
							'SMGP_albumName' => sanitize_text_field( $albumName ),
							'SMGP_albumlink' => esc_url_raw( $albumlink )
						);
					}
					update_post_meta($PostID, 'SMGP_all_albums_details', serialize($AlbemArray));
					update_post_meta($PostID, 'SMGP_total_album_count', $TotalLinks);
				}
			}else {
				$TotalLinks = 0;
				update_post_meta($PostID, 'SMGP_total_album_count', $TotalLinks);
				$AlbemArray = array();
				update_post_meta($PostID, 'SMGP_all_albums_details', serialize($AlbemArray));
			}
		}
    }

	//save settings meta box values
	public function SMGL_settings_meta_save($PostID) {
	  if(isset($PostID) && isset($_POST['SMGL_useIconButtons'])){
		$SMGL_Album_Type  				= $_POST['SMGL_Album_Type'] ;
		$SMGL_Grid_Layout  				= $_POST['SMGL_Grid_Layout'] ;
		$SMGL_Thumbnail    				= $_POST['SMGL_Thumbnail'];
		$SMGL_disableThumbnails			= $_POST['SMGL_disableThumbnails'];
		$SMGL_hoverColor 				= $_POST['SMGL_hoverColor'];
		$SMGL_useIconButtons    		= $_POST['SMGL_useIconButtons'];
		$SMGL_IconStyle					= $_POST['SMGL_IconStyle'];
		$SMGL_spaceBwThumbnails			= $_POST['SMGL_spaceBwThumbnails'];
		$SMGL_thumbnailBorderSize		= $_POST['SMGL_thumbnailBorderSize'];
		$SMGL_Font_Style           		= $_POST['SMGL_Font_Style'];
		$SMGL_imageHoverTextColor		= $_POST['SMGL_imageHoverTextColor'];
		$SMGL_showZoomButton			= $_POST['SMGL_showZoomButton'];
		$SMGL_Custom_CSS    			= $_POST['SMGL_Custom_CSS'];
		$SMGL_Settings_Array = serialize( array(
			'SMGP_Album_Type'          		=> $SMGL_Album_Type,
			'SMGP_Grid_Layout'          	=> $SMGL_Grid_Layout,
			'SMGP_Thumbnail'          		=> $SMGL_Thumbnail,
			'SMGP_disableThumbnails'		=> $SMGL_disableThumbnails,
			'SMGP_hoverColor'         		=> $SMGL_hoverColor,
			'SMGP_useIconButtons'          	=> $SMGL_useIconButtons,
			'SMGP_IconStyle'          		=> $SMGL_IconStyle,
			'SMGP_spaceBwThumbnails'     	=> $SMGL_spaceBwThumbnails,
			'SMGP_thumbnailBorderSize'     	=> $SMGL_thumbnailBorderSize,
			'SMGP_Font_Style'				=> $SMGL_Font_Style,
			'SMGP_imageHoverTextColor'		=> $SMGL_imageHoverTextColor,
			'SMGP_showZoomButton'			=> $SMGL_showZoomButton,
			'SMGP_Custom_CSS'   			=> $SMGL_Custom_CSS
		) );

		$SMGL_Gallery_Settings = "SMGP_Gallery_Settings_".$PostID;
		update_post_meta($PostID, $SMGL_Gallery_Settings, $SMGL_Settings_Array);
	  }
	}
}

global $SMGL;
$SMGL = SMGL::forge();

/**
 * Social Gallery Short Code [SMGP].
 */
require_once("social-media-gallery-shortcode.php");

add_action('media_buttons_context', 'smgl_add_smgl_custom_button');
add_action('admin_footer', 'smgl_add_smgl_inline_popup_content');

// Media Button for Page and Post
function smgl_add_smgl_custom_button($context) {
  $img = plugins_url( '/images/gallery.png' , __FILE__ );
  $container_id = 'SMGL';
  $title =  __('Select Gallery to insert into post','SMGL_TEXT_DOMAIN') ;
  $context = '<a class="button button-primary thickbox"  title="'. __("Select Gallery to insert into post",'SMGL_TEXT_DOMAIN').'"
  href="#TB_inline?width=400&inlineId='.$container_id.'">
		<span class="wp-media-buttons-icon" style="background: url('.esc_url( $img ).'); background-repeat: no-repeat; background-position: left bottom;"></span>
	'. __("Get Gallery Shortcode",'SMGL_TEXT_DOMAIN').'
	</a>';
  return $context;
}

// Function of inline popup content when media button click
function smgl_add_smgl_inline_popup_content() {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#smgl_galleryinsert').on('click', function() {
			var id = jQuery('#smgl-gallery-select option:selected').val();
			window.send_to_editor('<p>[SMGP id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>

	<div id="SMGL" style="display:none;">
	  <h3><?php _e('Select Any Gallery To Insert Into Post','SMGL_TEXT_DOMAIN');?></h3>
	  <?php
		$all_posts = wp_count_posts( 'smgl_cpt')->publish;
		$args = array('post_type' => 'smgl_cpt', 'posts_per_page' =>$all_posts);
		global $smgl_galleries;
		$smgl_galleries = new WP_Query( $args );
		if( $smgl_galleries->have_posts() ) { ?>
			<select id="smgl-gallery-select">
				<?php
				while ( $smgl_galleries->have_posts() ) : $smgl_galleries->the_post(); ?>
				<option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
				<?php
				endwhile;
				?>
			</select>
			<button class='button primary' id='smgl_galleryinsert'><?php _e('Insert Gallery Shortcode','SMGL_TEXT_DOMAIN');?></button>
			<?php
		} else {
			_e('No Gallery found','SMGL_TEXT_DOMAIN');
		}
		?>
	</div>
	<?php
}

function smgl_get_gallery_value($PostId){
	$SMGL_Default_Options = array(
		'SMGP_Album_Type'  				=> 'flickr',
		'SMGP_Grid_Layout'  			=> 'classic',
		'SMGP_Thumbnail'				=> 'animtext',
		'SMGP_disableThumbnails'		=> 'no',
		'SMGP_hoverColor' 				=> '#31A3DD',
		'SMGP_useIconButtons'			=> 'yes',
		'SMGP_IconStyle'				=> 'no',
		'SMGP_spaceBwThumbnails'		=> 5,
		'SMGP_thumbnailBorderSize'		=> 0,
		'SMGP_Font_Style'          		=> 'Arial',
		'SMGP_imageHoverTextColor'		=> '#FFFFFF',
		'SMGP_showZoomButton'			=> 'yes',
		'SMGP_Custom_CSS'				=> ''
	);
	
	$SMGL_Settings = "SMGP_Gallery_Settings_".$PostId;
	$SMGL_Settings = unserialize(get_post_meta( $PostId, $SMGL_Settings, true));
	
	$SMGL_Settings = wp_parse_args($SMGL_Settings , $SMGL_Default_Options);
	
	return $SMGL_Settings;
}
?>