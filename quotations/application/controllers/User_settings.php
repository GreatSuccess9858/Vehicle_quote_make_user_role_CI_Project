<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_Settings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("user_model");

		if (!$this->user->loggedin) {
			$this->template->error(lang("error_1"));
		}

		$this->template->loadData("activeLink",
			array("settings" => array("general" => 1)));
	}

	public function index() {
		$fields = $this->user_model->get_custom_fields_answers(array(
			"edit" => 1,
		), $this->user->info->ID);
		$this->template->loadContent("user_settings/index.php", array(
			"fields" => $fields,
		)
		);
	}
	public function save_facturacion_info() {
		$rows = $this->input->post('facturacion');

		foreach ($rows as $k => $v) {
			$data[$k] = $v;
		}
		$data['tutores_id'] = $this->user->info->ID;
		if ($data['id'] > 0) {
			$this->db->where('id', $data['id'])->update('ce_facturacion_info', $data);
			$message = 'Los datos fueron actualizados.';
		} else {
			$this->db->insert('ce_facturacion_info', $data);
			$message = 'Se registro correctamente.';

		}

		$json['message'] = $message;

		_json($json);
	}

	public function save_colegios_info() {
		$rows = $this->input->post('colegios');

		foreach ($rows as $k => $v) {
			$data[$k] = $v;
		}
		$data['tutores_id'] = $this->user->info->ID;
		if ($data['id'] > 0) {
			$this->db->where('id', $data['id'])->update('ce_colegios', $data);
			$message = 'Los datos fueron actualizados.';
		} else {
			$this->db->insert('ce_colegios', $data);
			$message = 'Se registro correctamente.';

		}

		$json['message'] = $message;

		_json($json);
	}

	public function pro() {
		$this->load->model("register_model");
		$fields = $this->user_model->get_custom_fields_answers(array(
			"edit" => 1,
		), $this->user->info->ID);

		$this->load->helper('email');
		$this->load->library("upload");
		$email = $this->common->nohtml($this->input->post("email"));
		$first_name = $this->common->nohtml($this->input->post("first_name"));
		$last_name = $this->common->nohtml($this->input->post("last_name"));
		$aboutme = $this->common->nohtml($this->input->post("aboutme"));
        $phone = $this->common->nohtml($this->input->post("phone"));

		$address_1 = $this->common->nohtml($this->input->post("address_1"));
		$address_2 = $this->common->nohtml($this->input->post("address_2"));
		$city = $this->common->nohtml($this->input->post("city"));
		$state = $this->common->nohtml($this->input->post("state"));
		$zipcode = $this->common->nohtml($this->input->post("zipcode"));
		$country = $this->common->nohtml($this->input->post("country"));

		$profile_comments = intval($this->input->post("profile_comments"));

		$this->load->helper('email');

		if (empty($email)) {
			$this->template->error(lang("error_18"));
		}

		if (!valid_email($email)) {
			$this->template->error(lang("error_47"));
		}

		if ($email != $this->user->info->email) {
			if (!$this->register_model->checkEmailIsFree($email)) {
				$this->template->error(lang("error_20"));
			}
		}

		$enable_email_notification =
			intval($this->input->post("enable_email_notification"));
		if ($enable_email_notification > 1 || $enable_email_notification < 0) {
			$enable_email_notification = 0;
		}

		if ($this->settings->info->avatar_upload) {
			if ($_FILES['userfile']['size'] > 0) {

				if (!$this->settings->info->resize_avatar) {
					$this->upload->initialize(array(
						"upload_path" => $this->settings->info->upload_path,
						"overwrite" => FALSE,
						"max_filename" => 300,
						"encrypt_name" => TRUE,
						"remove_spaces" => TRUE,
						"allowed_types" => "gif|png|jpg|jpeg",
						"max_size" => $this->settings->info->file_size,
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
					$this->upload->initialize(array(
						"upload_path" => $this->settings->info->upload_path,
						"overwrite" => FALSE,
						"max_filename" => 300,
						"encrypt_name" => TRUE,
						"remove_spaces" => TRUE,
						"allowed_types" => "gif|png|jpg|jpeg",
						"max_size" => $this->settings->info->file_size,
					));

					if (!$this->upload->do_upload()) {
						$this->template->error(lang("error_21")
							. $this->upload->display_errors());
					}

					$data = $this->upload->data();

					$image = $data['file_name'];

					$config['image_library'] = 'gd';
					$config['source_image'] = $this->settings->info->upload_path . "/" . $image;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = $this->settings->info->avatar_width;
					$config['height'] = $this->settings->info->avatar_height;

					$this->load->library('image_lib', $config);

					if (!$this->image_lib->resize()) {
						$this->template->error(lang("error_21") .
							$this->image_lib->display_errors());
					}
				}
			} else {
				$image = $this->user->info->avatar;
			}
		} else {
			$image = $this->user->info->avatar;
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

		$this->user_model->update_user($this->user->info->ID, array(
			"email" => $email,
			"first_name" => $first_name,
			"last_name" => $last_name,
			"email_notification" => $enable_email_notification,
			"avatar" => $image,
			"aboutme" => $aboutme,
            "phone" => $phone,
			"address_1" => $address_1,
			"address_2" => $address_2,
			"city" => $city,
			"state" => $state,
			"zipcode" => $zipcode,
			"country" => $country,
			"profile_comments" => $profile_comments,
		)
		);

		// Update CF
		// Add Custom Fields data
		foreach ($answers as $answer) {
			// Check if field exists
			$field = $this->user_model->get_user_cf($answer['fieldid'], $this->user->info->ID);
			if ($field->num_rows() == 0) {
				$this->user_model->add_custom_field(array(
					"userid" => $this->user->info->ID,
					"fieldid" => $answer['fieldid'],
					"value" => $answer['answer'],
				)
				);
			} else {
				$this->user_model->update_custom_field($answer['fieldid'],
					$this->user->info->ID, $answer['answer']);
			}
		}

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_439"),
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_22"));
		redirect(site_url("user_settings"));
	}

	public function change_password() {
		$this->template->loadContent("user_settings/change_password.php", array(
		)
		);
	}

	public function change_password_pro() {
		$current_password =
		$this->common->nohtml($this->input->post("current_password"));
		$new_pass1 = $this->common->nohtml($this->input->post("new_pass1"));
		$new_pass2 = $this->common->nohtml($this->input->post("new_pass2"));

		if (empty($new_pass1)) {
			$this->template->error(lang("error_45"));
		}

		if ($new_pass1 != $new_pass2) {
			$this->template->error(lang("error_22"));
		}

		$phpass = new PasswordHash(12, false);
		if (!$phpass->CheckPassword($current_password, $this->user->getPassword())) {
			$this->template->error(lang("error_59"));
		}

		$pass = $this->common->encrypt($new_pass1);
		$this->user_model->update_user($this->user->info->ID,
			array("password" => $pass));

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_438"),
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_23"));
		redirect(site_url("user_settings/change_password"));
	}

	public function social_networks() {
		$user_data = $this->user_model->get_user_data($this->user->info->ID);
		if ($user_data->num_rows() == 0) {
			$this->user_model->add_user_data(array(
				"userid" => $this->user->info->ID,
			)
			);
			$user_data = $this->user_model->get_user_data($this->user->info->ID);
		}
		$user_data = $user_data->row();
		$this->template->loadContent("user_settings/social_networks.php", array(
			"user_data" => $user_data,
		)
		);
	}

	public function social_networks_pro() {
		$twitter = $this->common->nohtml($this->input->post("twitter"));
		$google = $this->common->nohtml($this->input->post("google"));
		$facebook = $this->common->nohtml($this->input->post("facebook"));
		$linkedin = $this->common->nohtml($this->input->post("linkedin"));
		$website = $this->common->nohtml($this->input->post("website"));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);
		if ($user_data->num_rows() == 0) {
			$this->user_model->add_user_data(array(
				"userid" => $this->user->info->ID,
			)
			);
			$user_data = $this->user_model->get_user_data($this->user->info->ID);
		}
		$user_data = $user_data->row();

		$this->user_model->update_user_data($user_data->ID, array(
			"twitter" => $twitter,
			"facebook" => $facebook,
			"google" => $google,
			"linkedin" => $linkedin,
			"website" => $website,
		)
		);

		$this->user_model->add_log(array(
			"userid" => $this->user->info->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_437"),
		)
		);

		$this->session->set_flashdata("globalmsg", lang("success_47"));
		redirect(site_url("user_settings/social_networks"));
	}

}

?>