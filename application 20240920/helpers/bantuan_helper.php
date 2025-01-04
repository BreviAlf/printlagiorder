<?php


/**
* function templogin
* helper yang berfungsi menyimpan log member yg telah login
*/

function DiscCalculation($price=FALSE,$disc_price)
{
	if(($price != '') && ($disc_price != '')){
		$val = ceil(($price - $disc_price)/$price*100);
		$percent = $val * 100;
		return '-'.$val.'%';
	}else{
		return false;
	}

}

function GetCustByUid($uid)
{
	$ci=& get_instance();
	$ci->db->select('cust_id');
	$ci->db->where('cust_uid',$uid);
	$row = $ci->db->get('tb_customer')->row();
	if($row){
		$cust_id = $row->cust_id;
	}else{
		$cust_id = 0;
	}
	return $cust_id;
}	

function GetUid()
{
	$params = '';
	$data['uid'] = '';
	$url = parse_url($_SERVER['REQUEST_URI']);
	if(isset($url['query'])){
		parse_str($url['query'], $params);

		if(isset($params['uid']))
		{
			$data['uid'] = $params['uid'];
		}
			
	}
	return $data['uid'];
}

function GetLocation($type)
{
	//Gets the IP Address from the visitor
	$PublicIP = $_SERVER['REMOTE_ADDR'];
	//Uses ipinfo.io to get the location of the IP Address, you can use another site but it will probably have a different implementation
	$json     = file_get_contents("http://ipinfo.io/$PublicIP/geo");
	//Breaks down the JSON object into an array
	$json     = json_decode($json, true);


	if($type=='city'){
		$city = '';
		if(isset($json['city'])){
			$city     = $json['city'];
		}
		return $city;
	}
	if($type=='region'){
		$region = '';
		if(isset($json['region'])){
			$region   = $json['region'];
		}
		return $region;
	}
	if($type=='country'){
		$country = '';
		if(isset($json['country'])){
			$country  = $json['country'];
		}
		return $country;
	}

}

function getBrowser()
{
	$ci=& get_instance();
	$ci->load->library('user_agent');

	if ($ci->agent->is_browser())
	{
			$agent = $ci->agent->browser().' '.$ci->agent->version();
	}
	elseif ($ci->agent->is_robot())
	{
			$agent = $ci->agent->robot();
	}
	elseif ($ci->agent->is_mobile())
	{
			$agent = $ci->agent->mobile();
	}
	else
	{
			$agent = 'Unidentified User Agent';
	}

	return $agent.' - '.$ci->agent->platform();

}

// Function to get the client IP address
function GetClientIp() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function memLogin()
{
	$ci=& get_instance();
	$sesId = $ci->session->userdata('session_id');
	
	$ci->db->where('session_id',$sesId);
	$ci->db->join('tb_member','tb_member.member_id = tb_temp_login.temp_mem_id');
	$query = $ci->db->get('tb_temp_login');
	$custLog = $query->result_array();
	$num_cart = $query->num_rows();
		//jika cust ada sesuai session
		if($num_cart>0):
			$log=$num_cart;
		else:
			$log=0;
		endif;
	return $log;
}

function CreateFolder($inv_mp=FALSE,$spk_no=FALSE)
{
	$dir = 'D:\\Order';
	$day = date('d'); 
	$month = date('M'); 
	$year = date('Y'); 

	$full_path = $dir.'\\'.$year.'\\'.$month.'\\'.$day.'\\'.$inv_mp.'\\'.$spk_no;

	if(!is_dir($full_path)) {
		mkdir($full_path,0777, true );
		return $full_path;
	}
}


function ConvertMonth($month)
{
	$months = array(
		'01'=>'Jan',
		'02'=>'Feb',
		'03'=>'Mar',
		'04'=>'Apr',
		'05'=>'May',
		'06'=>'Jun',
		'07'=>'Jul',
		'08'=>'Aug',
		'09'=>'Sep',
		'10'=>'Oct',
		'11'=>'Nov',
		'12'=>'Dec',
	   );

	return $months[$month];
}


function GetImg($inv_mp=FALSE,$spk_no=FALSE)
{
	$dir = 'D:\\Order';
	$day = date('d'); 
	$month = date('M'); 
	$m = date('m');
	$year = date('Y'); 
	$y = date("y");

	$y_spk = '20'.substr($spk_no,2,2);// sorry our system only support till 2099!!! yeah i'm too lazy
	$m_spk = substr($spk_no,4,2);
	$d_spk = substr($spk_no,6,2);

	$date_rt 	= $year.'-'.$m.'-'.$day;
	$date_spk 	= $y_spk.'-'.$m_spk.'-'.$d_spk; 

	if($date_rt == $date_spk){
			$full_path = $dir.'\\'.$year.'\\'.$month.'\\'.$day.'\\'.$inv_mp.'\\'.$spk_no;
	}else{
			$full_path = $dir.'\\'.$y_spk.'\\'.ConvertMonth($m_spk).'\\'.$d_spk.'\\'.$inv_mp.'\\'.$spk_no;
	}

	return $full_path;
}

function CreateFolderBatch($batch_name)
{
	$dir = 'D:\\Order';
	$day = date('d'); 
	$month = date('M'); 
	$year = date('Y'); 

	$full_path = $dir.'\\'.$year.'\\'.$month.'\\'.$day.'\\'.$batch_name;

	if(!is_dir($full_path)) {
		mkdir($full_path,0777, true );
		return $full_path;
	}
}

function GetFolderBatch($batch_name)
{
	$dir = 'D:\\Order';
	$day = date('d');
	$month = date('M');
	$year = date('Y');

	$full_path = $dir.'\\'.$year.'\\'.$month.'\\'.$day.'\\'.$batch_name;

	return $full_path;
}

function GetFolderInv($inv_mp=FALSE)
{
	$dir = 'D:\\Order';
	$day = date('d');
	$month = date('M');
	$year = date('Y');
	$full_path = $dir.'\\'.$year.'\\'.$month.'\\'.$day.'\\'.$inv_mp;

	return $full_path;
}

function copyDirectory($source=FALSE, $destination=FALSE,$inv_mp=FALSE) {
	if (!is_dir($destination)) {
	   mkdir($destination, 0755, true);
	}
	$files = scandir($source);
	foreach ($files as $file) {
	   if ($file !== '.' && $file !== '..') {
		  $sourceFile = $source . '/' . $file;
		  $destinationFile = $destination . '/' . $file;
		  if (is_dir($sourceFile)) {
			 copyDirectory($sourceFile, $destinationFile);
			 
		  } else {
			if(file_exists($sourceFile))
			{
				copy($sourceFile, $destinationFile);
			}
			 
		  }
		  //deleteDirectory($source);
	   }
	}
	
 }

 function is_dir_empty($dir) {
	return (count(scandir($dir)) == 2);
  }


 function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}


// date comparation

function CompareDateTime($type=FALSE,$dt_tm_now=FALSE,$dt_tm_compare=FALSE)
{
	
	if($type == 'now')
	{
		$date_time_now 		= strtotime($dt_tm_now);
		$date_time_compare	= strtotime($dt_tm_compare);

		if($date_time_now > $date_time_compare)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

}




// get data table by id
function getDataTableById($table_name,$field_name,$field_id,$id)
{
	$ci=& get_instance();
	$ci->db->select($field_name);
	$ci->db->where($field_id,$id);
	$row = $ci->db->get($table_name)->row();
	return $row->$field_name;
}

//get count varian
function GetVarianByProdId($prod_id)
{
	$ci=& get_instance();
	$ci->db->select("*");
	$ci->db->where('prod_var_prod_id',$prod_id);
	$arr = $ci->db->get('tb_prod_var')->result_array();
	return $arr;
}

// Category Drop Down
function DropdownCategory($selected,$name)
{
	$ci = &get_instance();
	$ci->db->select('cat_name');
	$ci->db->select('cat_id');
	$arr = $ci->db->get('tb_category')->result_array();
	$x = 0;
	$output = "<select id='category' class='form-select' onChange='ChangeCategory(this.value)'  name='$name'>";
	$output .= "<option value=''> - Pilih - </option>";
	foreach ($arr as $row) :
		if ($selected) :
			if ($row["cat_id"] == $selected) :
				$output .= "<option value='" . $row["cat_id"] . "' selected='selected'>" . $row['cat_name'] . "</option>";
			else :
				$output .= "<option value='" . $row["cat_id"] . "'>" . $row['cat_name'] . "</option>";
			endif;
		else :
			$output .= "<option value='" . $row["cat_id"] . "'>" . $row['cat_name'] . "</option>";
		endif;
	endforeach;
	$output .= "</select>";
	return $output;
}

// Category Drop Down
function DropdownKurir($selected,$name)
{
	$ci = &get_instance();
	$arr = $ci->db->get('tb_kurir')->result_array();
	$x = 0;
	$output = "<select id='pack_kurir_id' class='form-select' onChange=''  name='$name' required>";
	$output .= "<option value=''> - Pilih - </option>";
	foreach ($arr as $row) :
		if ($selected) :
			if ($row["kurir_id"] == $selected) :
				$output .= "<option value='" . $row["kurir_id"] . "' selected='selected'>" . $row['kurir_name'] . "</option>";
			else :
				$output .= "<option value='" . $row["kurir_id"] . "'>" . $row['kurir_name'] . "</option>";
			endif;
		else :
			$output .= "<option value='" . $row["kurir_id"] . "'>" . $row['kurir_name'] . "</option>";
		endif;
	endforeach;
	$output .= "</select>";
	return $output;
}


// Papersize Drop Down
function DropdownPaperSize($selected,$name,$change_event)
{
	$ci = &get_instance();
	$arr = $ci->db->get('tb_paper_size')->result_array();
	$output = "<select id='paper_size_id' class='form-select' onChange='$change_event(this.value)' name='$name'>";
	foreach ($arr as $row) :
		if ($selected) :
			if ($row["paper_size_id"] == $selected) :
				$output .= "<option value='" . $row["paper_size_id"] . "' selected='selected'>" . $row['paper_size_name'] . "</option>";
			else :
				$output .= "<option value='" . $row["paper_size_id"] . "'>" . $row['paper_size_name'] . "</option>";
			endif;
		else :
			$output .= "<option value='" . $row["paper_size_id"] . "'>" . $row['paper_size_name'] . "</option>";
		endif;
	endforeach;
	$output .= "</select>";
	return $output;
}



// Category Drop Down
function DropdownNiche($selected,$name,$change_event)
{
	$ci = &get_instance();
	$ci->db->select('niche_name');
	$ci->db->select('niche_id');
	$arr = $ci->db->get('tb_niche')->result_array();
	$output = "<select id='niche_id' class='form-select' onChange='$change_event(this.value)' name='$name'>";
	$output .= "<option value=''> - Pilih - </option>";
	foreach ($arr as $row) :
		if ($selected) :
			if ($row["niche_id"] == $selected) :
				$output .= "<option value='" . $row["niche_id"] . "' selected='selected'>" . $row['niche_name'] . "</option>";
			else :
				$output .= "<option value='" . $row["niche_id"] . "'>" . $row['niche_name'] . "</option>";
			endif;
		else :
			$output .= "<option value='" . $row["niche_id"] . "'>" . $row['niche_name'] . "</option>";
		endif;
	endforeach;
	$output .= "</select>";
	return $output;
}

function DropdownMaterial($selected,$name,$change_event)
{
	$ci = &get_instance();
	$ci->db->select('material_name');
	$ci->db->select('material_code');
	$ci->db->select('material_id');
	$arr = $ci->db->get('tb_material')->result_array();
	$output = "<select id='material_id' class='form-select' onChange='$change_event(this.value)' name='$name'>";
	foreach ($arr as $row) :
		if ($selected) :
			if ($row["material_id"] == $selected) :
				$output .= "<option value='" . $row["material_id"] . "' selected='selected'>" . $row['material_code'] ." - ". $row['material_name'] . "</option>";
			else :
				$output .= "<option value='" . $row["material_id"] . "'>" . $row['material_code'] ." - ". $row['material_name']  . "</option>";
			endif;
		else :
			$output .= "<option value='" . $row["material_id"] . "'>" . $row['material_code'] ." - ". $row['material_name']  . "</option>";
		endif;
	endforeach;
	$output .= "</select>";
	return $output;
}


function GenUid($table,$col_id)
{
	date_default_timezone_set('Asia/Jakarta');

	//
	$ci=& get_instance();

	$tgl_p=date('ymd');
    $tgl_hari_ini=date('Y-m-d');
    $cekid=$tgl_p."00001";

	$qr_check = $ci->db->query("SELECT spk_uid FROM  $table WHERE date(spk_datetime_in) ='$tgl_hari_ini' and spk_uid='$cekid'");

	if($qr_check->num_rows()==0){
		$uid = $cekid;
	}
	else{
		$qr_last_id = $ci->db->query("SELECT spk_uid from $table order by spk_uid desc limit 1")->row();
		$uid = $qr_last_id->spk_uid + 1;
	}

	return CheckUid($table,$uid);
}


function CheckUid($table,$uid)
{
	$ci=& get_instance();
	$qr_check = $ci->db->query("SELECT spk_uid FROM $table WHERE spk_uid = $uid");
	if($qr_check->num_rows()==0){
		return $uid;
	}else{
		//return "duplicate $uid";
		return GenUid($table,$col_id);
	}
}

function GenBatchName()
{

	$day = date('d'); 
	$month = date('M'); 
	$m = date('m');
	$year = date('Y'); 
	$y = date("y");

	$ci=& get_instance();
	$row = $ci->db->query("select max(tb_batch_spk.batch_spk_uid) as max_uid from tb_batch_spk;")->row();

	$batch_uid = $row->max_uid;

	$y_uid = substr($batch_uid,0,2);// sorry our system only support till 2099!!! yeah i'm too lazy
	$m_uid = substr($batch_uid,2,2);
	$d_uid = substr($batch_uid,4,2);

	$date_rt 		= $y.'-'.$m.'-'.$day;
	$date_batch 	= $y_uid.'-'.$m_uid.'-'.$d_uid; 

	// if date equal then continue generate 240920005+1
	if($date_rt == $date_batch){
		$u_plus = $row->max_uid + 1;
		$urut = substr($u_plus, -2);
		$batch_name = "B-".$urut;
	}else{// if date not equal then reset to 1
		$batch_name = "B-01";
	}

	return $batch_name;

}

function GenUidBatch($table,$col_id)
{
	date_default_timezone_set('Asia/Jakarta');

	//
	$ci=& get_instance();

	$tgl_p=date('ymd');
    $tgl_hari_ini=date('Y-m-d');
    $cekid=$tgl_p."001";

	$qr_check = $ci->db->query("SELECT batch_spk_uid FROM  $table WHERE date(batch_spk_date_created) ='$tgl_hari_ini' and batch_spk_uid='$cekid'");

	if($qr_check->num_rows()==0){
		$uid = $cekid;
	}
	else{
		$qr_last_id = $ci->db->query("SELECT batch_spk_uid from $table order by batch_spk_uid desc limit 1")->row();
		$uid = $qr_last_id->batch_spk_uid + 1;
	}

	return CheckUidBatch($table,$uid);
}


function CheckUidBatch($table,$uid)
{
	$ci=& get_instance();
	$qr_check = $ci->db->query("SELECT batch_spk_uid FROM $table WHERE batch_spk_uid = $uid");
	if($qr_check->num_rows()==0){
		return $uid;
	}else{
		//return "duplicate $uid";
		return CheckUidBatch($table,$col_id);
	}
}


function CountBatch($batch_spk_id)
{
	$ci=& get_instance();
	$qr = $ci->db->query("SELECT count(batch_spk_det_batch_spk_id) AS count_spk FROM tb_batch_spk_detail where batch_spk_det_spk_id = $batch_spk_id");
	$count = $qr->row()->count_spk;
	return $count;
}

function CountSPKDone($batch_spk_id)
{
	$ci=& get_instance();
	$qr = $ci->db->query("SELECT count(batch_spk_det_batch_spk_id) 
	AS count_spk FROM tb_batch_spk_detail where batch_spk_det_spk_id = $batch_spk_id AND (batch_spk_det_done!='NULL' OR batch_spk_det_done != '0000-00-00 00:00:00')");
	$count = $qr->row()->count_spk;
	return $count;
}

function CountPacking($pack_id)
{
	$ci=& get_instance();
	$qr = $ci->db->query("SELECT count(pack_det_id) AS count_pack FROM tb_packing_detail where pack_det_pack_id = $pack_id");
	$count = $qr->row()->count_pack;
	return $count;
}


function GetDataBatch($spk_no)
{
	error_reporting(E_ALL & ~E_NOTICE);
	$ci=& get_instance();
	$qr = $ci->db->query("
		SELECT 
			dt.batch_spk_det_spk_no,
			b.batch_spk_name,
			b.batch_spk_no,
			b.batch_spk_date_created,
			b.batch_spk_status
		FROM
		 	tb_batch_spk_detail dt
		JOIN
			tb_batch_spk b ON b.batch_spk_id = dt.batch_spk_det_spk_id
		WHERE dt.batch_spk_det_spk_no = '$spk_no'
		LIMIT 1")->row();
	

	if(!$qr){
		$ci->db->error();
	}else{
		return $qr;
	}
	
}

function GetDataPacking($inv)
{
	error_reporting(E_ALL & ~E_NOTICE);
	$ci=& get_instance();
	$qr = $ci->db->query("
		SELECT 
			dt.pack_det_inv_mp,
			p.pack_no,
			p.pack_kurir_name,
			p.pack_date_created
		FROM
			tb_packing_detail dt
		JOIN
			tb_packing p ON p.pack_id = dt.pack_det_pack_id
		WHERE dt.pack_det_inv_mp = '$inv'
		LIMIT 1")->row();
	
	if(!$qr){
		$ci->db->error();
		return $qr;
	}else{
		return $qr;
	}
}



function GenUidPack($table,$col_id)
{
	date_default_timezone_set('Asia/Jakarta');

	//
	$ci=& get_instance();

	$tgl_p=date('ymd');
    $tgl_hari_ini=date('Y-m-d');
    $cekid=$tgl_p."001";

	$qr_check = $ci->db->query("SELECT pack_uid FROM  $table WHERE date(pack_date_created) ='$tgl_hari_ini' and pack_uid='$cekid'");

	if($qr_check->num_rows()==0){
		$uid = $cekid;
	}
	else{
		$qr_last_id = $ci->db->query("SELECT pack_uid from $table order by pack_uid desc limit 1")->row();
		$uid = $qr_last_id->pack_uid + 1;
	}

	return CheckUidPack($table,$uid);
}


function CheckUidPack($table,$uid)
{
	$ci=& get_instance();
	$qr_check = $ci->db->query("SELECT pack_uid FROM $table WHERE pack_uid = $uid");
	if($qr_check->num_rows()==0){
		return $uid;
	}else{
		//return "duplicate $uid";
		return GenUidPack($table,$col_id);
	}
}

function GenerateUid($int)
{
	$hash = substr(md5($int), 0, 7);
	return $hash; 
}

function GetIpBlocked($MyIp)
{
	$ci=& get_instance();
	$arr_ip = $ci->db->get('tb_block_ip')->result_array();
	//$list_ip = array();
	foreach ($arr_ip as $row_ip)
	{
		$list_ip[] = $row_ip['block_ip_val'];
	}

	if (in_array($MyIp, $list_ip)) {
		return false;
	}else{
		return true;
	}

}


function DropdownStatus($selected,$name)
{
	$class = "class='form-select'";
	$options = array(
                  'Y'=> 'Y',
                  'N' => 'N'
                );
	return form_dropdown($name,$options,$selected,$class);
} 

function DropdownSPKType($selected,$name)
{
	$class = "class='form-select'";
	$options = array(
				  'NON-PO' => 'NON-PO',
                  'PO'=> 'PO',
                  'READY' => 'READY'

    );
	return form_dropdown($name,$options,$selected,$class);
} 


function GetNotif()
{
	date_default_timezone_set('Asia/Jakarta');

	$date =date('Y-m-d');
    $date_time_now =date('Y-m-d H:i:s');

	$ci=& get_instance();
	// get data notif
	$ci->db->where('notif_tb_name','tb_batch_spk');
	$arr_notif = $ci->db->get('tb_notif')->result_array();

	foreach($arr_notif as $row_notif):
		$notif_start = $date.' '.$row_notif['notif_start'];
		$notif_end 	 = $date.' '.$row_notif['notif_end'];

		if ($date_time_now > $notif_start && $date_time_now < $notif_end)
		{
			$qr_batch_spk = $ci->db->query("SELECT *
				FROM tb_batch_spk
				WHERE batch_spk_date_process
				BETWEEN '$notif_start' AND '$notif_end'");
			
			$num = $qr_batch_spk->num_rows();
 			
			if($num > 0){
				echo '<span class="badge bg-success">'.$row_notif['notif_title'].' SUDAH DIBUAT</span>';
				
			}else{
				echo '<div class="blink_me"> <h3><span class="badge bg-danger">'.$row_notif['notif_title'].' - '.$row_notif['notif_text'].'</span></h3></div>';
			  
			}
		}

	endforeach;

}


function DropdownPrintSide($selected,$name)
{
	$class = "class='form-select'";
	$options = array(
				  'No Print' => 'No Print',
                  '4/4 (2 Sisi)'=> '4/4 (2 Sisi)',
                  '4/0 (1 Sisi)' => '4/0 (1 Sisi)'

    );
	return form_dropdown($name,$options,$selected,$class);
} 

function DropdownLaminasi($selected,$name)
{
	$class = "class='form-select'";
	$options = array(
                  'Tanpa Laminasi'=> 'Tanpa Laminasi',
                  'Laminasi Glossy' => 'Laminasi Glossy',
                  'Laminasi Doff' => 'Laminasi Doff',
                  'Hologram Polos' => 'Hologram Polos',
                  'Hologram Bintang' => 'Hologram Bintang'
                );
	return form_dropdown($name,$options,$selected,$class);
} 

function DropdownCutting($selected,$name)
{
	$class = "class='form-select'";
	$options = array(
				  'No Cut' => 'No Cut',
                  'Kiss Cut'=> 'Kiss Cut',
                  'Die Cut' => 'Die Cut'

                );
	return form_dropdown($name,$options,$selected,$class);
} 

function DropdownStore($selected,$name)
{
	$class = "class='form-select'";
	$options = array(
                  'XG-Benhil'=> 'XG-Benhil',
                  'PNC' => 'PNC',
                  'XG-Gandaria' => 'XG-Gandaria',
                );
	return form_dropdown($name,$options,$selected,$class);
} 



function DropdownSisiLaminasi($selected,$name)
{
	$class = "class='form-select'";
	$options = array(
                  '0'=> '0',
                  '1' => '1',
                  '2' => '2'
                );
	return form_dropdown($name,$options,$selected,$class);
} 

function CheckBoxFinishing($prod_var_id)
{
	$ci=& get_instance();
	$qr = $ci->db->get('tb_finishing')->result_array();

	return $qr;

}

function CopyFile($source,$dest)
{
	if(file_exists($source))
	{
		$rand_string = generateRandomString(5);
		$new_file = md5(pathinfo($source, PATHINFO_FILENAME)).'_'.$rand_string.'.'. pathinfo($source, PATHINFO_EXTENSION);
		copy($source,$dest.''.$new_file);
		return $dest.''.$new_file;
	}
	else
	{
		return '';
	}
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function GetColor($prod_id)
{
	$ci =& get_instance();
	$ci->db->where('color_prod_id',$prod_id);
	$query = $ci->db->get('tb_color');

	return $query->result_array(); 
}

function GetSize($size_prod_id,$parent = FALSE)
{
	$ci =& get_instance();

	if($parent){
		$parent_color = $ci->db->where('color_prod_id',$size_prod_id);
		$parent_color = $ci->db->where('color_parent','Y');
		$parent_color = $ci->db->get('tb_color')->row();

		if($parent_color){
			$query = $ci->db->where('size_color_id',$parent_color->color_id);
		}
		
	}

	$query = $ci->db->where('size_prod_id',$size_prod_id);
	$query = $ci->db->order_by('size_ordering','ASC');
	$query = $ci->db->get('tb_stock_size');

	return $query->result_array(); 
}

function GetAllSize($prod_id)
{
	$CI =& get_instance();
		
	$arr_all_size = $CI->db->query("SELECT 
		tb_color.color_id,
		tb_color.color_name,
		tb_color.color_prod_id,
		tb_stock_size.*
		FROM tb_color
		JOIN tb_stock_size ON tb_stock_size.size_color_id = tb_color.color_id
		WHERE tb_color.color_prod_id = $prod_id
		ORDER BY color_id, tb_stock_size.size_ordering ASC"
	); 

	return 	$arr_all_size->result_array();	
}

function GetColorParent($prod_id)
{
	$CI =& get_instance();
		
	$query = $CI->db->query("SELECT 
		tb_color.color_id,
		tb_color.color_name,
		tb_color.color_prod_id
		FROM tb_color
		WHERE tb_color.color_prod_id = $prod_id AND tb_color.color_parent = 'Y' LIMIT 1
	")->row(); 

	if($query){
		return $query->color_id;
	}else{
		return 0;
	}
	

}

function CurrentUrl()
{
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}

function CheckInput($input)
{
	if(preg_match('/^[a-z\d\-_\s]+$/i', $input)){
		return true;
	}
	else{ 
		return false;
	}
}

function CreateLog($type=FALSE,$detail=FALSE)
{
	$ci=& get_instance();
	$controller = $ci->uri->segment(1);
	$func = $ci->uri->segment(2);
	$url = CurrentUrl();

	if($ci->session->userdata('user_id')){
		$log_user_id = $ci->session->userdata('user_id');
	}else{
		$log_user_id = 9999999;
	}

	$data = array(
		'log_type'			=> $type,
		'log_controller'	=> $controller,
		'log_function'		=> $func,
		'log_detail'		=> $detail,
		'log_current_url'	=> $url,
		'log_user_id'		=> $log_user_id

	);
	$ci->db->insert('tb_log',$data);
}


// common drop down
function commonDropdown($table,$col_id = FALSE, $col_val = FALSE,$name,$selected)
{
	$ci = &get_instance();
	if($col_id):

	else:
		$ci->db->select($col_val);
		$arr = $ci->db->get($table)->result_array();
		$output = "<select class='form-control' name='" . $name . "' id='" . $name . "' onChange=''>";
		$output .= "<option value=''> - Pilih - </option>";
		foreach ($arr as $row) :
			if ($selected) :
			if ($row[$col_val] == $selected) :
			$output .= "<option value='" . $row[$col_val] . "' selected='selected'>" . $row[$col_val] . "</option>";
		else :
			$output .= "<option value='" . $row[$col_val] . "'>" . $row[$col_val] . "</option>";
		endif;
		else :
			$output .= "<option value='" . $row[$col_val] . "'>" . $row[$col_val] . "</option>";
		endif;
		endforeach;
		$output .= "</select>";
		return $output;
	endif;
}  


function InsertColorCode($name,$path)
{
	$ci = &get_instance();
	$ci->db->where('cc_name',$name);
	$row = $ci->db->get('tb_color_code')->row();
	if($row)
	{
		$o_file = 'public\\color_code\\'.$row->cc_img_path;
		$n_file = $path.'\\'.$row->cc_img_path;
		if(!copy($o_file,$n_file)){
			echo "failed to copy $o_file";

			exit();
			//return false;
		}
		else{
			
			//echo "copied $file into $newfile\n";
			return true;
		}

	}
	else{
		return true;
	}
		
}


// calculate expired

function GetExpired($date_listing,$month_val)
{
	$expired_date = date('Y-m-d', strtotime("+$month_val months", strtotime($date_listing)));

	return $expired_date;
}


function OpsiCetak($selected)
{
	$class = 'class="form-control"';
	$options = array(
                  'filter_short'		=> 'Sesuai Filter / Sort',
                  'cetak_all' 			=> 'Cetak Semua',
                  //'sort_by_alphabet'	=> 'Alphabet',
                );
	return form_dropdown('opsi_cetak',$options,$selected,$class);
} 


function jenkelDropdown($selected=FALSE,$attr=FALSE)
{
	$class = "id='$attr' class='form-control' onChange='ChangeGender(this.value)'";
	$options = array(
				  '' => '- Pilih -',
                  'Pria'=> 'Pria',
                  'Wanita' => 'Wanita'
                );
	return form_dropdown('gender',$options,$selected,$class);
} 

// function update status

function update_status($id_listing,$status)
{
	$ci = &get_instance();
	// check tb_update_status
	$ci->db->where('listing_id',$id_listing);
	$query = $ci->db->get('tb_status_update');
	$exist = $query->num_rows();

	if($exist){
		// update table tb_update_status
		$data = array(
			'listing_id'	=> $id_listing,
			'status_name'	=> $status,
			'cust_name'		=> 'NO_DATA',
			'cust_phone'	=> 'NO_DATA',
			'cust_addr'		=> 'NO_DATA',
			'date_modified'	=> date('Y-m-d H:i:s'),
			'desc'			=> 'NO_DATA',
		);
		$ci->db->where('listing_id',$id_listing);
		$ci->db->update('tb_status_update',$data);
	}else{
		// insert table tb_update_status
		$data = array(
				'listing_id'	=> $id_listing,
				'status_name'	=> $status,
				'cust_name'		=> 'NO_DATA',
				'cust_phone'	=> 'NO_DATA',
				'cust_addr'		=> 'NO_DATA',
				'date_created'	=> date('Y-m-d H:i:s'),
				'desc'			=> 'NO_DATA',
			);
		$ci->db->insert('tb_status_update',$data);
	}

}

function GenerateName($gender=FALSE)
{
	$ci = &get_instance();

	if($gender){
		$ci->db->where('random_gender',$gender);
		$qr = $ci->db->get('tb_random_name')->result_array();
	}else{
		$qr = $ci->db->get('tb_random_name')->result_array();
	}

	foreach ($qr as $row)
	{
		$arr_name[] = $row['random_name'];
	}
	
	$name = $arr_name[rand ( 0 , count($arr_name) -1)];

	return $name;

}

function count_status($stat)
{
	$ci = &get_instance();
	$query = "SELECT COUNT(tb_m_listing.id_listing) as count_stat FROM tb_m_listing WHERE tb_m_listing.status = '$stat'";
	$result = $ci->db->query($query)->row();

	if($result){
		$count = $result->count_stat;
		return $count;
	}else{
		$count = 0;
		return $count;
	}
	
}


// tanggalan

function getTh($ket,$var)
{
	if($ket == 'plus'):
		$dt = explode('-',date('Y-m-d'));
		$th = $dt[0] + $var;
	elseif($ket == 'min'):
		$dt = explode('-',date('Y-m-d'));
		$th = $dt[0] - $var;
	endif;
	return $th;
}

function dateDropdown($name,$date=FALSE,$th_st=FALSE,$th_end=FALSE)
{
	$ci=& get_instance();
	if($date){
	$dt = explode('-',$date);
	$year = $dt[0];
	$mon = $dt[1];
	$day = $dt[2];
	}
	
	$ret = '<select class="form-control" name="'.$name.'_d"  style="width:70px;">';
	$ret .= '<option value="">Hr</option>';
	for ($i=1;$i<32;$i++):
		$val=$i;
		if($val < 10):
			$val = '0'.$val;
		endif;
		if ($date):
			if($val == $day):
				$ret .= '<option value="'.$val.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$val.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$val.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select> ';

	$month = array	('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
	$ret .= '<select class="form-control" name="'.$name.'_m"  style="width:72px;">';
	$ret .= '<option value="">Bln</option>';
	for ($i=0;$i<12;$i++):
		$val=$i+1;
		if($val < 10):
			$val = '0'.$val;
		endif;
		if ($date):
			if($val == $mon):
				$ret .= '<option value="'.$val.'" selected="selected">'.$month[$i].'</option>';
			else:
				$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
			endif;
		else:
			$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
		endif;
	endfor;
	$ret .='</select> ';
	

	$minyear = $th_st;
	$plusyear = $th_end;

	$ret .= '<select class="form-control" name="'.$name.'_y" style="width:80px;">';
	$ret .= '<option value="">Thn</option>';
	for ($i=$minyear;$i<=$plusyear;$i++):
		if ($date):
			if($i==$year):
				$ret .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$i.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$i.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select>';
return $ret;

}

function bulanDropdown($name,$date=FALSE,$th_st=FALSE,$th_end=FALSE)
{

	$ci=& get_instance();
	if($date){
	$dt = explode('-',$date);
	$year = $dt[0];
	$mon = $dt[1];
	$day = $dt[2];
	}
	
	
	$month = array	('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
	$ret = '<select class="form-control" name="'.$name.'_m"  style="width:80px;">';
	for ($i=0;$i<12;$i++):
		$val=$i+1;
		if($val < 10):
			$val = '0'.$val;
		endif;
		if ($date):
			if($val == $mon):
				$ret .= '<option value="'.$val.'" selected="selected">'.$month[$i].'</option>';
			else:
				$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
			endif;
		else:
			$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
		endif;
	endfor;
	$ret .='</select> ';
	

	$minyear = $th_st;
	$plusyear = $th_end;

	$ret .= '<select class="form-control" name="'.$name.'_y" style="width:80px;">';
	for ($i=$minyear;$i<=$plusyear;$i++):
		if ($date):
			if($i==$year):
				$ret .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$i.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$i.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select>';
return $ret;

}

function tahunDropdown($name,$date=FALSE,$th_st=FALSE,$th_end=FALSE)
{

	$ci=& get_instance();
	if($date){
	$dt = explode('-',$date);
	$year = $dt[0];
	$mon = $dt[1];
	$day = $dt[2];
	}

	$minyear = $th_st;
	$plusyear = $th_end;

	$ret = '<select class="form-control" name="'.$name.'_y" style="width:80px;">';
	for ($i=$minyear;$i<=$plusyear;$i++):
		if ($date):
			if($i==$year):
				$ret .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$i.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$i.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select>';
return $ret;

}

// function time_drop_down()
// param
//  - type : char
//  - selected : char
//  - h : int
//  - m : int
//  - s : int

function timeDropDown($type = FALSE,$name=FALSE, $selected = FALSE)
{

	$class_id = 'class="form-control" style="width:70px;"';

	$ci=& get_instance();
	$arr = array();
	if ($type == 'h')
	{
		$arr['']='hh';
		for($i = 0; $i <= 23; $i++)
		{
			if (strlen($i) == 1)
			{
				$arr['0'.$i] = '0'.$i;
			}
			else
			{
				$arr[$i] = $i;
			}
			
		}
		$h_val= $arr;
		$options = $h_val;
	}
	else if ($type == 'm' || $type == 's')
	{
		if ($name == 'slot_time')
		{
			$min = 60;
		}
		else
		{
			$min = 59;
		}
		
		if($type == 'm')
		{
			$arr['']='mm';
		}
		else
		{
			$arr['']='ss';
		}
		
		for($i = 0; $i <= $min; $i++)
		{
			
			if (strlen($i) == 1)
			{
				$arr['0'.$i] = '0'.$i;
			}
			else
			{
				$arr[$i] = $i;
			}
		}
		
		$m_s_val = $arr;
		$options = $m_s_val;
	}
	return form_dropdown($name,$options,$selected,$class_id);
}

function provDropdown($selected=FALSE,$field_name=FALSE,$onChange=FALSE,$ena=FALSE)
{
	$ci=& get_instance();
	$ci->db->select('prov_id,prov_name');
	$row = $ci->db->get('tb_prov')->result_array();
		if($ena == 'disabled'):
			$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)' disabled>";
		else:
			$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)'>";
		endif;
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($row as $row):
		    	if($selected):
		    		if($row["prov_id"]==$selected):
						$output .= "<option value='".$row["prov_id"]."' selected='selected'>".$row['prov_name']."</option>";
					else:
						$output .= "<option value='".$row["prov_id"]."'>".$row['prov_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$row["prov_id"]."'>".$row['prov_name']."</option>";
		    	endif;
		    endforeach;
	    $output .= "</select>";
    return $output;
}

function kabDropdown($prov_id=FALSE,$selected=FALSE,$field_name=FALSE,$onChange=FALSE,$ena=FALSE)
{
	$ci=& get_instance();
	$ci->db->where('kab_prov_id',$prov_id);
	$kab = $ci->db->get('tb_kabupaten')->result_array();
	
	if($ena == 'disabled'):
		$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)' disabled>";
	else:
		$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)'>";
	endif;
	
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($kab as $kab):
		    	if($selected):
		    		if($kab["kab_id"]==$selected):
						$output .= "<option value='".$kab["kab_id"]."' selected='selected'>".$kab['kab_name']."</option>";
					else:
						$output .= "<option value='".$kab["kab_id"]."'>".$kab['kab_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$kab["kab_id"]."'>".$kab['kab_name']."</option>";
		    	endif;
		    endforeach;
	$output .= "</select>";
	return $output;
}
function kotkecDropDown($prov_id=FALSE,$kab_id=FALSE,$selected=FALSE,$field_name=FALSE,$ena=FALSE)
{
	$ci=& get_instance();
	$ci->db->where('kotkec_prov_id',$prov_id);
	$ci->db->where('kotkec_kab_id',$kab_id);
	$row = $ci->db->get('tb_kotkec')->result_array();
		if($ena == 'disabled'):
			$output = "<select id='$field_name' class='form-control' name='$field_name' disabled>";
		else:
			$output = "<select id='$field_name' class='form-control' name='$field_name'>";
		endif;
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($row as $row):
		    	if($selected):
		    		if($row["kotkec_id"]==$selected):
						$output .= "<option value='".$row["kotkec_id"]."' selected='selected'>".$row['kotkec_name']."</option>";
					else:
						$output .= "<option value='".$row["kotkec_id"]."'>".$row['kotkec_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$row["kotkec_id"]."'>".$row['kotkec_name']."</option>";
		    	endif;
		    endforeach;
	    $output .= "</select>";
    return $output;
}


function ruleDropdown($selected)
{
	$class_id = 'class="form-control"';
	$options = array(
				'Frontend' => 'Frontend',
                'Administrator' => 'Administrator'
			);
	return form_dropdown('user_role',$options,$selected,$class_id);
}



function alias($string)
{
	$ci=& get_instance();
	return strtolower(url_title($string));
}


function getOption($name=FALSE)
{
	$ci=& get_instance();
	$ci->load->database();

	$ci->db->select('op_name, op_val');
	$ci->db->where('op_name',$name);
	$ci->db->limit(1);
	$ret = $ci->db->get('tb_option')->row_array();

	$output = $ret['op_val'];
	return $output;
}

/**
* function makeslug
* digunakan untuk mereplace spasi ketika akan ditampilkan di url address
*/

function makeslug($string){
	$slug= strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));
	$slug = str_replace(" ", "-", $slug);
	return $slug;
}
/**
* function memformat harga
* digunakan membuat format rupiaah
*/

function formatHarga($n,$lengkap=FALSE) {
	// first strip any formatting;
	$n = (0+str_replace(",","",$n));

	// is this a number?
	if(!is_numeric($n)) return false;

	if($lengkap)$n = number_format($n,0,",",".");
	// now filter it;
	else if($n>1000000000000) $n= number_format(round(($n/1000000000000),0,",","."),1).' trilyun';
	else if($n>1000000000) $n= number_format(round(($n/1000000000),0,",","."),1).' milyar';
	else if($n>1000000) $n= number_format(round(($n/1000000),1),0,",",".").' juta';
	else if($n>1000) $n= number_format(round(($n/1000),1),0,",",".").' ribu';

	return "Rp ".$n ;
}

function FormatRupiah($angka){
	
	if($angka){
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;
	}else{
		return false;
	}

 
}

/*
Fungsi convert tanggal ke tanggalan indonesia
*/
function indDate($date,$type = FALSE) 
{
	if(!$type)
	{
		$arr_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	}
	elseif($type == 'short')
	{
		$arr_bulan = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
	}
	$arr_date = explode("-", $date);
	$arr_date[1] = intval($arr_date[1]);
	$arr_date[2] = intval($arr_date[2]);
	return $arr_date[2].' '.$arr_bulan[$arr_date[1] - 1].' '.$arr_date[0];
}

function MonthName($m_num,$type = FALSE)
{
	if(!$type)
	{
		$arr_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	}
	elseif($type == 'short')
	{
		$arr_bulan = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
	}
	$m_num	   = $m_num - 1;
	return $arr_bulan[$m_num];

}

function truncateString($str, $chars, $to_space, $replacement="...") {
   if($chars > strlen($str)) return $str;

   $str = substr($str, 0, $chars);
   $space_pos = strrpos($str, " ");
   if($to_space && $space_pos >= 0) 
       $str = substr($str, 0, strrpos($str, " "));

   return($str . $replacement);
}

function dateTimeSubct($dtm,$dtm_calc)
{
	$ref = new DateTime($dtm);
	$val = new DateTime($dtm_calc);
	$calc = $val->diff($ref);

	if($val < $ref)
	{
		$arr_dtm = array(
			'year' => $calc->y,
		 	'month' => $calc->m, 
		 	'days' => $calc->d, 
		 	'hours' => $calc->h,
		 	'minutes' => $calc->i,
		 	'seconds' => $calc->s);

		//echo $calc->d.' hari'.' '.$calc->h.' jam ' . $calc->i.' menit';
		return $arr_dtm;
	}
	else
	{
		return FALSE;
	}
		
}




function mysqlDateNow()
{
	$ci=& get_instance();
	$date_now = $ci->db->query("SELECT NOW() as date_now")->row();
	return $date_now->date_now;
}

/**
* function formatDate
* @uses mmemformat tanggal
*/
function formatDate($date, $format='name')
{
	$ci=& get_instance();

	if($format=='long'):
		$unix_date = human_to_unix($date);
		return date('l, jS F, Y - H:i:s',$unix_date);
	elseif($format=='medium1'):
		$unix_date = human_to_unix($date);
		return date('jS M, Y - H:i',$unix_date);
	elseif($format=='medium2'):
		$unix_date = human_to_unix($date);
		return date('jS F, Y',$unix_date);
	elseif($format=='short'):
		$unix_date = human_to_unix($date);
		return date('d-M-Y',$unix_date);
	elseif($format=='ampm'):
		$unix_date = human_to_unix($date);
		return date('d M Y g:ia',$unix_date);
	elseif($format=='short1'):
		$unix_date = human_to_unix($date);
		return date('d M Y - H:i:s',$unix_date);
	elseif($format=='rssdate'):
		$unix_date = human_to_unix($date);
		return date('D, j M Y H:i:s +0700',$unix_date);
	elseif($format=='sitemap_date'):
		$unix_date = human_to_unix($date);
		return date('Y-m-d',$unix_date);
	elseif($format=='admin_date'):
		$unix_date = human_to_unix($date);
		return date('d-M-Y',$unix_date);
	elseif($format=='time_only'):
		$unix_date = human_to_unix($date);
		return date('H:i:s',$unix_date);
	elseif($format=='date_only'):
		$unix_date = human_to_unix($date);
		return date('Y-m-d',$unix_date);
	elseif($format=='year_only'):
		$unix_date = human_to_unix($date);
		return date('Y',$unix_date);
	elseif($format=='month_only'):
		$unix_date = human_to_unix($date);
		return date('m',$unix_date);
	elseif($format=='year_month_only'):
		$unix_date = human_to_unix($date);
		return date('Y-m',$unix_date);
	elseif($format=='year_month_only_long'):
		$unix_date = human_to_unix($date);
		return date('M-Y',$unix_date);
	elseif($format=='timespan'):
		$unix_date = human_to_unix($date);
		return timespan($unix_date,now());
	else:
		return false;
	endif;

}
/**
* function crop image
* @uses croping gambar agar lebih kecil, 
* menggunaklan lib dari ci -> GD2
*/

function cropImage($image,$size,$filename,$ext,$filepath)
{
	$ci =& get_instance();

	$image_size = getimagesize($image);
	$image_width = $image_size['0'];
	$image_height = $image_size['1'];

	$config['image_library'] = 'gd2';
	$config['source_image'] = $image;
	$config['new_image'] = $filename.'_'.$size.'x'.$size.$ext;
	$config['maintain_ratio'] = FALSE;
	if($image_width > $image_height):
		$config['height'] = $image_height;
		$config['width'] = $image_height;
	elseif($image_width < $image_height):
		$config['height'] = $image_width;
		$config['width'] = $image_width;
	else:
		$config['height'] = $image_width;
		$config['width'] = $image_width;
	endif;

	if($image_width > $image_height):
		$config['x_axis'] = (5/100)*$image_width;
		$config['y_axis'] = '0';
	elseif($image_width < $image_height):
		$config['x_axis'] = '0';
		$config['y_axis'] = (5/100)*$image_height;
	else:
		$config['x_axis'] = (5/100)*$image_width;
		$config['y_axis'] = '0';
	endif;
	$ci->image_lib->initialize($config);
	$ci->image_lib->crop();

	$ci->image_lib->clear();

	$config2['image_library'] = 'gd2';
	$config2['source_image'] = $filepath.$config['new_image'];
	$config2['maintain_ratio'] = TRUE;
	$config2['height'] = $size;
	$config2['width'] = $size;

	$ci->image_lib->initialize($config2);
	$ci->image_lib->resize();

	return $filename.'_150x150'.$ext;

}

/**
* function resize
* @uses merubah atau mengganti ukuran gambar
* menggunaklan lib dari ci -> GD2
*/

function resizeImage($image,$width,$height,$filename,$ext,$filepath)
{
	
	$ci =& get_instance();

	$config['image_library'] = 'gd2';
	$config['source_image'] = $image;
	$config['new_image'] = $filename.'_'.$width.'x'.$height.$ext;
	$config['maintain_ratio'] = TRUE;
	$config['height'] = $height;
	$config['width'] = $width;

	$ci->image_lib->initialize($config);
	$ci->image_lib->resize();

	$image_size = getimagesize($filepath.$config['new_image']);
	$image_width = $image_size['0'];
	$image_height = $image_size['1'];
	rename($filepath.$config['new_image'],$filepath.$filename.'_'.$image_width.'x'.$image_height.$ext);
	return $filename.'_'.$image_width.'x'.$image_height.$ext;
	$ci->image_lib->clear();
}

function getPage($control=FALSE,$page=FALSE,$uri=FALSE,$count=FALSE)// fungsi buat halaman tetangga// uri-> buat ndetek row ke berapa yg di pilih
{
        $ci=& get_instance();
        if ($page == 'new') // jka insert
        {
                $div = $count/$ci->config->item('per_page');// tergantung sama pagination nya.. 
                $mod = $count % $ci->config->item('per_page');// cari halaman yg ga ganjil
                
                $x = explode('.',$div);
                $y = $x[0];
                $last_page = $y * $ci->config->item('per_page');
                $minus = $last_page - $ci->config->item('per_page');
                $last_page2 = $minus;
                
                if ($mod == '0'):
                redirect('backend/'.$control.'/index/'.$last_page2);
                elseif ($count >= $ci->config->item('per_page')):
                redirect('backend/'.$control.'/index/'.$last_page);
                else:
                redirect('backend/'.$control.'/');
                endif;
        }
        elseif ($page == 'edit') // jika edit
        {
                $p = $uri - 1;
                if ($p == 0):
                        $page = $uri;
                else:
                        $page = $p;
                endif;
                
                $div = $page/$ci->config->item('per_page');
                $mod = $page % $page/$ci->config->item('per_page');
                $x = explode('.',$div);
                $y = $x[0];
                
                $edit_page = $y * $ci->config->item('per_page');
                $edit_page2 = $edit_page - $ci->config->item('per_page');
                $plus = $edit_page +1;

                if ($page < $ci->config->item('per_page')):
                        redirect('backend/'.$control.'/');
                elseif ($page > $ci->config->item('per_page')):
                        redirect('backend/'.$control.'/index/'.$edit_page);
                elseif (($page == $plus) || $mod == 0 ):
                        redirect('backend/'.$control.'/index/'.$edit_page);
                endif;
        }
        elseif ($page == 'delete')// dan jika hapus
        {
                $p = $uri - 1;
                if ($p == 0):
                        $page = $uri;
                else:
                        $page = $p;
                endif;
                                        
                $div = $page/$ci->config->item('per_page');
                $mod = $page % $page/$ci->config->item('per_page');
                $x = explode('.',$div);
                $y = $x[0];
                                
                $edit_page = $y * $ci->config->item('per_page');
                $edit_page2 = $edit_page - $ci->config->item('per_page');
                $plus = $edit_page +1;

                if ($page < $ci->config->item('per_page') || $count == $ci->config->item('per_page')):
                        redirect('backend/'.$control.'/');
                elseif ($page >= $ci->config->item('per_page') ):
                        redirect('backend/'.$control.'/index/'.$edit_page);
                elseif ((($page + 1) == $plus) || $mod == 0 ):
                        redirect('backend/'.$control.'/index/'.$edit_page2);
                endif;
        }
}




