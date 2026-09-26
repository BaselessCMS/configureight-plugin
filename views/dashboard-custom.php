<?php
/**
 * Custom dashboard page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Dashboard
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	site,
	lang,
	suite_plugins_active,
	plugin_options_url
};

$username = $login->username();
$user = new User( $username );
$name = lang()->get( 'Friend' );
if ( $user->firstName() ) {
	$name = $user->firstName();
} elseif ( $user->nickname() ) {
	$name = $user->nickname();
}

$sticky = count( $pages->getStickyDB() );
$posts  = count( $pages->getPublishedDB() );
$published = $sticky + $posts;

$posts_published = lang()->get( 'Posts' );
if ( 1 === $published ) {
	$posts_published = lang()->get( 'Post' );
}
$pages_published = lang()->get( 'Pages' );
if ( 1 === count( $pages->getPublishedDB() ) ) {
	$pages_published = lang()->get( 'Page' );
}
$pages_draft = lang()->get( 'Drafts' );
if ( 1 === count( $pages->getDraftDB() ) ) {
	$pages_draft = lang()->get( 'Draft' );
}
$pages_scheduled = lang()->get( 'Scheduled' );
if ( 1 === count( $pages->getScheduledDB() ) ) {
	$pages_scheduled = lang()->get( 'Scheduled' );
}

?>
<div id="dashboard">

	<h1 class="page-title"><?php lang()->p( 'Website Dashboard' ); ?></h1>

	<?php printf(
		lang()->get( '<p>Welcome, %s, to the %s administration dashboard.</p>' ),
		$name,
		site()->title()
	); ?>

	<div class="tab-content" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="intro" aria-selected="false" href="#intro"><?php lang()->p( 'Home' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="logs" aria-selected="false" href="#logs"><?php lang()->p( 'Logs' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="customize" aria-selected="false" href="#customize"><?php lang()->p( 'Customize' ); ?></a>
		</li>
	</ul>

	<div id="intro" class="tab-pane" role="tabpanel" aria-labelledby="intro">


	<!-- Content search -->
	<?php
	$username = $login->username();
	$user     = new User( $username );
	$name     = '';
	if ( $user->nickname() ) {
		$name = $user->nickname();
	} elseif ( $user->firstName() ) {
		$name = $user->firstName();
	} ?>
	<div class="quick-search-trigger mb-4" id="searchTrigger">
		<span class="quick-search-text">
			<span class="quick-search-hint"><?php lang()->p( 'Search titles' ); ?></span>
		</span>
		<span class="quick-search-shortcut">Ctrl/Cmd + K</span>
	</div>

	<!-- Quick search modal -->
	<div class="quick-search-modal" id="searchModal">
		<div class="quick-search-overlay" id="searchOverlay"></div>
		<div class="quick-search-content">
			<div class="quick-search-header">
				<input type="text" id="jsclippy" class="quick-search-input" placeholder="<?php lang()->p( 'Search titles' ); ?>">
			</div>
			<div id="searchResults" class="quick-search-results"></div>
		</div>
	</div>

	<script>
		$(document).ready( function() {
			var searchInput   = $('#jsclippy'),
				searchResults = $('#searchResults'),
				modal   = $('#searchModal'),
				trigger = $('#searchTrigger'),
				overlay = $('#searchOverlay'),
				searchTimeout;

			function openSearch() {
				modal.addClass( 'active' );
				$( 'body' ).css( 'overflow', 'hidden' );
				setTimeout( function() {
					searchInput.focus();
				}, 150 );
			}
			function closeSearch() {
				modal.removeClass( 'active' );
				$( 'body' ).css( 'overflow', '' );
				searchInput.val('');
				searchResults.empty();
			}
			function performSearch( query ) {
				if ( ! query ) {
					searchResults.empty();
					return;
				}
				$.ajax({
					url  : HTML_PATH_ADMIN_ROOT + "ajax/clippy",
					data : { query: query },
					success : function( data ) {
						searchResults.empty();

						if ( data.results && data.results.length > 0 ) {
							data.results.forEach( function( item ) {
								var resultHtml = '';
								if ( item.type == 'menu' ) {
									resultHtml = '<a href="' + item.url + '" class="search-suggestion">';
									resultHtml += item.text + '</a>';
								} else {
									resultHtml = '<div class="search-suggestion">';
									resultHtml += '<div class="search-suggestion-item">' + item.text + ' <span class="badge badge-pill badge-light">' + item.type + '</span></div>';
									resultHtml += '<div class="search-suggestion-options">';
									resultHtml += '<a target="_blank" href="' + DOMAIN_PAGES + item.id + '"><?php lang()->p( 'view' ); ?></a>';
									resultHtml += '<a class="ml-2" href="' + DOMAIN_ADMIN + 'edit-content/' + item.id + '"><?php lang()->p( 'edit' ); ?></a>';
									resultHtml += '</div></div>';
								}
								searchResults.append( resultHtml );
							});
						} else {
							searchResults.html( '<div class="search-no-results"><?php lang()->p( 'no-results-found' ); ?></div>');
						}
					}
				});
			}
			searchInput.on( 'input', function() {
				clearTimeout( searchTimeout );
				var query = $(this).val();
				searchTimeout = setTimeout( function() {
					performSearch( query );
				}, 300);
			});

			trigger.on( 'click', openSearch );
			overlay.on( 'click', closeSearch );

			$(document).on( 'keydown', function(e) {
				if ( e.key === 'Escape' && modal.hasClass( 'active' ) ) {
					closeSearch();
				}
				if ( ( e.metaKey || e.ctrlKey ) && e.key === 'k' ) {
					e.preventDefault();
					openSearch();
				}
			});
		});
	</script>

	<div id="dashboard-content-widgets">
		<div class="dashboard-widget">
			<h3><?php lang()->p( 'Content' ); ?></h3>

			<ul class="dashboard-links-list">
				<li><a href="<?php echo HTML_PATH_ADMIN_ROOT . 'content' ?>"><?php echo $posts_published; ?> (<?php echo $published; ?>)</a></li>

				<li><a href="<?php echo HTML_PATH_ADMIN_ROOT . 'content#static' ?>"><?php echo $pages_published; ?> (<?php echo count( $pages->getStaticDB() ); ?>)</a></li>

				<li><a href="<?php echo HTML_PATH_ADMIN_ROOT . 'content#draft' ?>"><?php echo $pages_draft; ?> (<?php echo count( $pages->getDraftDB() ); ?>)</a></li>

				<li><a href="<?php echo HTML_PATH_ADMIN_ROOT . 'content#scheduled' ?>"><?php echo $pages_scheduled; ?> (<?php echo count( $pages->getScheduledDB() ); ?>)</a></li>
			</ul>
		</div>
		<div class="dashboard-widget">
			<?php
			if ( pluginActivated( 'Categories_Lists' ) ) :
				$cats_args = [
					'wrap'       => false,
					'wrap_class' => 'list-wrap cats-list-wrap',
					'direction'  => 'vert',
					'list_class' => 'dashboard-links-list',
					'label'      => lang()->get( 'Categories' ),
					'label_el'   => 'h3',
					'links'      => 'admin',
					'show_count' => true,
					'hide_empty' => false
				];
			echo CatLists\cats_list( $cats_args );
			endif; ?>
		</div>
		<div class="dashboard-widget">
		<?php
		if ( pluginActivated( 'Tags_Lists' ) ) :
			$tags_args = [
				'wrap'       => false,
				'wrap_class' => 'list-wrap tags-list-wrap',
				'direction'  => 'vert',
				'list_class' => 'dashboard-links-list',
				'label'      => lang()->get( 'Tags' ),
				'label_el'   => 'h3',
				'links'      => true,
				'show_count' => true,
				'hide_empty' => false
			];
		echo TagLists\tags_list( $tags_args );
		endif; ?>
		</div>
	</div>
	</div><!-- Intro tab -->

	<div id="logs" class="tab-pane" role="tabpanel" aria-labelledby="logs">

		<?php
		$visitsStats = getPlugin( 'pluginVisitsStats' );
		if ( $visitsStats && $visitsStats->installed() ):
			$currentDate    = Date :: current( 'Y-m-d' );
			$visitsToday    = $visitsStats->visits( $currentDate );
			$uniqueVisitors = $visitsStats->uniqueVisitors( $currentDate );
			$weekData       = $visitsStats->getLastDaysData(7);
		?>

		<!-- Analytics Section -->
		<div id="analytics-section" class="analytics-section">

			<h3><?php lang()->p( 'Website Analytics' ); ?></h3>

			<div>
				<div class="analytics-list">
					<span>
						<span class="metric-label"><?php lang()->p( 'Visits Today:' ); ?></span>
						<span class="metric-value"><?php echo $visitsToday; ?></span>
					</span>
					|
					<span>
						<span class="metric-label"><?php lang()->p( 'Unique Visitors:' ); ?></span>
						<span class="metric-value"><?php echo $uniqueVisitors; ?></span>
					</span>
					|
					<span>
						<span class="metric-label"><?php lang()->p( '7-Day Total:' ); ?></span>
						<span class="metric-value"><?php echo $weekData['total']; ?></span>
					</span>
				</div>
			</div>
			<div>
				<canvas id="analytics-chart"></canvas>
			</div>
		</div>
		<script>
		(function() {
			var ctx = document.getElementById('analytics-chart');
			if (!ctx || typeof Chart === 'undefined') { return; }
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: <?php echo json_encode($weekData['labels']); ?>,
					datasets: [{
						label: <?php echo json_encode(lang()->g('unique-visitors'), JSON_HEX_TAG | JSON_UNESCAPED_UNICODE) ?>,
						backgroundColor: 'rgba(0,120,212,0.45)',
						borderColor: 'rgba(0,120,212,0.75)',
						borderWidth: 1,
						data: <?php echo json_encode($weekData['unique']); ?>
					}, {
						label: <?php echo json_encode(lang()->g('visits-today'), JSON_HEX_TAG | JSON_UNESCAPED_UNICODE) ?>,
						backgroundColor: 'rgba(148,163,184,0.5)',
						borderColor: 'rgba(100,116,139,0.8)',
						borderWidth: 1,
						data: <?php echo json_encode($weekData['visits']); ?>
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: true,
					aspectRatio: 4,
					legend: {
						display: true,
						position: 'bottom',
						labels: { fontSize: 11, boxWidth: 12, fontColor: '#475569' }
					},
					scales: {
						yAxes: [{
							ticks: { beginAtZero: true, stepSize: 1, fontColor: '#94A3B8', fontSize: 11 },
							gridLines: { color: 'rgba(0,0,0,0.05)', zeroLineColor: 'rgba(0,0,0,0.1)' }
						}],
						xAxes: [{
							ticks: { fontColor: '#94A3B8', fontSize: 11 },
							gridLines: { display: false }
						}]
					},
					tooltips: { mode: 'index', intersect: false }
				}
			});
		})();
		</script>
		<?php endif; ?>

		<hr />

		<h3><?php lang()->p( 'Activity Logs' ); ?></h3>

		<ul class="list-group list-group-striped">
			<?php
			$logs = array_slice( $syslog->db, 0, NOTIFICATIONS_AMOUNT );
			foreach ( $logs as $log ) {

				$phrase = lang()->g( $log['dictionaryKey'] );
				echo '<li class="list-group-item">';
				echo $phrase;
				if ( ! empty( $log['notes'] ) ) {
					echo ' <strong>' . htmlspecialchars( $log['notes'], ENT_QUOTES, 'UTF-8' ) . '</strong>';
				}
				echo '<br><span class="notification-date"><small>';
				echo lang()->get( 'Date:' ) . ' ' . Date :: format( $log['date'], DB_DATE_FORMAT, NOTIFICATIONS_DATE_FORMAT );
				echo ' | ' . lang()->get( 'User:' ) . ' ' . htmlspecialchars( $log['username'], ENT_QUOTES, 'UTF-8' );
				echo '</small></span>';
				echo '</li>';
			} ?>
		</ul>
	</div><!-- Logs tab -->

	<div id="customize" class="tab-pane" role="tabpanel" aria-labelledby="customize">
		<?php
		// Admin page links.
		$settings = plugin_options_url( plugin()->className() );
		$guide    = DOMAIN_ADMIN . 'plugin/' . plugin()->className();
		$colors   = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=colors';
		$fonts    = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=fonts';
		$database = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=database';

		?>
		<div id="dashboard-customize-links">

			<h3><?php lang()->p( 'Customize This Website' ); ?></h3>

			<ul class="customize-links-list">
				<li><a href="<?php echo $settings; ?>"><?php lang()->p( 'Website Configuration' ); ?></a></li>
				<li><a href="<?php echo $guide; ?>"><?php lang()->p( 'Options Guide' ); ?></a></li>
				<li><a href="<?php echo $colors; ?>"><?php lang()->p( 'Colors Reference' ); ?></a></li>
				<li><a href="<?php echo $fonts; ?>"><?php lang()->p( 'Fonts Reference' ); ?></a></li>

				<?php
				foreach ( suite_plugins_active() as $plugin ) {
					$plugin = getPlugin( $plugin );
					printf(
						'<li><a href="%s">%s</a></li>',
						plugin_options_url( $plugin->className() ),
						$plugin->name()
					);
				}
				?>
				<li><a href="<?php echo $database; ?>"><?php lang()->p( 'Options Databases' ); ?></a></li>
			</ul>
		</div>
	</div>
	</div><!-- Tabs container -->
</div>
