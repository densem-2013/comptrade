<?php
add_shortcode( 'SMGP', 'socialMediaGalleryShortCode' );
function socialMediaGalleryShortCode( $Id ) {
    ob_start();

/**	 Load Used Shortcode Galleries Settings	 */ 
	$CPT_Name = "smgl_cpt";
	$AllGalleries = array( 'post_id' => $Id['id'], 'post_type' => $CPT_Name, 'orderby' => 'ASC');
	$loop = new WP_Query( $AllGalleries );

	while ( $loop->have_posts() ) : $loop->the_post();

/** Load Saved Gallery Settings  */
    if(!isset($AllGalleries['post_id'])) {
        $AllGalleries['post_id'] = "";
    } else {
		$SMGL_Id = $AllGalleries['post_id'];
		$SMGL_Settings = smgl_get_gallery_value($SMGL_Id);
		if(count($SMGL_Settings)) {
			$SMGL_Album_Type				= $SMGL_Settings['SMGP_Album_Type'];
			$SMGL_Grid_Layout				= $SMGL_Settings['SMGP_Grid_Layout'];
			$SMGL_Thumbnail					= $SMGL_Settings['SMGP_Thumbnail'];
			$SMGL_disableThumbnails			= $SMGL_Settings['SMGP_disableThumbnails'];
			$SMGL_hoverColor 				= $SMGL_Settings['SMGP_hoverColor'];
			$SMGL_useIconButtons			= $SMGL_Settings['SMGP_useIconButtons'];
			$SMGL_IconStyle					= $SMGL_Settings['SMGP_IconStyle'];
			$SMGL_spaceBwThumbnails			= $SMGL_Settings['SMGP_spaceBwThumbnails'];
			$SMGL_thumbnailBorderSize		= $SMGL_Settings['SMGP_thumbnailBorderSize'];
			$SMGL_Font_Style				= $SMGL_Settings['SMGP_Font_Style'];
			$SMGL_imageHoverTextColor		= $SMGL_Settings['SMGP_imageHoverTextColor'];
			$SMGL_showZoomButton			= $SMGL_Settings['SMGP_showZoomButton'];
			$SMGL_Custom_CSS				= $SMGL_Settings['SMGP_Custom_CSS'];

			$gridType	= $SMGL_Grid_Layout.'Vertical';
			$parentId   = 'smglDiv_'.$SMGL_Id;
		}
	}
?>
	
	<style> 
		<?php echo '#'.$parentId; ?> .flickrTitle{
			color:<?php echo $SMGL_imageHoverTextColor; ?>;
			font-family:<?php echo $SMGL_Font_Style; ?> !important;
			text-align:center;
			font-size:17px;
			line-height:18px;
			padding:10px;
			font-weight:800;
		}
		<?php echo $SMGL_Custom_CSS; ?>
	</style>
	<script type="text/javascript">
		FWDRLUtils.onReady(function(){		
			new FWDUGP({
			//main settings 
				gridType:"<?php echo $gridType; ?>",
				rightClickContextMenu:"default",
				instanceName:"SMGL_<?php echo $SMGL_Id; ?>",
				parentId:"<?php echo $parentId; ?>",
				mainFolderPath:"<?php echo SMGL_PLUGIN_URL.'content'; ?>",
				gridSkinPath:"grid_skin_classic",
				lightboxSkinPath:"lightbox_skin_classic",
				playlistId:"myPlaylist_<?php echo $SMGL_Id; ?>",
				showAllCategories:"no",
				animateParent:"yes",
				startAtCategory:0,
			//thumbnail settings
				hideAndShowTransitionType:"none",
				thumbanilBoxShadow:"none",
				disableThumbnails:"<?php echo $SMGL_disableThumbnails; ?>",
				inverseButtonsIcons:"<?php echo $SMGL_IconStyle;?>",
				thumbnailBackgroundColor:"#333333",
				thumbnailsHorizontalOffset:0,
				thumbnailsVerticalOffset:0,
				horizontalSpaceBetweenThumbnails:<?php echo $SMGL_spaceBwThumbnails; ?>,
				verticalSpaceBetweenThumbnails:<?php echo $SMGL_spaceBwThumbnails; ?>,
				thumbnailBorderSize:<?php echo $SMGL_thumbnailBorderSize; ?>,
				thumbnailBorderRadius:0,
		<?php if ( $SMGL_Thumbnail == "animtext") { ?>
			//preset settings
				preset:"animtext",
				textVerticalAlign:"center",
				textAnimationType:"scale",
				useIconButtons:"<?php echo $SMGL_useIconButtons; ?>",
				thumbnailIconWidth:30,
				thumbnailIconHeight:29,
				spaceBetweenThumbanilIcons:12,
				spaceBetweenTextAndIcons:10,
		<?php } elseif($SMGL_Thumbnail == "curtain") { ?>	
			//preset settings
				preset:"curtain",
				textVerticalAlign:"center",
				imageTransitionDirection:"top",
				useIconButtons:"<?php echo $SMGL_useIconButtons; ?>",
				thumbnailIconWidth:30,
				thumbnailIconHeight:29,
				spaceBetweenThumbanilIcons:12,
				spaceBetweenTextAndIcons:2,
		<?php } ?>
				thumbnailOverlayColor:"<?php echo $SMGL_hoverColor; ?>",
				thumbnailOverlayOpacity:0.7,
			//ligtbox settings (optional)
				buttonsAlignment:"in",
				itemBoxShadow:"none",
				useAsModal:"no",
				addKeyboardSupport:"yes",
				showCloseButton:"yes",
				showZoomButton:"<?php echo $SMGL_showZoomButton; ?>",
				showSlideShowAnimation:"yes",
				showNextAndPrevButtons:"yes",
				showNextAndPrevButtonsOnMobile:"yes",
				backgroundOpacity:.9,
				descriptionWindowBackgroundOpacity:.95,
				buttonsHideDelay:3,
				slideShowDelay:4,
				defaultItemWidth:640,
				defaultItemHeight:480,
				itemOffsetHeight:50,
				spaceBetweenButtons:1,
				buttonsOffsetIn:2,
				buttonsOffsetOut:5,
				itemBorderSize:0,
				itemBorderRadius:0,
				itemBackgroundColor:"#333333",
				itemBorderColor:"#333333",
				lightBoxBackgroundColor:"#000000",
				timeColor:"#000000",
			//flickr
				flickrAppId:"8b8bea6be401b521615b9b74c12131f2",
				flickrTitleClassName:"flickrTitle",
				showFlickrDescription:"yes",
				showAsExtraText:"no",
				flickrDescriptionMaxLength:100
			});
		});	
	</script>
	<!-- UGP holder -->
	<div id="<?php echo $parentId; ?>"></div>	
	<div id="myPlaylist_<?php echo $SMGL_Id; ?>" style="display:none">
		<?php
		$WPGP_AllAlbumsDetails = unserialize(get_post_meta( $SMGL_Id, 'SMGP_all_albums_details', true));
		$TotalLinks =  get_post_meta( $SMGL_Id, 'SMGP_total_album_count', true );
		if($TotalLinks) {
			foreach($WPGP_AllAlbumsDetails as $WPGP_SingleAlbumDetails)
			{
				$albumName = $WPGP_SingleAlbumDetails['SMGP_albumName'];
				$albumlink = $WPGP_SingleAlbumDetails['SMGP_albumlink'];
			?>	
				<ul data-category-name="<?php echo $albumName; ?>" data-flickr-album-url="<?php echo $albumlink; ?>"></ul>
			<?php	
			}	
		}
		?>
	</div>
<?php
		return ob_get_clean();
		endwhile;
}
?>