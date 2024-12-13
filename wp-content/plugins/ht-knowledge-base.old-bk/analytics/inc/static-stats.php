<?php
/**
* Analytics module
* Static statistics
*
*/

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'HKB_Static_Stats' )) {
	class HKB_Static_Stats {
	
		function __construct() {
			//doing it wrong, these are all static
		}

		public static function hkba_get_total_article_views(){
			global $wpdb;
			 $total_visits_query = "SELECT
									  COUNT(*) as totalVisits
									 FROM {$wpdb->prefix}hkb_visits
									 WHERE object_type = 'ht_kb_article'
									";
			
			//Article views
			$stats = $wpdb->get_results($total_visits_query);
			return (int) $stats[0]->totalVisits;
		}

		public static function hkba_get_feedback_overview(){
			global $wpdb;
			$feedback_responses_query = "SELECT COUNT(*) AS totalResponses,
										SUM(CASE WHEN {$wpdb->prefix}" . HT_VOTING_TABLE  .".magnitude > 0 THEN 1 ELSE 0 END) AS totalUp,
										SUM(CASE WHEN {$wpdb->prefix}" . HT_VOTING_TABLE  .".magnitude = 0 THEN 1 ELSE 0 END) AS totalDown
										FROM {$wpdb->prefix}" . HT_VOTING_TABLE  .
										" ";
			//feedback overview
			$stats = $wpdb->get_results($feedback_responses_query);
			$data = $stats[0];

			//hard set the variables
			$data->totalUp = (isset($data->totalUp)) ? $data->totalUp : '-';
			$data->totalDown = (isset($data->totalDown)) ? $data->totalDown : '-';

			return ((int)$data->totalResponses > 0) ? round( ( (int)$data->totalUp / (int)$data->totalResponses )*100 ) : 100;
		}

	}

}