<?php
/**
 * Display the content
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
global $previous_id;
global $next_id;

// Get the ID of this content and the corresponding course
$course_content_id = get_the_ID();
$course_id         = tutor_utils()->get_course_id_by_subcontent( $course_content_id );

$_is_preview = get_post_meta( $course_content_id, '_is_preview', true );
$content_id  = tutor_utils()->get_post_id( $course_content_id );
$contents    = tutor_utils()->get_course_prev_next_contents_by_id( $content_id );
$previous_id = $contents->previous_id;
$next_id     = $contents->next_id;

// Get total content count
$course_stats = tutor_utils()->get_course_completed_percent( $course_id, 0, true );

$jsonData                                 = array();
$jsonData['post_id']                      = get_the_ID();
$jsonData['best_watch_time']              = 0;
$jsonData['autoload_next_course_content'] = (bool) get_tutor_option( 'autoload_next_course_content' );

$best_watch_time = tutor_utils()->get_lesson_reading_info( get_the_ID(), 0, 'video_best_watched_time' );
if ( $best_watch_time > 0 ) {
	$jsonData['best_watch_time'] = $best_watch_time;
}

$is_comment_enabled = tutor_utils()->get_option( 'enable_comment_for_lesson' ) && comments_open();
$is_enrolled = tutor_utils()->is_enrolled( $course_id );
?>

<?php do_action( 'tutor_lesson/single/before/content' ); ?>
<?php if ( $is_enrolled ) : ?>
	<div class="tutor-single-page-top-bar tutor-bs-d-flex justify-content-between">
		<div class="tutor-topbar-left-item tutor-bs-d-flex">
			<div class="tutor-topbar-item tutor-topbar-sidebar-toggle tutor-hide-sidebar-bar flex-center tutor-bs-d-none tutor-bs-d-xl-flex">
				<a href="javascript:;" class="tutor-lesson-sidebar-hide-bar">
					<span class="tutor-icon-icon-light-left-line tutor-color-text-white flex-center"></span>
				</a>
			</div>
			<div class="tutor-topbar-item tutor-topbar-content-title-wrap flex-center">
				<span class="tutor-icon-youtube-brand tutor-icon-24 tutor-color-text-white tutor-mr-5"></span>
				<span class="text-regular-caption tutor-color-design-white">
					<?php
						esc_html_e( 'Lesson: ', 'tutor' );
						the_title();
					?>
				</span>
			</div>
		</div>
		<div class="tutor-topbar-right-item tutor-bs-d-flex">
			<div class="tutor-topbar-assignment-details d-flex align-items-center">
				<?php
					do_action( 'tutor_course/single/enrolled/before/lead_info/progress_bar' );
				?>
				<div class="text-regular-caption tutor-color-design-white">
					<span class="tutor-progress-content tutor-color-primary-60">
						<?php _e( 'Your Progress:', 'tutor' ); ?>
					</span>
					<span class="text-bold-caption">
						<?php echo $course_stats['completed_count']; ?>
					</span>
					<?php _e( 'of ', 'tutor' ); ?>
					<span class="text-bold-caption">
						<?php echo $course_stats['total_count']; ?>
					</span>
					(<?php echo $course_stats['completed_percent'] . '%'; ?>)
				</div>
				<?php
					do_action( 'tutor_course/single/enrolled/after/lead_info/progress_bar' );
				?>
				<!-- <div class="tutor-topbar-complete-btn tutor-ml-24"> -->
					<?php tutor_lesson_mark_complete_html(); ?>
				<!-- </div> -->
			</div>
			<div class="tutor-topbar-cross-icon tutor-ml-15 flex-center">
				<?php $course_id = tutor_utils()->get_course_id_by( 'lesson', get_the_ID() ); ?>
				<a href="<?php echo get_the_permalink( $course_id ); ?>">
					<span class="tutor-icon-line-cross-line tutor-color-text-white flex-center"></span>
				</a>
			</div>
		</div>
	</div>
	<div class="tutor-mobile-top-navigation tutor-bs-d-block tutor-bs-d-sm-none tutor-my-20 tutor-mx-10">
		<div class="tutor-mobile-top-nav d-grid">
			<a href="<?php echo get_the_permalink( $previous_id ); ?>">
				<span class="tutor-top-nav-icon tutor-icon-previous-line design-lightgrey"></span>
			</a>
			<div class="tutor-top-nav-title tutor-text-regular-body tutor-color-text-primary">
				<?php
					the_title();
				?>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="tutor-single-page-top-bar tutor-bs-d-flex justify-content-between">
		<div class="tutor-topbar-item tutor-topbar-sidebar-toggle tutor-hide-sidebar-bar flex-center tutor-bs-d-none tutor-bs-d-xl-flex">
			<a href="javascript:;" class="tutor-lesson-sidebar-hide-bar">
				<span class="tutor-icon-icon-light-left-line tutor-color-text-white flex-center"></span>
			</a>
		</div>
		<div class="tutor-topbar-item tutor-topbar-content-title-wrap flex-center">
			<span class="tutor-icon-youtube-brand tutor-icon-24 tutor-color-text-white tutor-mr-5"></span>
			<span class="text-regular-caption tutor-color-design-white">
				<?php
					esc_html_e( 'Lesson: ', 'tutor' );
					the_title();
				?>
			</span>
		</div>

		<div class="tutor-topbar-cross-icon tutor-ml-15 flex-center">
			<?php $course_id = tutor_utils()->get_course_id_by( 'lesson', get_the_ID() ); ?>
			<a href="<?php echo get_the_permalink( $course_id ); ?>">
				<span class="tutor-icon-line-cross-line tutor-color-text-white flex-center"></span>
			</a>
		</div>
	</div>
<?php endif; ?>

<!-- Load Lesson Video -->
<input type="hidden" id="tutor_video_tracking_information" value="<?php echo esc_attr( json_encode( $jsonData ) ); ?>">
<?php 
// tutor_lesson_video();

$referer_url        = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
$referer_comment_id = explode( '#', $_SERVER['REQUEST_URI'] );
$url_components     = parse_url( $referer_url );
isset( $url_components['query'] ) ? parse_str( $url_components['query'], $output ) : null;
$page_tab = isset( $_GET['page_tab'] ) ? esc_attr( $_GET['page_tab'] ) : ( isset($output['page_tab']) ?$output['page_tab']: null );
?>

<style>
.tutor-actual-comment.viewing{
	box-shadow: 0 0 10px #cdcfd5;
	animation: blinkComment 1s infinite;
}
@keyframes blinkComment { 50% { box-shadow:0 0 0px #ffffff; }  }

</style>
<div class="tutor-course-spotlight-wrapper">

	<div class="course-players-wrapper">
		<div class="course-players">

			<!-- <div tabindex="0" class="plyr plyr--full-ui plyr--video plyr--html5 plyr--fullscreen-enabled plyr--paused plyr--stopped plyr--pip-supported"><div class="plyr__controls"><button class="plyr__controls__item plyr__control" type="button" data-plyr="play" aria-label="Play"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-pause"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-play"></use></svg><span class="label--pressed plyr__sr-only">Pause</span><span class="label--not-pressed plyr__sr-only">Play</span></button><div class="plyr__controls__item plyr__progress__container"><div class="plyr__progress"><input data-plyr="seek" type="range" min="0" max="100" step="0.01" value="0" autocomplete="off" role="slider" aria-label="Seek" aria-valuemin="0" aria-valuemax="3.605333" aria-valuenow="0" id="plyr-seek-2684" aria-valuetext="00:00 of 00:00" style="--value:0%;" seek-value="33.2153046152601"><progress class="plyr__progress__buffer" min="0" max="100" value="0" role="progressbar" aria-hidden="true">% buffered</progress><span class="plyr__tooltip" style="left: 33.3448%;">00:01</span></div></div><div class="plyr__controls__item plyr__time--current plyr__time" aria-label="Current time">00:03</div><div class="plyr__controls__item plyr__volume"><button type="button" class="plyr__control" data-plyr="mute"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-muted"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-volume"></use></svg><span class="label--pressed plyr__sr-only">Unmute</span><span class="label--not-pressed plyr__sr-only">Mute</span></button><input data-plyr="volume" type="range" min="0" max="1" step="0.05" value="1" autocomplete="off" role="slider" aria-label="Volume" aria-valuemin="0" aria-valuemax="100" aria-valuenow="40" id="plyr-volume-2684" aria-valuetext="40.0%" style="--value:40%;"></div><button class="plyr__controls__item plyr__control" type="button" data-plyr="captions"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-captions-on"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-captions-off"></use></svg><span class="label--pressed plyr__sr-only">Disable captions</span><span class="label--not-pressed plyr__sr-only">Enable captions</span></button><div class="plyr__controls__item plyr__menu"><button aria-haspopup="true" aria-controls="plyr-settings-2684" aria-expanded="false" type="button" class="plyr__control" data-plyr="settings"><svg aria-hidden="true" focusable="false"><use xlink:href="#plyr-settings"></use></svg><span class="plyr__sr-only">Settings</span></button><div class="plyr__menu__container" id="plyr-settings-2684" hidden=""><div><div id="plyr-settings-2684-home"><div role="menu"><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true" hidden=""><span>Captions<span class="plyr__menu__value">Disabled</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true" hidden=""><span>Quality<span class="plyr__menu__value">0</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true"><span>Speed<span class="plyr__menu__value">Normal</span></span></button></div></div><div id="plyr-settings-2684-captions" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Captions</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"></div></div><div id="plyr-settings-2684-quality" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Quality</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"></div></div><div id="plyr-settings-2684-speed" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Speed</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.5"><span>0.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.75"><span>0.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="true" value="1"><span>Normal</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.25"><span>1.25×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.5"><span>1.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.75"><span>1.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="2"><span>2×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="4"><span>4×</span></button></div></div></div></div></div><button class="plyr__controls__item plyr__control" type="button" data-plyr="pip"><svg aria-hidden="true" focusable="false"><use xlink:href="#plyr-pip"></use></svg><span class="plyr__sr-only">PIP</span></button><button class="plyr__controls__item plyr__control" type="button" data-plyr="fullscreen"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-exit-fullscreen"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-enter-fullscreen"></use></svg><span class="label--pressed plyr__sr-only">Exit fullscreen</span><span class="label--not-pressed plyr__sr-only">Enter fullscreen</span></button></div><div class="plyr__video-wrapper"><video poster="" class="tutorPlayer" playsinline="">
				<source src="http://tutorv2.local/wp-content/uploads/2022/01/tutor-certificate-animation-1-1.mp4" type="video/mp4">
				</video><div class="plyr__poster" hidden=""></div></div><div class="plyr__captions"></div><button type="button" class="plyr__control plyr__control--overlaid" data-plyr="play" aria-label="Play"><svg aria-hidden="true" focusable="false"><use xlink:href="#plyr-play"></use></svg><span class="plyr__sr-only">Play</span></button>
			</div> -->


			<div class="wp-block-presto-player-reusable-edit"><!--presto-player:video_id=1--><figure class="wp-block-video presto-block-video  presto-provider-youtube" style="--plyr-color-main: #00b3ff; --presto-player-logo-width: 150px; ">
			<presto-player id="presto-player-1" src="//www.youtube.com/embed/7ybTFy8VJxs?iv_load_policy=3&amp;modestbranding=1&amp;playinline=0&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" media-title="Nasek Nasek | Behind The Magic | Coke Studio Bangla" css="" class="presto-video-id-1 presto-preset-id-1 skin-modern hydrated" skin="modern" icon-url="http://tutorv2.local/wp-content/plugins/presto-player/img/sprite.svg" preload="" poster="//img.youtube.com/vi/7ybTFy8VJxs/maxresdefault.jpg" style="height: auto;">
				
			

			</presto-player>
		</figure>        <script>
					var player = document.querySelector('presto-player#presto-player-1');
					player.video_id = 1;
														player.preset = {"id":1,"name":"Default","slug":"default","icon":"format-video","skin":"modern","play-large":true,"rewind":true,"play":true,"fast-forward":true,"progress":true,"current-time":true,"mute":true,"volume":true,"speed":false,"pip":false,"fullscreen":true,"captions":false,"reset_on_end":true,"auto_hide":true,"captions_enabled":false,"save_player_position":true,"sticky_scroll":false,"sticky_scroll_position":"bottom right","on_video_end":"select","play_video_viewport":false,"hide_youtube":false,"lazy_load_youtube":false,"hide_logo":false,"border_radius":0,"caption_style":"","caption_background":"","is_locked":true,"cta":[""],"watermark":[""],"email_collection":[""],"action_bar":[""],"created_by":1,"created_at":"2022-03-03 19:09:14","updated_at":"2022-03-03 19:09:14","deleted_at":""};
																		player.chapters = [];
																		player.overlays = [];
																		player.tracks = [];
																		player.branding = {"logo":"","color":"#00b3ff","logo_width":150,"player_css":""};
																		player.blockAttributes = {"id":1,"src":"https:\/\/www.youtube.com\/watch?v=7ybTFy8VJxs","preset":1,"video_id":"7ybTFy8VJxs","color":"#00b3ff","pip":true,"fullscreen":true,"captions":false,"hideControls":true,"playLarge":true,"chapters":[],"overlays":[],"speed":true,"title":"Nasek Nasek | Behind The Magic | Coke Studio Bangla"};
																									player.skin = "modern";
																		player.analytics = false;
																		player.automations = true;
																		player.provider = "youtube";
																		player.video_id = 1;
																		player.provider_video_id = "7ybTFy8VJxs";
																		player.youtube = {"noCookie":false,"channelId":"","show_count":false};
											</script>
				</div>


			
		</div>
		<div class="tutor-single-course-content-next flex-center">
			<a href="http://tutorv2.local/courses/yo-title-course-info-tools/lesson/l2-presto/">
				<span class="tutor-icon-angle-right-filled"></span>
			</a>
		</div>
    </div>

	<div class="tutor-spotlight-tab tutor-default-tab tutor-course-details-tab">
		<div class="tab-header tutor-bs-d-flex justify-content-center">
			<div class="tab-header-item flex-center<?php echo (!isset($page_tab) || 'overview'==$page_tab) ? ' is-active' : ''; ?>" data-tutor-spotlight-tab-target="tutor-course-spotlight-tab-1" data-tutor-query-string="overview">
				<span class="tutor-icon-document-alt-filled"></span>
				<span><?php _e( 'Overview', 'tutor' ); ?></span>
			</div>
			<div class="tab-header-item flex-center<?php echo 'files'==$page_tab ? ' is-active' : ''; ?>" data-tutor-spotlight-tab-target="tutor-course-spotlight-tab-2" data-tutor-query-string="files">
				<span class="tutor-icon-attach-filled"></span>
				<span><?php _e( 'Exercise Files', 'tutor' ); ?></span>
			</div>
			<?php if ( $is_comment_enabled ) : ?>
				<div class="tab-header-item flex-center<?php echo 'comments'==$page_tab ? ' is-active' : ''; ?>" data-tutor-spotlight-tab-target="tutor-course-spotlight-tab-3" data-tutor-query-string="comments">
					<span class="tutor-icon-comment-filled"></span>
					<span><?php _e( 'Comments', 'tutor' ); ?></span>
				</div>
			<?php endif; ?>
		</div>
		<div class="tab-body">
			<div class="tab-body-item<?php echo (!isset($page_tab) || 'overview'==$page_tab) ? ' is-active' : ''; ?>" id="tutor-course-spotlight-tab-1" data-tutor-query-string-content="overview">
				<div class="text-medium-h6 tutor-color-text-primary"><?php _e( 'About Lesson', 'tutor' ); ?></div>
				<div class="text-regular-body tutor-color-text-subsued tutor-mt-12">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="tab-body-item<?php echo 'files'==$page_tab ? ' is-active' : ''; ?>" id="tutor-course-spotlight-tab-2" data-tutor-query-string-content="files">
				<div class="text-medium-h6 tutor-color-text-primary"><?php _e( 'Exercise Files', 'tutor' ); ?></div>
				<?php get_tutor_posts_attachments(); ?>
			</div>
			<?php if ( $is_comment_enabled ) : ?>
				<div class="tab-body-item<?php echo 'comments'==$page_tab ? ' is-active' : ''; ?>" id="tutor-course-spotlight-tab-3" data-tutor-query-string-content="comments">
					<?php require __DIR__ . '/comment.php'; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php do_action( 'tutor_lesson/single/after/content' ); ?>
