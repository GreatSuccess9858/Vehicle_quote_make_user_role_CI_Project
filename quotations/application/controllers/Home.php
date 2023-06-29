<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (defined('REQUEST') && REQUEST == "external") {
			return;
		}
		$this->template->loadData("activeLink",
			array("home" => array("general" => 1)));

		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("instancias_model");

		if (!$this->user->loggedin) {
			redirect(site_url("login"));
		}
	}

	function index_gestor() {
		$rows = $this->instancias_model->get(array());

		$data = array(
			"new_members" => 0,
			"stats" => 0,
			"online_count" => 0,

		);
		$data['instancias'] = $rows;
		$this->template->loadContent("home/index_gestor.php", $data);
	}
	public function index() {
		if (defined('REQUEST') && REQUEST == "external") {
			return;
		}

		if (_is_tutor()) {
			redirect(site_url('home/index_tutor'));
		}
		$new_members = $this->user_model->get_new_members(5);
		$months = array();

		// Graph Data
		$current_month = date("n");
		$current_year = date("Y");

		// First month
		for ($i = 6; $i >= 0; $i--) {
			// Get month in the past
			$new_month = $current_month - $i;
			// If month less than 1 we need to get last years months
			if ($new_month < 1) {
				$new_month = 12 + $new_month;
				$new_year = $current_year - 1;
			} else {
				$new_year = $current_year;
			}
			// Get month name using mktime
			$timestamp = mktime(0, 0, 0, $new_month, 1, $new_year);
			$count = $this->user_model
				->get_registered_users_date($new_month, $new_year);
			$months[] = array(
				"date" => date("F", $timestamp),
				"count" => $count,
			);
		}

		$javascript = 'var data_graph = {
					    labels: [';
		foreach ($months as $d) {
			$javascript .= '"' . $d['date'] . '",';
		}
		$javascript .= '],
		    datasets: [
		        {
		            label: "My First dataset",
		            fillColor: "rgba(220,220,220,0.2)",
		            strokeColor: "rgba(220,220,220,1)",
		            pointColor: "rgba(220,220,220,1)",
		            pointStrokeColor: "#fff",
		            pointHighlightFill: "#fff",
		            pointHighlightStroke: "rgba(220,220,220,1)",
		            data: [';
		foreach ($months as $d) {
			$javascript .= $d['count'] . ',';
		}
		$javascript .= ']
		        }
		    ]
		};';

		$stats = $this->home_model->get_home_stats();
		if ($stats->num_rows() == 0) {
			$this->template->error(lang("error_24"));
		} else {
			$stats = $stats->row();
			if ($stats->timestamp < time() - $this->settings->info->cache_time) {
				$stats = $this->get_fresh_results($stats);
				// Update Row
				$this->home_model->update_home_stats($stats);
			}
		}

		$javascript .= ' var social_data = [
		    {
		        value: ' . $stats->google_members . ',
		        color:"#F7464A",
		        highlight: "#FF5A5E",
		        label: "Google"
		    },
		    {
		        value: ' . ($stats->total_members - ($stats->google_members +
			$stats->facebook_members + $stats->twitter_members)) . ',
		        color: "#39bc2c",
		        highlight: "#5AD3D1",
		        label: "' . lang("ctn_242") . '"
		    },
		    {
		        value: ' . $stats->facebook_members . ',
		        color: "#2956BF",
		        highlight: "#FFC870",
		        label: "Facebook"
		    },
		    {
		        value: ' . $stats->twitter_members . ',
		        color: "#5BACD4",
		        highlight: "#7db864",
		        label: "Twitter"
		    }
		];';

		$this->template->loadExternal(
			'<script type="text/javascript" src="'
			. base_url() . 'scripts/libraries/Chart.min.js" /></script>
			<script type="text/javascript">' . $javascript . '</script>
			<script type="text/javascript" src="'
			. base_url() . 'scripts/custom/home.js" /></script>'
		);

		$online_count = $this->user_model->get_online_count();

		$this->template->loadContent("home/index.php", array(
			"new_members" => $new_members,
			"stats" => $stats,
			"online_count" => $online_count,
		)
		);
	}

	function index_tutor() {

		$rows = $this->instancias_model->get(array("tutores_id" => _id()));

		$data = array(
			"new_members" => 0,
			"stats" => 0,
			"online_count" => 0,

		);

		$data['instancias'] = $rows;
		$this->template->loadContent("home/index_tutor.php", $data);

	}

	private function get_fresh_results($stats) {
		$data = new STDclass;

		$data->google_members = $this->user_model->get_oauth_count("google");
		$data->facebook_members = $this->user_model->get_oauth_count("facebook");
		$data->twitter_members = $this->user_model->get_oauth_count("twitter");
		$data->total_members = $this->user_model->get_total_members_count();
		$data->new_members = $this->user_model->get_new_today_count();
		$data->active_today = $this->user_model->get_active_today_count();

		return $data;
	}

	public function change_language() {

		$languages = $this->config->item("available_languages");
		if (!isset($_COOKIE['language'])) {
			$lang = "";
		} else {
			$lang = $_COOKIE["language"];
		}
		$this->template->loadContent("home/change_language.php", array(
			"languages" => $languages,
			"user_lang" => $lang,
		)
		);
	}

	public function change_language_pro() {

		$lang = $this->common->nohtml($this->input->post("language"));
		$languages = $this->config->item("available_languages");

		if (!array_key_exists($lang, $languages)) {
			$this->template->error(lang("error_25"));
		}

		setcookie("language", $lang, time() + 3600 * 7, "/");
		$this->session->set_flashdata("globalmsg", lang("success_14"));
		redirect(site_url());
	}

	public function load_notifications() {
		$notifications = $this->user_model
			->get_notifications($this->user->info->ID);
		$this->template->loadAjax("home/ajax_notifications.php", array(
			"notifications" => $notifications,
		), 0
		);
	}

	public function load_notifications_unread() {
		$notifications = $this->user_model
			->get_notifications_unread($this->user->info->ID);
		$this->template->loadAjax("home/ajax_notifications.php", array(
			"notifications" => $notifications,
		), 0
		);
	}

	public function read_all_noti($hash) {
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error("Invalid Hash!");
		}

		$this->user_model->update_user_notifications($this->user->info->ID, array(
			"status" => 1,
		)
		);

		$this->user_model->update_user($this->user->info->ID, array(
			"noti_count" => 0,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_43"));
		redirect(site_url("home/notifications"));
	}

	public function load_notification($id) {
		$notification = $this->user_model
			->get_notification($id, $this->user->info->ID);
		if ($notification->num_rows() == 0) {
			$this->template->error("Invalid Notification!");
		}
		$noti = $notification->row();
		if (!$noti->status) {
			$this->user_model->update_notification($id, array(
				"status" => 1,
			)
			);
			$this->user_model->update_user($this->user->info->ID, array(
				"noti_count" => $this->user->info->noti_count - 1,
			)
			);
		}

		// redirect
		redirect(site_url($noti->url));
	}

	public function notifications() {
		$this->template->loadContent("home/notifications.php", array(
		)
		);
	}

	public function notification_read($id) {
		$notification = $this->user_model
			->get_notification($id, $this->user->info->ID);
		if ($notification->num_rows() == 0) {
			$this->template->error("Invalid Notification!");
		}
		$noti = $notification->row();
		if (!$noti->status) {
			$this->user_model->update_notification($id, array(
				"status" => 1,
			)
			);
			$this->user_model->update_user($this->user->info->ID, array(
				"noti_count" => $this->user->info->noti_count - 1,
			)
			);
		}
		redirect(site_url("home/notifications"));
	}

	public function notification_unread($id) {
		$notification = $this->user_model
			->get_notification($id, $this->user->info->ID);
		if ($notification->num_rows() == 0) {
			$this->template->error("Invalid Notification!");
		}
		$noti = $notification->row();
		if ($noti->status) {
			$this->user_model->update_notification($id, array(
				"status" => 0,
			)
			);
			$this->user_model->update_user($this->user->info->ID, array(
				"noti_count" => $this->user->info->noti_count + 1,
			)
			);
		}
		redirect(site_url("home/notifications"));
	}

	public function notifications_page() {
		$this->load->library("datatables");

		$this->datatables->set_default_order("user_notifications.timestamp", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				2 => array(
					"user_notifications.timestamp" => 0,
				),
			)
		);
		$this->datatables->set_total_rows(
			$this->user_model
				->get_notifications_all_total($this->user->info->ID)
		);
		$notifications = $this->user_model
			->get_notifications_all($this->user->info->ID, $this->datatables);

		foreach ($notifications->result() as $r) {
			$msg = '<a href="' . site_url("profile/" . $r->username) . '">' . $r->username . '</a> ' . $r->message;
			$options = '<a href="' . site_url("home/notification_unread/" . $r->ID) . '" class="btn btn-default btn-xs">Mark Unread</a>';
			if ($r->status != 1) {
				$msg .= ' <label class="label label-danger">Unread</label>';
				$options = '<a href="' . site_url("home/notification_read/" . $r->ID) . '" class="btn btn-info btn-xs">Mark Read</a>';
			}

			$this->datatables->data[] = array(
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				$msg,
				date($this->settings->info->date_format, $r->timestamp),
				$options . ' <a href="' . site_url("home/load_notification/" . $r->ID) . '" class="btn btn-primary btn-xs">View</a>',
			);
		}
		echo json_encode($this->datatables->process());
	}

}

?>