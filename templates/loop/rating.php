<?php
/**
 * A single course loop rating
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

$class = isset( $class ) ? ' ' . $class : ' tutor-mb-8';
?>

<div class="tutor-course-ratings<?php echo esc_html( $class ); ?>">
	<div class="tutor-ratings">
		<div class="tutor-ratings-stars">
			<?php
				$course_rating = tutor_utils()->get_course_rating();
				tutor_utils()->star_rating_generator_course( $course_rating->rating_avg );
			?>
		</div>

		<?php if ( $course_rating->rating_avg > 0 ) : ?>
			<div class="tutor-ratings-average"><?php echo apply_filters( 'tutor_course_rating_average', $course_rating->rating_avg ); ?></div>
			<div class="tutor-ratings-count">(<?php echo $course_rating->rating_count > 0 ? $course_rating->rating_count : 0; ?>)</div>
		<?php endif; ?>
	</div>
</div>
