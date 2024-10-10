<?php
session_start();
ini_set('display_errors', 1);
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '" . $email . "' and password = '" . md5($password) . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '" . $email . "' and password = '" . md5($password) . "'  and type= 2 ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function logout2()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}
	function save_user()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (!empty($cpass) && !empty($password)) {
			$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], '../assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";

		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set $data");
		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}
	function signup()
	{
		extract($_POST);
		$data = "";

		foreach ($_POST as $k => $v) {

			if (!in_array($k, array('id', 'cpass', 'month', 'day', 'year')) && !is_numeric($k)) {
				if ($k == 'password') {
					if (empty($v))
						continue;
					$v = md5($v);

				}
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (isset($email)) {
			$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
			if ($check > 0) {
				return 2;
				exit;
			}
		}
	

		if (isset($_FILES['pp']) && $_FILES['pp']['tmp_name'] != '') {
			$fnamep = strtotime(date('y-m-d H:i')) . '_' . $_FILES['pp']['name'];
			$move = move_uploaded_file($_FILES['pp']['tmp_name'], 'assets/uploads/' . $fnamep);
			$data .= ", profile_pic = '$fnamep' ";

		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set $data");

		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}
		if ($save) {
			if (empty($id))
				$id = $this->db->insert_id;

			foreach ($_POST as $key => $value) {
				if (!in_array($key, array('id', 'cpass', 'password')) && !is_numeric($key))
					if ($k = 'img') {
						$k = 'profile_pic';
					}
				if ($k = 'cover') {
					$k = 'cover_pic';
				}
				$_SESSION['login_' . $key] = $value;
			}
			$_SESSION['login_id'] = $id;
			if (isset($_FILES['pp']) && $_FILES['pp']['tmp_name'] != '')
				$_SESSION['login_profile_pic'] = $fnamep;
			if (!isset($type))
				$_SESSION['login_type'] = 2;
			return 1;
		}
	}

	function update_user()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'table')) && !is_numeric($k)) {
				if ($k == 'password')
					$v = md5($v);
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set $data");
		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			foreach ($_POST as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}

			return 1;
		}
	}
	function delete_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = " . $id);
		if ($delete)
			return 1;
	}

	function check_user()
	{
		extract($_POST);

		$check_sql = "SELECT * FROM pay WHERE user_id = '{$_SESSION['login_id']}'";
		$result = $this->db->query($check_sql);
		if ($result->num_rows > 0) {
			return false;
		} else {
			return true;
		}
	}
	function save_genre()
	{
		extract($_POST);

		// Check if the genre already exists in the database
		// $check_query = $this->db->prepare("SELECT id FROM genres WHERE genre = ? AND id != $id");
		// $check_query->bind_param("s", $genre);
		// $check_query->execute();
		// $check_result = $check_query->get_result();
		$check_sql = "SELECT * FROM `genres` WHERE `id` != '$id' AND `genre` = '$genre'";
		$result = $this->db->query($check_sql);
		if ($result->num_rows > 0) {
			return json_encode(array('status' => 'error', 'message' => 'Genre name already exists. Please choose a different name.'));
		}

		// Prepare the query to insert or update the genre
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cover')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}

		if (isset($_FILES['cover']) && $_FILES['cover']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", cover_photo = '$fname' ";
		}

		if (empty($id)) {
			if (empty($_FILES['cover']['tmp_name']))
				$data .= ", cover_photo = 'default_cover.jpg' ";
			$save = $this->db->query("INSERT INTO genres SET $data");
		} else {
			$save = $this->db->query("UPDATE genres SET $data WHERE id = $id");
		}

		if ($save) {
			return json_encode(array('status' => 'success', 'message' => 'Genre added successfully.'));
		} else {
			return json_encode(array('status' => 'error', 'message' => 'Failed to add genre. Please try again later.'));
		}
	}
	function delete_genre()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM genres where id = $id");
		if ($delete) {
			return 1;
		}
	}
	function save_music()
	{
		extract($_POST);

		// 		$date =date("Y-m-d");
// 		$day = 5;
// 		$newdate=date('Y-m-d', strtotime("+$day days"));
// 		echo "today is:".$date;
// 		echo "<br> and after 5 days is :".$newdate;
		$data = "";
		$check_sql = "SELECT * FROM uploads WHERE id != '$_POST[id]' AND title = '$_POST[title]'";
		$result = $this->db->query($check_sql);


		if (($result->num_rows == 0)) {

			foreach ($_POST as $k => $v) {
				if (!in_array($k, array('id', 'cover', 'audio', 'item_code')) && !is_numeric($k)) {
					if ($k == 'description')
						$v = htmlentities(str_replace("'", "&#x2019;", $v));
					if (empty($data)) {
						$data .= " $k='$v' ";
					} else {
						$data .= ", $k='$v' ";
					}
				}
			}

			$data .= ",user_id = '{$_SESSION['login_id']}' ";
			if (isset($_FILES['cover']) && $_FILES['cover']['tmp_name'] != '') {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['cover']['name'];
				$move = move_uploaded_file($_FILES['cover']['tmp_name'], 'assets/uploads/' . $fname);
				$data .= ", cover_image = '$fname' ";
			}
			if (isset($_FILES['audio']) && $_FILES['audio']['tmp_name'] != '') {
				$audio = strtotime(date('y-m-d H:i')) . '_' . $_FILES['audio']['name'];
				$move = move_uploaded_file($_FILES['audio']['tmp_name'], 'assets/uploads/' . $audio);
				$data .= ", upath = '$audio' ";
			}
			if (empty($id)) {
				if (empty($_FILES['cover']['tmp_name']))
					$data .= ", cover_image = 'default_cover.jpg' ";

				$save = $this->db->query("INSERT INTO uploads set $data");
			} else {
				$save = $this->db->query("UPDATE uploads set $data where id = $id");
			}
			if ($save) {
				return json_encode(array('status' => true, 'message' => 'Music successfully saved.'));
			} else {
				return json_encode(array('status' => false, 'message' => 'Something wrong.'));
			}
		} else {
			return json_encode(array('status' => false, 'message' => 'Music already added.'));
		}
	}
	function delete_music()
	{
		extract($_POST);
		$delete_comments_sql = "DELETE FROM comments WHERE music_id = $id";
		if ($this->db->query($delete_comments_sql) === TRUE) {
			// Proceed to delete the record from the uploads table
			$delete_upload_sql = "DELETE FROM uploads WHERE id = $id";
			if ($this->db->query($delete_upload_sql) === TRUE) {
				// Record deleted successfully
				return 1;
			}
		}
		// $delete = $this->db->query("DELETE FROM uploads where id = $id");
		// if ($delete) {
		// }
	}
	function get_details()
	{
		extract($_POST);

		$get = $this->db->query("SELECT * FROM uploads where id = $id")->fetch_array();
		$data = array("cover_image" => $get['cover_image'], "title" => $get['title'], "artist" => $get['artist']);
		return json_encode($data);
	}
	function save_playlist()
	{
		extract($_POST);
		$data = "";
 
		$pay = $this->db->query("SELECT *
		FROM pay
		WHERE user_id ='{$_SESSION['login_id']}'
		ORDER BY id DESC
		LIMIT 1")->fetch_assoc()
		;
		if ($pay || ($_SESSION['login_type'] == 1)) {
			

		$check_sql = "SELECT * FROM playlist WHERE id != '$_POST[id]' AND title = '$_POST[title]'";
		$result = $this->db->query($check_sql);

		if ($result->num_rows == 0) {
			# code...
			foreach ($_POST as $k => $v) {
				if (!in_array($k, array('id', 'cover')) && !is_numeric($k)) {
					if (empty($data)) {
						$data .= " $k='$v' ";
					} else {
						$data .= ", $k='$v' ";
					}
				}
			}
			$data .= ",user_id = '{$_SESSION['login_id']}' ";
			if (isset($_FILES['cover']) && $_FILES['cover']['tmp_name'] != '') {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['cover']['name'];
				$move = move_uploaded_file($_FILES['cover']['tmp_name'], 'assets/uploads/' . $fname);
				$data .= ", cover_image = '$fname' ";
			}
			if (empty($id)) {
				if (empty($_FILES['cover']['tmp_name']))
					$data .= ", cover_image = 'play.jpg' ";
				$save = $this->db->query("INSERT INTO playlist set $data");
			} else {
				$save = $this->db->query("UPDATE playlist set $data where id = $id");
			}

			if ($save) {
				return json_encode(array('status' => true, 'message' => 'Music successfully saved.'));
			} else {
				return json_encode(array('status' => false, 'message' => 'Something wrong.'));
			}
		} else {
			return json_encode(array('status' => false, 'message' => 'Music already added.'));
		}}else {
			return json_encode(array('status' => false,'pay'=>true));
		}
	}
	function delete_playlist()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM playlist where id = $id");
		if ($delete) {
			return 1;
		}
	}
	function find_music()
	{
		extract($_POST);
		$get = $this->db->query("SELECT id,title,upath,artist,cover_image FROM uploads where title like '%$search%' or artist like '%$search%' ");
		$data = array();
		while ($row = $get->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	function save_playlist_items()
	{
		extract($_POST);
		$ids = array();
		// Fetch the existing music items in the playlist
		$existing_music_ids = array();
		$existing_music_query = $this->db->query("SELECT music_id FROM playlist_items WHERE playlist_id = $playlist_id");
		while ($row = $existing_music_query->fetch_assoc()) {
			$existing_music_ids[] = $row['music_id'];
		}


		foreach ($music_id as $k => $v) {
			// Check if the music item is already in the playlist
			if (!in_array($music_id[$k], $existing_music_ids)) {
				$data = " playlist_id = $playlist_id ";
				$data .= ", music_id = {$music_id[$k]} ";
				// Insert the new music item into the playlist
				if ($save[] = $this->db->query("INSERT INTO playlist_items SET $data ")) {
					$ids[] = $music_id[$k];
				}
			}
			if (($key = array_search($music_id[$k], $existing_music_ids)) !== false) {
				unset($existing_music_ids[$key]);
			}

			// if (in_array($music_id[$k], $existing_music_ids)) {
			// 	echo $music_id[$k];
			// 	unset($existing_music_ids[$music_id[$k]]);
			// } 
		}
		// echo '<pre>';
		// print_r($existing_music_ids);
		// print_r($music_id);
		// die; 

		if (!empty($existing_music_ids)) {
			foreach ($existing_music_ids as $key => $id) {
				$sql = "DELETE FROM playlist_items WHERE music_id = $id AND playlist_id = $playlist_id ";
				$save[] = $this->db->query($sql);
			}
		}
		if (isset($save)) {
			return 1;
		}
	}
}