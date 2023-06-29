<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("admin_model");
		$this->load->model("user_model");

		if (!$this->user->loggedin) {
			$this->template->error(lang("error_1"));
		}

		if (!$this->common->has_permissions(array("admin", "admin_settings",
			"admin_members", "admin_payment"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
	}

	public function index() {
		$this->template->loadData("activeLink",
			array("admin" => array("general" => 1)));
		$this->template->loadContent("admin/index.php", array(
		)
		);

	}

	public function user_logs() {
		if (!$this->common->has_permissions(array("admin",
			"admin_members"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("user_logs" => 1)));
		$this->template->loadContent("admin/user_logs.php", array(
		)
		);
	}

	public function user_log_page() {
		$this->load->library("datatables");

		$this->datatables->set_default_order("user_logs.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				0 => array(
					"users.username" => 0,
				),
				2 => array(
					"user_logs.timestamp" => 0,
				),
			)
		);

		$this->datatables->set_total_rows(
			$this->admin_model
				->get_total_user_logs()
		);
		$logs = $this->admin_model->get_user_logs($this->datatables);

		foreach ($logs->result() as $r) {

			$this->datatables->data[] = array(
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp, "first_name" => $r->first_name, "last_name" => $r->last_name)),
				$r->message,
				date($this->settings->info->date_format, $r->timestamp),
				$r->IP . '<span class="glyphicon glyphicon-info-sign" title="' . $r->user_agent . '"></span>',
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function custom_fields() {
		if (!$this->common->has_permissions(array("admin",
			"admin_members"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("custom_fields" => 1)));
		$fields = $this->admin_model->get_custom_fields(array());
		$this->template->loadContent("admin/custom_fields.php", array(
			"fields" => $fields,
		)
		);

	}

	public function add_custom_field_pro() {
		if (!$this->common->has_permissions(array("admin",
			"admin_members"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$type = intval($this->input->post("type"));
		$options = $this->common->nohtml($this->input->post("options"));
		$required = intval($this->input->post("required"));
		$edit = intval($this->input->post("edit"));
		$profile = intval($this->input->post("profile"));
		$help_text = $this->common->nohtml($this->input->post("help_text"));
		$register = intval($this->input->post("register"));

		if (empty($name)) {
			$this->template->error(lang("error_75"));
		}

		if ($type < 0 || $type > 4) {
			$this->template->error(lang("error_76"));
		}

		// Add
		$this->admin_model->add_custom_field(array(
			"name" => $name,
			"type" => $type,
			"options" => $options,
			"required" => $required,
			"edit" => $edit,
			"profile" => $profile,
			"help_text" => $help_text,
			"register" => $register,
		)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_443"),
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_37"));
		redirect(site_url("admin/custom_fields"));
	}

	public function edit_custom_field($id) {
		if (!$this->common->has_permissions(array("admin",
			"admin_members"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("custom_fields" => 1)));
		$id = intval($id);
		$field = $this->admin_model->get_custom_field($id);
		if ($field->num_rows() == 0) {
			$this->template->error(lang("error_77"));
		}

		$field = $field->row();
		$this->template->loadContent("admin/edit_custom_field.php", array(
			"field" => $field,
		)
		);
	}

	public function edit_custom_field_pro($id) {
		if (!$this->common->has_permissions(array("admin",
			"admin_members"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$field = $this->admin_model->get_custom_field($id);
		if ($field->num_rows() == 0) {
			$this->template->error(lang("error_77"));
		}

		$field = $field->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$type = intval($this->input->post("type"));
		$options = $this->common->nohtml($this->input->post("options"));
		$required = intval($this->input->post("required"));
		$edit = intval($this->input->post("edit"));
		$profile = intval($this->input->post("profile"));
		$help_text = $this->common->nohtml($this->input->post("help_text"));
		$register = intval($this->input->post("register"));

		if (empty($name)) {
			$this->template->error(lang("error_75"));
		}

		if ($type < 0 || $type > 4) {
			$this->template->error(lang("error_76"));
		}

		// Add
		$this->admin_model->update_custom_field($id, array(
			"name" => $name,
			"type" => $type,
			"options" => $options,
			"required" => $required,
			"edit" => $edit,
			"profile" => $profile,
			"help_text" => $help_text,
			"register" => $register,
		)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_444"),
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_38"));
		redirect(site_url("admin/custom_fields"));
	}

	public function delete_custom_field($id, $hash) {
		if (!$this->common->has_permissions(array("admin",
			"admin_members"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$field = $this->admin_model->get_custom_field($id);
		if ($field->num_rows() == 0) {
			$this->template->error(lang("error_77"));
		}

		$this->admin_model->delete_custom_field($id);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_445"),
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_39"));
		redirect(site_url("admin/custom_fields"));
	}

	public function premium_users($page = 0) {
		if (!$this->common->has_permissions(array("admin",
			"admin_payment"), $this->user)) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("premium_users" => 1)));

		$this->template->loadContent("admin/premium_users.php", array(
		)
		);
	}

	public function premium_users_page() {
		$this->load->library("datatables");

		$this->datatables->set_default_order("users.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				3 => array(
					"payment_plans.name" => 0,
				),
				4 => array(
					"users.premium_time" => 0,
				),
			)
		);

		$this->datatables->set_total_rows(
			$this->admin_model
				->get_total_premium_users_count()
		);
		$users = $this->admin_model->get_premium_users($this->datatables);

		foreach ($users->result() as $r) {
			$time = $this->common->convert_time($r->premium_time);
			unset($time['mins']);
			unset($time['secs']);
			$this->datatables->data[] = array(
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				$r->first_name . " " . $r->last_name,
				$r->email,
				$r->name,
				$this->common->get_time_string($time),
				date($this->settings->info->date_format, $r->joined),
				'<a href="' . site_url("admin/edit_member/" . $r->ID) . '" class="btn btn-warning btn-xs" title="' . lang("ctn_55") . '"><i class="mdi mdi-settings"></i> </a> <a href="' . site_url("admin/delete_member/" . $r->ID . "/" . $this->security->get_csrf_hash()) . '" onclick="return confirm(\'' . lang("ctn_86") . '\')" class="btn btn-danger btn-xs" title="' . lang("ctn_57") . '"><i class="mdi mdi-delete-forever"></i> </a>',
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function user_roles() {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}

		$this->template->loadData("activeLink",
			array("admin" => array("user_roles" => 1)));
		$roles = $this->admin_model->get_user_roles();

		$permissions = $this->get_default_permissions();

		$this->template->loadContent("admin/user_roles.php", array(
			"roles" => $roles,
			"permissions" => $permissions,
		)
		);
	}

	public function add_user_role_pro() {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		if (empty($name)) {
			$this->template->error(lang("error_64"));
		}

		$permissions = $this->get_default_permissions();

		$user_roles = $this->input->post("user_roles");
		foreach ($user_roles as $ur) {
			$ur = intval($ur);
			foreach ($permissions as $key => $p) {
				if ($p['id'] == $ur) {
					$permissions[$key]['selected'] = 1;
				}
			}
		}

		$data = array();
		foreach ($permissions as $k => $v) {
			$data[$k] = $v['selected'];
		}
		$data['name'] = $name;

		$this->admin_model->add_user_role(
			$data
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_446") . $name,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_30"));
		redirect(site_url("admin/user_roles"));
	}

	public function edit_user_role($id) {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}

		$id = intval($id);
		$role = $this->admin_model->get_user_role($id);
		if ($role->num_rows() == 0) {
			$this->template->error(lang("error_65"));
		}

		$role = $role->row();
		$this->template->loadData("activeLink",
			array("admin" => array("user_roles" => 1)));

		$permissions = $this->get_default_permissions();
		foreach ($permissions as $k => $v) {
			if ($role->{$k}) {
				$permissions[$k]['selected'] = 1;
			}
		}

		$this->template->loadContent("admin/edit_user_role.php", array(
			"role" => $role,
			"permissions" => $permissions,
		)
		);
	}

	private function get_default_permissions() {
		$urp = $this->admin_model->get_user_role_permissions();
		$permissions = array();
		foreach ($urp->result() as $r) {
			$permissions[$r->hook] = array(
				"name" => lang($r->name),
				"desc" => lang($r->description),
				"id" => $r->ID,
				"class" => $r->classname,
				"selected" => 0,
			);
		}
		return $permissions;
	}

	public function edit_user_role_pro($id) {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}

		$id = intval($id);
		$role = $this->admin_model->get_user_role($id);
		if ($role->num_rows() == 0) {
			$this->template->error(lang("error_65"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		if (empty($name)) {
			$this->template->error(lang("error_64"));
		}

		$permissions = $this->get_default_permissions();

		$user_roles = $this->input->post("user_roles");
		foreach ($user_roles as $ur) {
			$ur = intval($ur);
			foreach ($permissions as $key => $p) {
				if ($p['id'] == $ur) {
					$permissions[$key]['selected'] = 1;
				}
			}
		}

		$data = array();
		foreach ($permissions as $k => $v) {
			$data[$k] = $v['selected'];
		}
		$data['name'] = $name;

		$this->admin_model->update_user_role($id,
			$data
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_447") . $name,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_31"));
		redirect(site_url("admin/user_roles"));
	}

	public function delete_user_role($id, $hash) {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}

		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$group = $this->admin_model->get_user_role($id);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_65"));
		}

		$group = $group->row();

		$this->admin_model->delete_user_role($id);
		// Delete all user groups from member

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_448") . $group->name,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_32"));
		redirect(site_url("admin/user_roles"));
	}

	public function payment_logs($page = 0) {
		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}

		$page = intval($page);
		$this->template->loadData("activeLink",
			array("admin" => array("payment_logs" => 1)));

		$this->template->loadContent("admin/payment_logs.php", array(
		)
		);
	}

	public function payment_logs_page() {
		$this->load->library("datatables");

		$this->datatables->set_default_order("users.joined", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				2 => array(
					"payment_logs.amount" => 0,
				),
				3 => array(
					"payment_logs.timestamp" => 0,
				),
				4 => array(
					"payment_logs.processor" => 0,
				),
			)
		);

		$this->datatables->set_total_rows(
			$this->admin_model
				->get_total_payment_logs_count()
		);
		$logs = $this->admin_model->get_payment_logs($this->datatables);

		foreach ($logs->result() as $r) {
			$this->datatables->data[] = array(
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				$r->email,
				number_format($r->amount, 2),
				date($this->settings->info->date_format, $r->timestamp),
				$r->processor,
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function payment_plans() {

		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("payment_plans" => 1)));
		$plans = $this->admin_model->get_payment_plans();

		$this->template->loadContent("admin/payment_plans.php", array(
			"plans" => $plans,
		)
		);
	}

	public function add_payment_plan() {
		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->common->nohtml($this->input->post("description"));
		$cost = abs($this->input->post("cost"));
		$color = $this->common->nohtml($this->input->post("color"));
		$fontcolor = $this->common->nohtml($this->input->post("fontcolor"));
		$days = intval($this->input->post("days"));
		$icon = $this->common->nohtml($this->input->post("icon"));

		$this->admin_model->add_payment_plan(array(
			"name" => $name,
			"cost" => $cost,
			"hexcolor" => $color,
			"days" => $days,
			"description" => $desc,
			"fontcolor" => $fontcolor,
			"icon" => $icon,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_25"));

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_449") . $name,
		)
		);
		redirect(site_url("admin/payment_plans"));
	}

	public function edit_payment_plan($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadExternal(
			'<script src="' . base_url() . 'scripts/libraries/jscolor.min.js"></script>'
		);
		$this->template->loadData("activeLink",
			array("admin" => array("payment_plans" => 1)));
		$id = intval($id);
		$plan = $this->admin_model->get_payment_plan($id);
		if ($plan->num_rows() == 0) {
			$this->template->error(lang("error_61"));
		}

		$this->template->loadContent("admin/edit_payment_plan.php", array(
			"plan" => $plan->row(),
		)
		);
	}

	public function edit_payment_plan_pro($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$plan = $this->admin_model->get_payment_plan($id);
		if ($plan->num_rows() == 0) {
			$this->template->error(lang("error_61"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->common->nohtml($this->input->post("description"));
		$cost = abs($this->input->post("cost"));
		$color = $this->common->nohtml($this->input->post("color"));
		$fontcolor = $this->common->nohtml($this->input->post("fontcolor"));
		$days = intval($this->input->post("days"));
		$icon = $this->common->nohtml($this->input->post("icon"));

		$this->admin_model->update_payment_plan($id, array(
			"name" => $name,
			"cost" => $cost,
			"hexcolor" => $color,
			"days" => $days,
			"description" => $desc,
			"fontcolor" => $fontcolor,
			"icon" => $icon,
		)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_450") . $name,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_26"));
		redirect(site_url("admin/payment_plans"));
	}

	public function delete_payment_plan($id, $hash) {
		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}

		$id = intval($id);
		$plan = $this->admin_model->get_payment_plan($id);
		if ($plan->num_rows() == 0) {
			$this->template->error(lang("error_61"));
		}

		$plan = $plan->row();

		$this->admin_model->delete_payment_plan($id);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_451") . $plan->name,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_27"));
		redirect(site_url("admin/payment_plans"));
	}

	public function payment_settings() {
		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("payment_settings" => 1)));
		$this->template->loadContent("admin/payment_settings.php", array(
		)
		);
	}

	public function payment_settings_pro() {
		if (!$this->user->info->admin && !$this->user->info->admin_payment) {
			$this->template->error(lang("error_2"));
		}
		$paypal_email = $this->common->nohtml(
			$this->input->post("paypal_email"));
		$paypal_currency = $this->common->nohtml(
			$this->input->post("paypal_currency"));
		$payment_enabled = intval($this->input->post("payment_enabled"));
		$payment_symbol = $this->common->nohtml(
			$this->input->post("payment_symbol"));
		$global_premium = intval($this->input->post("global_premium"));

		$stripe_secret_key = $this->common->nohtml($this->input->post("stripe_secret_key"));
		$stripe_publish_key = $this->common->nohtml($this->input->post("stripe_publish_key"));
		$checkout2_secret = $this->common->nohtml($this->input->post("checkout2_secret"));
		$checkout2_accountno = $this->common->nohtml($this->input->post("checkout2_accountno"));

		// update
		$this->admin_model->updateSettings(
			array(
				"paypal_email" => $paypal_email,
				"paypal_currency" => $paypal_currency,
				"payment_enabled" => $payment_enabled,
				"payment_symbol" => $payment_symbol,
				"global_premium" => $global_premium,
				"stripe_secret_key" => $stripe_secret_key,
				"stripe_publish_key" => $stripe_publish_key,
				"checkout2_secret" => $checkout2_secret,
				"checkout2_accountno" => $checkout2_accountno,
			)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_452"),
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_24"));
		redirect(site_url("admin/payment_settings"));

	}

	public function email_members() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("email_members" => 1)));
		$groups = $this->admin_model->get_user_groups();
		$this->template->loadContent("admin/email_members.php", array(
			"groups" => $groups,
		)
		);
	}

	public function email_members_pro() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$usernames = $this->common->nohtml($this->input->post("usernames"));
		$groupid = intval($this->input->post("groupid"));
		$title = $this->common->nohtml($this->input->post("title"));
		$message = $this->lib_filter->go($this->input->post("message"));

		if ($groupid == -1) {
			// All members
			$users = array();
			$usersc = $this->admin_model->get_all_users();
			foreach ($usersc->result() as $r) {
				$users[] = $r;
			}
		} else {
			$usernames = explode(",", $usernames);

			$users = array();
			foreach ($usernames as $username) {
				if (empty($username)) {
					continue;
				}

				$user = $this->user_model->get_user_by_username($username);
				if ($user->num_rows() == 0) {
					$this->template->error(lang("error_3") . $username);
				}
				$users[] = $user->row();
			}

			if ($groupid > 0) {
				$group = $this->admin_model->get_user_group($groupid);
				if ($group->num_rows() == 0) {
					$this->template->error(lang("error_4"));
				}

				$users_g = $this->admin_model->get_all_group_users($groupid);
				$cusers = $users;

				foreach ($users_g->result() as $r) {
					// Check for duplicates
					$skip = false;
					foreach ($cusers as $a) {
						if ($a->userid == $r->userid) {
							$skip = true;
						}

					}
					if (!$skip) {
						$users[] = $r;
					}
				}
			}

		}

		foreach ($users as $r) {
			$this->common->send_email($title, $message, $r->email);
		}

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_453"),
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_1"));
		redirect(site_url("admin/email_members"));
	}

	public function user_groups() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("user_groups" => 1)));
		$groups = $this->admin_model->get_user_groups();
		$this->template->loadContent("admin/groups.php", array(
			"groups" => $groups,
		)
		);
	}

	public function add_group_pro() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$default = intval($this->input->post("default_group"));
		if (empty($name)) {
			$this->template->error(lang("error_5"));
		}

		$this->admin_model->add_group(
			array(
				"name" => $name,
				"default" => $default,
			)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_454") . $name,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_2"));
		redirect(site_url("admin/user_groups"));
	}

	public function edit_group($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->admin_model->get_user_group($id);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_4"));
		}

		$this->template->loadData("activeLink",
			array("admin" => array("user_groups" => 1)));

		$this->template->loadContent("admin/edit_group.php", array(
			"group" => $group->row(),
		)
		);
	}

	public function edit_group_pro($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->admin_model->get_user_group($id);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_4"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$default = intval($this->input->post("default_group"));
		if (empty($name)) {
			$this->template->error(lang("error_5"));
		}

		$this->admin_model->update_group($id,
			array(
				"name" => $name,
				"default" => $default,
			)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_455") . $name,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_3"));
		redirect(site_url("admin/user_groups"));
	}

	public function delete_group($id, $hash) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$group = $this->admin_model->get_user_group($id);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_4"));
		}

		$group = $group->row();

		$this->admin_model->delete_group($id);
		// Delete all user groups from member
		$this->admin_model->delete_users_from_group($id);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_456") . $grouo->name,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_4"));
		redirect(site_url("admin/user_groups"));
	}

	public function view_group($id, $page = 0) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("user_groups" => 1)));
		$id = intval($id);
		$page = intval($page);
		$group = $this->admin_model->get_user_group($id);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_4"));
		}

		$users = $this->admin_model->get_users_from_groups($id, $page);

		$this->load->library('pagination');
		$config['base_url'] = site_url("admin/view_group/" . $id);
		$config['total_rows'] = $this->admin_model
			->get_total_user_group_members_count($id);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;

		include APPPATH . "/config/page_config.php";

		$this->pagination->initialize($config);

		$this->template->loadContent("admin/view_group.php", array(
			"group" => $group->row(),
			"users" => $users,
			"total_members" => $config['total_rows'],
		)
		);

	}

	public function add_user_to_group_pro($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->admin_model->get_user_group($id);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_4"));
		}

		$group = $group->row();

		$usernames = $this->common->nohtml($this->input->post("usernames"));
		$usernames = explode(",", $usernames);

		$users = array();
		foreach ($usernames as $username) {
			$user = $this->user_model->get_user_by_username($username);
			if ($user->num_rows() == 0) {
				$this->template->error(lang("error_3")
					. $username);
			}

			$users[] = $user->row();
		}

		foreach ($users as $user) {
			// Check not already a member
			$userc = $this->admin_model->get_user_from_group($user->ID, $id);
			if ($userc->num_rows() == 0) {
				$this->admin_model->add_user_to_group($user->ID, $id);
			}
		}

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_457") . $group->name . " " . lang("ctn_458") . $usernames,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_5"));
		redirect(site_url("admin/view_group/" . $id));
	}

	public function remove_user_from_group($userid, $id, $hash) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$userid = intval($userid);
		$group = $this->admin_model->get_user_group($id);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_4"));
		}

		$group = $group->row();

		$user = $this->admin_model->get_user_from_group($userid, $id);
		if ($user->num_rows() == 0) {
			$this->template->error(lang("error_7"));
		}

		$user = $user->row();

		$this->admin_model->delete_user_from_group($userid, $id);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_459") . $user->username . " " . lang("ctn_460") . $group->name,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_6"));
		redirect(site_url("admin/view_group/" . $id));
	}

	public function email_templates() {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("email_templates" => 1)));

		$languages = $this->config->item("available_languages");

		$this->template->loadContent("admin/email_templates.php", array(
			"languages" => $languages,
		)
		);
	}

	public function email_template_page() {
		$this->load->library("datatables");

		$this->datatables->set_default_order("email_templates.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				0 => array(
					"email_templates.title" => 0,
				),
				1 => array(
					"email_templates.hook" => 0,
				),
				2 => array(
					"email_templates.language" => 0,
				),
			)
		);

		$this->datatables->set_total_rows(
			$this->admin_model
				->get_total_email_templates()
		);
		$templates = $this->admin_model->get_email_templates($this->datatables);

		foreach ($templates->result() as $r) {

			$this->datatables->data[] = array(
				$r->title,
				$r->hook,
				$r->language,
				'<a href="' . site_url("admin/edit_email_template/" . $r->ID) . '" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . lang("ctn_55") . '"><span class="glyphicon glyphicon-cog"></span></a> <a href="' . site_url("admin/delete_email_template/" . $r->ID . "/" . $this->security->get_csrf_hash()) . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . lang("ctn_317") . '\')" data-toggle="tooltip" data-placement="bottom" title="' . lang("ctn_57") . '"><span class="glyphicon glyphicon-trash"></span></a>',
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function add_email_template() {
		$title = $this->common->nohtml($this->input->post("title"));
		$template = $this->lib_filter->go($this->input->post("template"));
		$hook = $this->common->nohtml($this->input->post("hook"));
		$language = $this->common->nohtml($this->input->post("language"));

		$this->admin_model->add_email_template(array(
			"title" => $title,
			"message" => $template,
			"hook" => $hook,
			"language" => $language,
		)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_461"),
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_41"));
		redirect(site_url("admin/email_templates"));
	}

	public function edit_email_template($id) {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("email_templates" => 1)));
		$id = intval($id);

		$email_template = $this->admin_model->get_email_template($id);
		if ($email_template->num_rows() == 0) {
			$this->template->error(lang("error_8"));
		}

		$languages = $this->config->item("available_languages");

		$this->template->loadContent("admin/edit_email_template.php", array(
			"email_template" => $email_template->row(),
			"languages" => $languages,
		)
		);
	}

	public function edit_email_template_pro($id) {
		if (!$this->user->info->admin) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("email_templates" => 1)));
		$id = intval($id);
		$email_template = $this->admin_model->get_email_template($id);
		if ($email_template->num_rows() == 0) {
			$this->template->error(lang("error_8"));
		}

		$title = $this->common->nohtml($this->input->post("title"));
		$template = $this->lib_filter->go($this->input->post("template"));
		$hook = $this->common->nohtml($this->input->post("hook"));
		$language = $this->common->nohtml($this->input->post("language"));

		$this->admin_model->update_email_template($id, array(
			"title" => $title,
			"message" => $template,
			"hook" => $hook,
			"language" => $language,
		)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_462"),
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_7"));
		redirect(site_url("admin/email_templates"));
	}

	public function delete_email_template($id, $hash) {
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);

		$email_template = $this->admin_model->get_email_template($id);
		if ($email_template->num_rows() == 0) {
			$this->template->error(lang("error_8"));
		}

		$this->admin_model->delete_email_template($id);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_463"),
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_42"));
		redirect(site_url("admin/email_templates"));
	}

	public function ipblock() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("ipblock" => 1)));

		$ipblock = $this->admin_model->get_ip_blocks();

		$this->template->loadContent("admin/ipblock.php", array(
			"ipblock" => $ipblock,
		)
		);
	}

	public function add_ipblock() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$ip = $this->common->nohtml($this->input->post("ip"));
		$reason = $this->common->nohtml($this->input->post("reason"));

		if (empty($ip)) {
			$this->template->error(lang("error_10"));
		}

		$this->admin_model->add_ipblock($ip, $reason);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_464") . $ip,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_8"));
		redirect(site_url("admin/ipblock"));
	}

	public function delete_ipblock($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$ipblock = $this->admin_model->get_ip_block($id);
		if ($ipblock->num_rows() == 0) {
			$this->template->error(lang("error_11"));
		}

		$ipblock = $ipblock->row();

		$this->admin_model->delete_ipblock($id);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_465") . $ipblock->IP,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_9"));
		redirect(site_url("admin/ipblock"));
	}

	public function members() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("members" => 1)));

		$user_roles = $this->admin_model->get_user_roles();

		$fields = $this->user_model->get_custom_fields(array("register" => 1));

		$this->template->loadContent("admin/members.php", array(
			"user_roles" => $user_roles,
			"fields" => $fields,
		)
		);
	}

	public function members_page() {
		$this->load->library("datatables");

		$this->datatables->set_default_order("users.joined", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				0 => array(
					"users.username" => 0,
				),
				1 => array(
					"users.first_name" => 0,
				),
				2 => array(
					"users.last_name" => 0,
				),
				3 => array(
					"users.email" => 0,
				),
				4 => array(
					"user_roles.name" => 0,
				),
				5 => array(
					"users.joined" => 0,
				),
				6 => array(
					"users.oauth_provider" => 0,
				),
			)
		);

		$this->datatables->set_total_rows(
			$this->user_model
				->get_total_members_count()
		);
		$members = $this->user_model->get_members_admin($this->datatables);

		foreach ($members->result() as $r) {
			if ($r->oauth_provider == "google") {
				$provider = "Google";
			} elseif ($r->oauth_provider == "twitter") {
				$provider = "Twitter";
			} elseif ($r->oauth_provider == "facebook") {
				$provider = "Facebook";
			} else {
				$provider = lang("ctn_196");
			}
			$this->datatables->data[] = array(
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp, "first_name" => $r->first_name, "last_name" => $r->last_name)),
				$r->first_name,
				$r->last_name,
				$r->email,
				$this->common->get_user_role($r),
				date($this->settings->info->date_format, $r->joined),
				$provider,
				'<a href="' . site_url("admin/edit_member/" . $r->ID) . '" class="btn btn-warning btn-xs" title="' . lang("ctn_55") . '" data-toggle="tooltip" data-placement="bottom"><i class="mdi mdi-settings"></i></a> <a href="' . site_url("admin/delete_member/" . $r->ID . "/" . $this->security->get_csrf_hash()) . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . lang("ctn_317") . '\')" title="' . lang("ctn_57") . '" data-toggle="tooltip" data-placement="bottom"><i class="mdi mdi-delete-forever
"></i></a>',
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function member_user_groups($id) {
		if (!$this->common->has_permissions(array("admin", "admin_members"),
			$this->user)) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("members" => 1)));
		$id = intval($id);

		$member = $this->user_model->get_user_by_id($id);
		if ($member->num_rows() == 0) {
			$this->template->error(lang("error_13"));
		}

		$member = $member->row();

		// Groups
		$user_groups = $this->user_model->get_user_groups($id);
		$groups = $this->admin_model->get_user_groups();

		$this->template->loadContent("admin/member_user_groups.php", array(
			"member" => $member,
			"user_groups" => $user_groups,
			"groups" => $groups,
		)
		);
	}

	public function add_member_to_group_pro($id) {
		if (!$this->common->has_permissions(array("admin", "admin_members"),
			$this->user)) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);

		$member = $this->user_model->get_user_by_id($id);
		if ($member->num_rows() == 0) {
			$this->template->error(lang("error_13"));
		}

		$member = $member->row();

		$groupid = intval($this->input->post("groupid"));

		$group = $this->admin_model->get_user_group($groupid);
		if ($group->num_rows() == 0) {
			$this->template->error(lang("error_4"));
		}

		$userc = $this->admin_model->get_user_from_group($id, $groupid);
		if ($userc->num_rows() > 0) {
			$this->template->error("This user is already a member of this group!");
		}

		$this->admin_model->add_user_to_group($member->ID, $groupid);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_457") . $group->name . lang("ctn_458") . " " . $member->username,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_5"));
		redirect(site_url("admin/member_user_groups/" . $id));

	}

	public function edit_member($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("members" => 1)));
		$id = intval($id);

		$member = $this->user_model->get_user_by_id($id);
		if ($member->num_rows() == 0) {
			$this->template->error(lang("error_13"));
		}

		$user_groups = $this->user_model->get_user_groups($id);
		$user_roles = $this->admin_model->get_user_roles();
		$fields = $this->user_model->get_custom_fields_answers(array(
		), $id);

		$this->template->loadContent("admin/edit_member.php", array(
			"member" => $member->row(),
			"user_groups" => $user_groups,
			"user_roles" => $user_roles,
			"fields" => $fields,
		)
		);
	}

	public function edit_member_pro($id) {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$fields = $this->user_model->get_custom_fields_answers(array(
		), $id);

		$member = $this->user_model->get_user_by_id($id);
		if ($member->num_rows() == 0) {
			$this->template->error(lang("error_13"));
		}

		$member = $member->row();

		$this->load->model("register_model");
		$email = $this->input->post("email", true);
		$first_name = $this->common->nohtml(
			$this->input->post("first_name", true));
		$last_name = $this->common->nohtml(
			$this->input->post("last_name", true));
		$pass = $this->common->nohtml(
			$this->input->post("password", true));
		$username = $this->common->nohtml(
			$this->input->post("username", true));
		$user_role = intval($this->input->post("user_role"));
		$aboutme = $this->common->nohtml($this->input->post("aboutme"));
		$points = abs($this->input->post("credits"));
		$active = intval($this->input->post("active"));

		$address_1 = $this->common->nohtml($this->input->post("address_1"));
		$address_2 = $this->common->nohtml($this->input->post("address_2"));
		$city = $this->common->nohtml($this->input->post("city"));
		$state = $this->common->nohtml($this->input->post("state"));
		$zipcode = $this->common->nohtml($this->input->post("zipcode"));
		$country = $this->common->nohtml($this->input->post("country"));

		if (strlen($username) < 3) {
			$this->template->error(lang("error_14"));
		}

		if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
			$this->template->error(lang("error_15"));
		}

		if ($username != $member->username) {
			if (!$this->register_model->check_username_is_free($username)) {
				$this->template->error(lang("error_16"));
			}
		}

		if (!empty($pass)) {
			if (strlen($pass) <= 5) {
				$this->template->error(lang("error_17"));
			}
			$pass = $this->common->encrypt($pass);
		} else {
			$pass = $member->password;
		}

		$this->load->helper('email');
		$this->load->library('upload');

		if (empty($email)) {
			$this->template->error(lang("error_18"));
		}

		if (!valid_email($email)) {
			$this->template->error(lang("error_19"));
		}

		if ($email != $member->email) {
			if (!$this->register_model->checkEmailIsFree($email)) {
				$this->template->error(lang("error_20"));
			}
		}

		if ($user_role != $member->user_role) {
			if (!$this->user->info->admin) {
				$this->template->error(lang("error_66"));
			}
		}
		if ($user_role > 0) {
			$role = $this->admin_model->get_user_role($user_role);
			if ($role->num_rows() == 0) {
				$this->template->error(lang("error_65"));
			}

		}

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
				"upload_path" => $this->settings->info->upload_path,
				"overwrite" => FALSE,
				"max_filename" => 300,
				"encrypt_name" => TRUE,
				"remove_spaces" => TRUE,
				"allowed_types" => "gif|jpg|png|jpeg|",
				"max_size" => 1000,
				"max_width" => $this->settings->info->avatar_width,
				"max_height" => $this->settings->info->avatar_height,
			));

			if (!$this->upload->do_upload()) {
				$this->template->error(lang("error_21")
					. $this->upload->display_errors());
			}

			$data = $this->upload->data();

			$image = $data['file_name'];
		} else {
			$image = $member->avatar;
		}

		// Custom Fields
		// Process fields
		$answers = array();
		foreach ($fields->result() as $r) {
			$answer = "";
			if ($r->type == 0) {
				// Look for simple text entry
				$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

				if ($r->required && empty($answer)) {
					$this->template->error(lang("error_78") . $r->name);
				}
				// Add
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer,
				);
			} elseif ($r->type == 1) {
				// HTML
				$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

				if ($r->required && empty($answer)) {
					$this->template->error(lang("error_78") . $r->name);
				}
				// Add
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer,
				);
			} elseif ($r->type == 2) {
				// Checkbox
				$options = explode(",", $r->options);
				foreach ($options as $k => $v) {
					// Look for checked checkbox and add it to the answer if it's value is 1
					$ans = $this->common->nohtml($this->input->post("cf_cb_" . $r->ID . "_" . $k));
					if ($ans) {
						if (empty($answer)) {
							$answer .= $v;
						} else {
							$answer .= ", " . $v;
						}
					}
				}

				if ($r->required && empty($answer)) {
					$this->template->error(lang("error_78") . $r->name);
				}
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer,
				);

			} elseif ($r->type == 3) {
				// radio
				$options = explode(",", $r->options);
				if (isset($_POST['cf_radio_' . $r->ID])) {
					$answer = intval($this->common->nohtml($this->input->post("cf_radio_" . $r->ID)));

					$flag = false;
					foreach ($options as $k => $v) {
						if ($k == $answer) {
							$flag = true;
							$answer = $v;
						}
					}
					if ($r->required && !$flag) {
						$this->template->error(lang("error_78") . $r->name);
					}
					if ($flag) {
						$answers[] = array(
							"fieldid" => $r->ID,
							"answer" => $answer,
						);
					}
				}

			} elseif ($r->type == 4) {
				// Dropdown menu
				$options = explode(",", $r->options);
				$answer = intval($this->common->nohtml($this->input->post("cf_" . $r->ID)));
				$flag = false;
				foreach ($options as $k => $v) {
					if ($k == $answer) {
						$flag = true;
						$answer = $v;
					}
				}
				if ($r->required && !$flag) {
					$this->template->error(lang("error_78") . $r->name);
				}
				if ($flag) {
					$answers[] = array(
						"fieldid" => $r->ID,
						"answer" => $answer,
					);
				}
			}
		}

		$this->user_model->update_user($id,
			array(
				"username" => $username,
				"email" => $email,
				"first_name" => $first_name,
				"last_name" => $last_name,
				"password" => $pass,
				"user_role" => $user_role,
				"avatar" => $image,
				"aboutme" => $aboutme,
				"points" => $points,
				"active" => $active,
				"address_1" => $address_1,
				"address_2" => $address_2,
				"city" => $city,
				"state" => $state,
				"zipcode" => $zipcode,
				"country" => $country,
			)
		);

		#trabajando
		/*********************************************************************/
		/*********************************************************************/
		$this->load->model("sedes_model");
		$this->sedes_model->set_relation($id, $this->input->post('sedes'));
		/*********************************************************************/
		/*********************************************************************/

		// Update CF
		// Add Custom Fields data
		foreach ($answers as $answer) {
			// Check if field exists
			$field = $this->user_model->get_user_cf($answer['fieldid'], $id);
			if ($field->num_rows() == 0) {
				$this->user_model->add_custom_field(array(
					"userid" => $id,
					"fieldid" => $answer['fieldid'],
					"value" => $answer['answer'],
				)
				);
			} else {
				$this->user_model->update_custom_field($answer['fieldid'],
					$id, $answer['answer']);
			}
		}

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_466") . $username,
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_10"));
		redirect(site_url("admin/members"));
	}

	public function add_member_pro() {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->load->model("register_model");
		$email = $this->input->post("email", true);
		$first_name = $this->common->nohtml(
			$this->input->post("first_name", true));
		$last_name = $this->common->nohtml(
			$this->input->post("last_name", true));
		$pass = $this->common->nohtml(
			$this->input->post("password", true));
		$pass2 = $this->common->nohtml(
			$this->input->post("password2", true));
		$captcha = $this->input->post("captcha", true);
		$username = $this->common->nohtml(
			$this->input->post("username", true));
		$user_role = intval($this->input->post("user_role"));

		if ($user_role > 0) {
			$role = $this->admin_model->get_user_role($user_role);
			if ($role->num_rows() == 0) {
				$this->template->error(lang("error_65"));
			}

			$role = $role->row();
			if ($role->admin || $role->admin_members || $role->admin_settings
				|| $role->admin_payment) {
				if (!$this->user->info->admin) {
					$this->template->error(lang("error_67"));
				}
			}
		}

		if (strlen($username) < 3) {
			$this->template->error(lang("error_14"));
		}

		if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
			$this->template->error(lang("error_15"));
		}

		if (!$this->register_model->check_username_is_free($username)) {
			$this->template->error(lang("error_16"));
		}

		if ($pass != $pass2) {
			$this->template->error(lang("error_22"));
		}

		if (strlen($pass) <= 5) {
			$this->template->error(lang("error_17"));
		}

		$this->load->helper('email');

		if (empty($email)) {
			$this->template->error(lang("error_18"));
		}

		if (!valid_email($email)) {
			$this->template->error(lang("error_19"));
		}

		if (!$this->register_model->checkEmailIsFree($email)) {
			$this->template->error(lang("error_20"));
		}

		$fields = $this->user_model->get_custom_fields_answers(array(
		), 0);
		// Custom Fields
		// Process fields
		$answers = array();
		foreach ($fields->result() as $r) {
			$answer = "";
			if ($r->type == 0) {
				// Look for simple text entry
				$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

				if ($r->required && empty($answer)) {
					$fail = lang("error_158") . $r->name;
				}
				// Add
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer,
				);
			} elseif ($r->type == 1) {
				// HTML
				$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

				if ($r->required && empty($answer)) {
					$fail = lang("error_158") . $r->name;
				}
				// Add
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer,
				);
			} elseif ($r->type == 2) {
				// Checkbox
				$options = explode(",", $r->options);
				foreach ($options as $k => $v) {
					// Look for checked checkbox and add it to the answer if it's value is 1
					$ans = $this->common->nohtml($this->input->post("cf_cb_" . $r->ID . "_" . $k));
					if ($ans) {
						if (empty($answer)) {
							$answer .= $v;
						} else {
							$answer .= ", " . $v;
						}
					}
				}

				if ($r->required && empty($answer)) {
					$fail = lang("error_158") . $r->name;
				}
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer,
				);

			} elseif ($r->type == 3) {
				// radio
				$options = explode(",", $r->options);
				if (isset($_POST['cf_radio_' . $r->ID])) {
					$answer = intval($this->common->nohtml($this->input->post("cf_radio_" . $r->ID)));

					$flag = false;
					foreach ($options as $k => $v) {
						if ($k == $answer) {
							$flag = true;
							$answer = $v;
						}
					}
					if ($r->required && !$flag) {
						$fail = lang("error_158") . $r->name;
					}
					if ($flag) {
						$answers[] = array(
							"fieldid" => $r->ID,
							"answer" => $answer,
						);
					}
				}

			} elseif ($r->type == 4) {
				// Dropdown menu
				$options = explode(",", $r->options);
				$answer = intval($this->common->nohtml($this->input->post("cf_" . $r->ID)));
				$flag = false;
				foreach ($options as $k => $v) {
					if ($k == $answer) {
						$flag = true;
						$answer = $v;
					}
				}
				if ($r->required && !$flag) {
					$fail = lang("error_158") . $r->name;
				}
				if ($flag) {
					$answers[] = array(
						"fieldid" => $r->ID,
						"answer" => $answer,
					);
				}
			}
		}

		if (!empty($fail)) {
			$this->template->error($fail);
		}

		$pass = $this->common->encrypt($pass);
		$new_users_id = $this->register_model->add_user(array(
			"username" => $username,
			"email" => $email,
			"first_name" => $first_name,
			"last_name" => $last_name,
			"password" => $pass,
			"user_role" => $user_role,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"joined" => time(),
			"joined_date" => date("n-Y"),
			"active" => 1,
		)
		);

		#trabajando
		/*********************************************************************/
		/*********************************************************************/
		$this->load->model("sedes_model");
		$this->sedes_model->set_relation($new_users_id, $this->input->post('sedes'));
		/*********************************************************************/
		/*********************************************************************/

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_467") . $username,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_11"));
		redirect(site_url("admin/members"));

	}

	public function delete_member($id, $hash='') {
		if (!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		/*if ($hash != $this->security->get_csrf_hash()) {
			//$this->template->error(lang("error_6"));
		}*/
		$id = intval($id);
		$member = $this->user_model->get_user_by_id($id);
		if ($member->num_rows() == 0) {
			$this->template->error(lang("error_13"));
		}

		$member = $member->row();

		$this->user_model->delete_user($id);
		$this->user_model->delete_user_from_groups($id);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_468") . $member->username,
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_12"));
		redirect(site_url("admin/members"));
	}

	public function social_settings() {
		if (!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("social_settings" => 1)));
		$this->template->loadContent("admin/social_settings.php", array(
		)
		);
	}

	public function social_settings_pro() {
		if (!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$disable_social_login =
			intval($this->input->post("disable_social_login"));
		$twitter_consumer_key =
		$this->common->nohtml($this->input->post("twitter_consumer_key"));
		$twitter_consumer_secret =
		$this->common->nohtml($this->input->post("twitter_consumer_secret"));
		$facebook_app_id =
		$this->common->nohtml($this->input->post("facebook_app_id"));
		$facebook_app_secret =
		$this->common->nohtml($this->input->post("facebook_app_secret"));
		$google_client_id =
		$this->common->nohtml($this->input->post("google_client_id"));
		$google_client_secret =
		$this->common->nohtml($this->input->post("google_client_secret"));

		$this->admin_model->updateSettings(
			array(
				"disable_social_login" => $disable_social_login,
				"twitter_consumer_key" => $twitter_consumer_key,
				"twitter_consumer_secret" => $twitter_consumer_secret,
				"facebook_app_id" => $facebook_app_id,
				"facebook_app_secret" => $facebook_app_secret,
				"google_client_id" => $google_client_id,
				"google_client_secret" => $google_client_secret,
			)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_469"),
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_13"));
		redirect(site_url("admin/social_settings"));
	}

	public function settings() {
		if (!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink",
			array("admin" => array("settings" => 1)));
		$roles = $this->admin_model->get_user_roles();
		$layouts = $this->admin_model->get_layouts();
		$this->template->loadContent("admin/settings.php", array(
			"roles" => $roles,
			"layouts" => $layouts,
		)
		);
	}

	public function settings_pro() {
		if (!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$site_name = $this->common->nohtml($this->input->post("site_name"));
		$site_desc = $this->common->nohtml($this->input->post("site_desc"));
		$site_email = $this->common->nohtml($this->input->post("site_email"));
		$upload_path = $this->common->nohtml($this->input->post("upload_path"));
		$file_types = $this->common
			->nohtml($this->input->post("file_types"));
		$file_size = intval($this->input->post("file_size"));
		$upload_path_rel =
		$this->common->nohtml($this->input->post("upload_path_relative"));
		$register = intval($this->input->post("register"));
		$avatar_upload = intval($this->input->post("avatar_upload"));
		$disable_captcha = intval($this->input->post("disable_captcha"));
		$date_format = $this->common->nohtml($this->input->post("date_format"));
		$login_protect = intval($this->input->post("login_protect"));
		$activate_account = intval($this->input->post("activate_account"));
		$default_user_role = intval($this->input->post("default_user_role"));
		$secure_login = intval($this->input->post("secure_login"));

		$google_recaptcha = intval($this->input->post("google_recaptcha"));
		$google_recaptcha_secret = $this->common->nohtml($this->input->post("google_recaptcha_secret"));
		$google_recaptcha_key = $this->common->nohtml($this->input->post("google_recaptcha_key"));

		$logo_option = intval($this->input->post("logo_option"));

		$profile_comments = intval($this->input->post("profile_comments"));
		$avatar_width = intval($this->input->post("avatar_width"));
		$avatar_height = intval($this->input->post("avatar_height"));
		$resize_avatar = intval($this->input->post("resize_avatar"));
		$cache_time = intval($this->input->post("cache_time"));

		$layoutid = intval($this->input->post("layoutid"));
		$layout = $this->admin_model->get_layout($layoutid);
		if ($layout->num_rows() == 0) {
			$this->template->error("Invalid Layout");
		}
		$layout = $layout->row();

		// Validate
		if (empty($site_name) || empty($site_email)) {
			$this->template->error(lang("error_23"));
		}
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
				"upload_path" => $this->settings->info->upload_path,
				"overwrite" => FALSE,
				"max_filename" => 300,
				"encrypt_name" => TRUE,
				"remove_spaces" => TRUE,
				"allowed_types" => $this->settings->info->file_types,
				"max_size" => 2000,
				"xss_clean" => TRUE,
			));

			if (!$this->upload->do_upload()) {
				$this->template->error(lang("error_21")
					. $this->upload->display_errors());
			}

			$data = $this->upload->data();

			$image = $data['file_name'];
		} else {
			$image = $this->settings->info->site_logo;
		}

		$this->admin_model->updateSettings(
			array(
				"site_name" => $site_name,
				"site_desc" => $site_desc,
				"upload_path" => $upload_path,
				"upload_path_relative" => $upload_path_rel,
				"site_logo" => $image,
				"site_email" => $site_email,
				"register" => $register,
				"avatar_upload" => $avatar_upload,
				"file_types" => $file_types,
				"disable_captcha" => $disable_captcha,
				"date_format" => $date_format,
				"file_size" => $file_size,
				"login_protect" => $login_protect,
				"activate_account" => $activate_account,
				"default_user_role" => $default_user_role,
				"secure_login" => $secure_login,
				"google_recaptcha" => $google_recaptcha,
				"google_recaptcha_secret" => $google_recaptcha_secret,
				"google_recaptcha_key" => $google_recaptcha_key,
				"logo_option" => $logo_option,
				"layout" => $layout->layout_path,
				"profile_comments" => $profile_comments,
				"avatar_height" => $avatar_height,
				"avatar_width" => $avatar_width,
				"cache_time" => $cache_time,
				"resize_avatar" => $resize_avatar,
			)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_470"),
		)
		);
		$this->session->set_flashdata("globalmsg", lang("success_13"));
		redirect(site_url("admin/settings"));
	}

}

?>