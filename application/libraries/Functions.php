<?php
/**
 * Created by PhpStorm.
 * User: OliveTech
 * Date: 12/4/2017
 * Time: 10:08 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Functions {

    protected $CI;
    public function __construct()
    {
		$this->CI =& get_instance();
	}
	function apache_request_headers() {
        $arh = array();
		$rx_http = '/\AHTTP_/';
		$headers = $this->CI->input->request_headers();
		foreach ($_SERVER as $key => $val) {
            if (preg_match($rx_http, $key)) {
                $arh_key = preg_replace($rx_http, '', $key);
                $rx_matches = array();
                // do some nasty string manipulations to restore the original letter case
                // this should work in most cases
                $rx_matches = explode('_', $arh_key);
                if (count($rx_matches) > 0 and strlen($arh_key) > 2) {
                    foreach ($rx_matches as $ak_key => $ak_val)
                        $rx_matches[$ak_key] = ucfirst($ak_val);
                    $arh_key = implode('-', $rx_matches);
                }
                $arh[$arh_key] = $val;
            }
        }
        return ($arh);
    }
	public function generate_token($length = 8) {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		//length:36
		$final_rand = '';
		for ($i = 0; $i < $length; $i++) {
			$final_rand .= $chars[rand(0, strlen($chars) - 1)];
		}
		return $final_rand;
	}
	
	public function authentication() {
		// $headers = $this->apache_request_headers();
		$headers = $this->CI->input->request_headers();
		// print_r($headers);exit;
        if (isset($headers['Access-Token']) && isset($headers['Device-Id'])) :
			$this->CI->load->model('api_model');
			$focus_id = $this->CI->api_model->is_exist_email($headers['Access-Token'], $headers['Device-Id']);
			if ($focus_id != 0) :
				return $focus_id;
				// switch($info['status']) :
				// 	case 1 :
				// 		return $info['account_id'];
				// 		break;
				// 	case -1 :
				// 		echo json_encode(array('success' => 'false', 'error' => "Your account is blocked. Please contact us about this."));
				// 		exit ;
				// 		break;
				// 	case 0 :
				// 		echo json_encode(array('success' => 'false', 'error' => "Your account is not active yet. Please confirm your mailbox."));
				// 		exit ;
				// 		break;
				// endswitch;
			else :
				echo json_encode(array('success' => 'fail', 'message' => "You have invalid token. Please register again."));
				exit ;
			endif;
		else :
			echo json_encode(array('success' => 'fail', 'message' => "Access denied."));
			exit ;
		endif;
	}

	public function send_verification_email($email, $verification_code) {
		$subject = "Verification Code";
		$message = "<p>Thanks for your registering into Education App.</p>";
		$message .= "<p>Your verification code is</p>";
		$message .= "<h2>$verification_code</h2>";
		$config = Array(
			'protocol' => EMAIL_PROTOCOL,
			'smtp_host' => EMAIL_SMTP_HOST,
			'smtp_port' => EMAIL_SMTP_PORT,
			'smtp_user' => EMAIL_SMTP_USER,
			'smtp_pass' => EMAIL_SMTP_PASS,
			'charset'   => EMAIL_CHARSET,
			'wordwrap'=> EMAIL_WORDWRAP,
			'mailtype' => EMAIL_MAILTYPE
		);

		$config['newline']    = "\r\n";
		$this->CI->load->library('email', $config);

		$this->CI->email->to($email); // joseph.rouhana@ucmas.no
		$this->CI->email->bcc('info@ucmas.no,joseph.rouhana@ucmas.no');
		$this->CI->email->from(EMAIL_SERVER_FROM, "UCMAS Norge");
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);

		if($this->CI->email->send())
		{
			return true;
		}
		else
		{
			return false; //show_error($this->email->print_debugger());
		}
	}

    public function send_mail($email , $subject, $payload, $lang){

        extract($payload);
		$str_dob = $dob == "" ? "" : date('d-m-Y', strtotime($dob));

        $c_level = $courses['level_name'];
        $c_address = $courses['address'];
        $c_date_start = date('d.m.Y', $courses['date_start']);
        $c_date_end = date( 'd.m.Y',$courses['date_end']);
        $c_course_day = $courses['course_day'];
        $c_time_duration = $courses['time_duration'];

        $gender = "male";

            $to = EMAIL_SERVER; // .$email

            $message = "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0;\">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<base target=\"_blank\">
<style>
*{-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
a{word-break: break-all; text-decoration: none; color: inherit;}
body td img:hover {opacity:0.85;filter:alpha(opacity=85);}

body .ReadMsgBody
{width: 100%; background-color: #ffffff;}
body .ExternalClass
{width: 100%; background-color: #ffffff;}
body{width: 100%; height: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
html{ background-color:#ffffff; width: 100%;}

body img {user-drag: none; -moz-user-select: none; -webkit-user-drag: none;}
body .underline:hover {text-decoration: underline!important;}
body a.rotator img {-webkit-transition: all 1s ease-in-out;-moz-transition: all 1s ease-in-out; -o-transition: all 1s ease-in-out; -ms-transition: all 1s ease-in-out; }
body a.rotator img:hover { -webkit-transform: rotate(360deg); -moz-transform: rotate(360deg); -o-transform: rotate(360deg);-ms-transform: rotate(360deg); }
body .hover:hover {opacity:0.85;filter:alpha(opacity=85);}
body .jump:hover {opacity:0.75; filter:alpha(opacity=75); padding-top: 10px!important;}

body .headerScale img {width: 600px; height: auto;}
body .icon img {width: 35px; height: auto;}
body .btn125 img {width: 125px; height: auto;}
body .logoTop img {width: 100px; height: auto;}
body .voucherLogo img {width: 100px; height: auto;}
body .image img {width: 185px; height: auto;}
body .iconsImages img {width: 84px; height: auto;}
body .screenLeft img {width: 139px;}
body .screenRight img {width: 139px;}
body .imageMobile img {width: 292px;}
body .vidScale img {width: 512px;}
body p {margin : 0px;}
.voucher1 td{vertical-align:top;text-align:left;}

@media only screen and (max-width: 640px){
    body body{width:auto!important;}
    body table[class=full] {width: 100%; clear: both; }
    body table[class=mobile] {width: 100%; padding-left: 20px; padding-right: 20px; clear: both; }
    body table[class=fullCenter] {width: 100%; text-align: center!important; clear: both; }
    body td[class=fullCenter] {width: 100%; text-align: center!important; clear: both; }
    body td[class=textCenter] {width: 100%; text-align: center!important; clear: both; }
    body table[class=headerScale] {width: 100%!important; text-align: center!important; clear: both; }
    body .headerScale img {width: 100%!important; height: auto;}
    body table[class=vidScale] {width: 100%!important; text-align: center!important; clear: both; }
    body .vidScale img {width: 100%!important; height: auto;}
    body .erase {display: none;}
    body table[class=screenLeft] {padding-right: 6px;}
    body table[class=screenRight] {padding-left: 6px;}
    body table[class=w90] {width: 90%!important;}
    body table[class=icon] {width: 100%; text-align: center!important; clear: both; }
    body table[class=imageMobile] {width: 100%; text-align: center!important; clear: both;}
    body .imageMobile img {width: 292px!important;}
    body .voucher1 {width: 100%!important; border-left: none!important; text-align: center!important;}
    body .fullOne {background-color: #efefef; height: 1px!important;}
    body .h25 {height:25px!important;}
    body .w40 {width: 40px!important;}
    body .pad20 {padding-left: 20px!important; padding-right: 20px!important;}

}

@media only screen and (max-width: 479px){
    body body{width:auto!important;}
    body table[class=full] {width: 100%; clear: both; }
    body table[class=mobile] {width: 100%; padding-left: 20px; padding-right: 20px; clear: both; }
    body table[class=fullCenter] {width: 100%; text-align: center!important; clear: both; }
    body td[class=fullCenter] {width: 100%; text-align: center!important; clear: both; }
    body td[class=textCenter] {width: 100%; text-align: center!important; clear: both; }
    body table[class=headerScale] {width: 100%!important; text-align: center!important; clear: both; }
    body .headerScale img {width: 100%!important; height: auto;}
    body table[class=vidScale] {width: 100%!important; text-align: center!important; clear: both; }
    body .vidScale img {width: 100%!important; height: auto;}
    body .erase {display: none;}
    body .eraseMob {display: none;}
    body table[class=screenLeft] {padding-right: 6px;}
    body table[class=screenRight] {padding-left: 6px;}
    body .font20 {font-size: 20px!important; line-height: 30px!important;}
    body table[class=w90] {width: 90%!important;}
    body table[class=icon] {width: 100%; text-align: center!important; clear: both; }
    body table[class=imageMobile] {width: 100%; text-align: center!important; clear: both;}
    body .imageMobile img {width: 80%!important; height:auto!important;}
    body .voucher1 {width: 100%!important; border-left: none!important; text-align: center!important;}
    body .fullOne {background-color: #efefef; height: 1px!important;}
    body .h25 {height:25px!important;}
    body .w40 {width: 40px!important;}
    body .subscribe {padding-left: 5px!important; padding-right: 5px!important;}
    body .break {width: 100%!important; display: table-cell!important; margin:0; padding-bottom: 10px!important;}
    body .notifyBtn {-webkit-border-radius: 4px!important; -moz-border-radius: 4px!important; border-radius: 4px!important;}
    body .pad20 {padding-left: 20px!important; padding-right: 20px!important;}
}
</style>
</head>
<body style='margin: 0; padding: 0;'>

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tbody><tr>
					<td width=\"100%\" height=\"20\"></td>
				</tr>
				<tr>
					<td width=\"100%\" align=\"center\" class=\"logoTop\">
						<table width=\"240\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"fullCenter\">
							<tbody><tr>
								<td valign=\"middle\" width=\"100%\" style=\"text-align: center;\" class=\"fullCenter\" align=\"center\">
									<a href=\"#\" style=\"text-align: center;\"><img src=\"http://ucmas.no/assets/images/dev1/logo-white.png\" height=\"auto\" style=\"width: 260px; height: auto;\" alt=\"\" border=\"0\"></a>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td width=\"100%\" height=\"20\"></td>
				</tr>
			</tbody></table>
			
		</td>
	</tr>
</table>";
            if($lang == 'en'){
                $gender = "";
                if($is_register == "1"){
                    if($cgender == '1'){
                        $gender = 'Male';
                    }if($cgender == '2'){
                        $gender = 'Female';
                    }


                    $message .= "

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#f9f9f9\">
	<tbody><tr>
		<td align=\"center\" style=\"background-size: cover; background-position: center center;\">
			<div>		
			<!-- Start Header -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Headline + Text -->
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"headerScale\">
							<tbody><tr>
								<td height=\"80\" valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #333333;font-size: 26px; line-height: 34px; font-weight: 400;text-align:left;\" class=\"font20\">
									UCMAS Registration Confirmation
								</td>
							</tr>
							<tr>
								<td width=\"100%\" style=\"text-align: left;\">
									<p>Thank your for registering to UCMAS .</p>
									<p>We will come back to you soon with further information regarding the course.</p>
									<p>If you have any further questions, please do contact us by replying to this email.</p>
									<br/>
									<p>UCMAS Norway</p>
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"20\"></td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table>
			
			</div>
        
		</td>
	</tr>
</table>";
                }else{
                    $message .= "

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#f9f9f9\">
	<tbody><tr>
		<td align=\"center\" style=\"background-size: cover; background-position: center center;\">
			<div>		
			<!-- Start Header -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Headline + Text -->
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"headerScale\">
							<tbody><tr>
								<td height=\"80\" valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #333333;font-size: 26px; line-height: 34px; font-weight: 400;text-align:left;\" class=\"font20\">
									Thank you for getting in touch!
								</td>
							</tr>
							<tr>
								<td width=\"100%\" style=\"text-align: left;\">
									<p>We appreciate you contacting us. One of our colleagues will get back to you shortly.</p>
									<p>Have a great day!</p>
									<br/>
									<p>UCMAS Norway</p>
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"20\"></td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table>
			
			</div>
        
		</td>
	</tr>
</table>";
                }

                $message .= "
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
			</tbody></table>
		
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\">
			
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#f9f9f9\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; background-color: #f9f9f9;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\">
									
									<!-- Headline Voucher -->
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
										<tr>
											<td valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #777777;font-size: 22px; line-height: 36px; font-weight: 700;\" class=\"fullCenter\">
												Class Summary
											</td>
										</tr>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>Level :</b></td>
														<td>$c_level</td></tr>
													<tr>
														<td>
														   <b>Place :</b>
														</td>
														<td>
														   <p>$c_address</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Start Date :</b>
														</td>
														<td>
														   <p>$c_date_start</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>End Date : </b>
														</td>
														<td>
														   <p>$c_date_end</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Day : </b>
														</td>
														<td>
														   <p>$c_course_day</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Time : </b>
														</td>
														<td>
														   <p>$c_time_duration</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Price : </b>
														</td>
														<td>
														   <p>$course_fee</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"40\"></td>
							</tr>
						</tbody></table>
																	
					</td>
				</tr>
			</tbody></table><!-- End Voucher -->
			
		</td>
	</tr>
</table>";
                $message .= "
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\">
		
			<!-- Divider -->
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
				<tr>
					<td width=\"100%\" height=\"1\" bgcolor=\"#f1f1f1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
				</tr>
				<tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
			</tbody></table><!-- End Divider -->
			
		</td>
	</tr>
</tbody></table>


<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\">
			
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#f9f9f9\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; background-color: #f9f9f9;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\">
									
									<!-- Headline Voucher -->
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
										<tr>
											<td valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #777777;font-size: 22px; line-height: 36px; font-weight: 700;\" class=\"fullCenter\">
												Detail Information
											</td>
										</tr>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>Full Name</b></td>
														<td>$first_name</td></tr>
													<tr>
														<td>
														   <b>Address</b>
														</td>
														<td>
														   <p>$address</p>
														   <p>$post_code</p>
														   <p>$city</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Mobile  Number</b>
														</td>
														<td>
														   <p>$phone</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Email</b>
														</td>
														<td>
														   <p>$email</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\">
												
												<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-width: 0px 1px 0px 1px; border-style: solid; border-color: #f1f1f1;\" class=\"full\">
													<tbody><tr>
														<td width=\"100%\" valign=\"top\" style=\"font-size: 14px; color: #777777; text-align: center;line-height: 50px; vertical-align: top; padding-left: 20px; padding-right: 20px;  font-weight: 700;\" class=\"voucher1\">	
															Child's information
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>Child's Full Name</b></td>
														<td>$cfirst_name</td></tr>
													<tr>
														<td>
														   <b>Gender</b>
														</td>
														<td>
														   <p>$gender</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Date of Birth</b>
														</td>
														<td>
														   <p>$str_dob</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>School / Kindergarden</b>
														</td>
														<td>
														   <p>$cschool</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px;border-top-width: 0px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>How did you learn about us?</b></td>
														<td>$sel_hear</td></tr>
													<tr>
														<td>
														   <b>Comments</b>
														</td>
														<td>
														   <p>$comments</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"40\"></td>
							</tr>
						</tbody></table>
																	
					</td>
				</tr>
			</tbody></table>
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"60\">							
					</td>
				</tr>
			</tbody></table>
		
		</td>
	</tr>
</table>

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#f9f9f9\" style=\"background-color: #f9f9f9;\" class=\"full\">
	<tbody><tr>
		<td width=\"100%\" height=\"1\" bgcolor=\"#f1f1f1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
	</tr>
	<tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<!-- Start Subscribe Wrapper -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tbody><tr>
					<td width=\"100%\" height=\"50\"></td>
				</tr>
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Footer Logo + Text -->
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"fullCenter\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\">
							<tbody><tr>
								<td valign=\"middle\" width=\"100%\" style=\"text-align: center;\" class=\"fullCenter\">
									<img src=\"http://ucmas.no/assets/images/dev1/logo-white.png\" width=\"280\" height=\"auto\" style=\"width: 280px; height: auto;\" alt=\"\" border=\"0\">
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"5\"></td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"40\">									
								</td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table>
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"1\" bgcolor=\"#ffffff\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
				</tr>
			</tbody></table><!-- End Divider -->
			
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tbody><tr>
					<td width=\"100%\" height=\"12\"></td>
				</tr>
				<tr>
					<td width=\"100%\">
					
						<table width=\"135\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\" height=\"1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
							</tr>
						</tbody></table>
						
						<!-- Social Icons Left -->
						<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"icon\">
							<tbody><tr>
								<td width=\"100%\" style=\"text-align: center;\">
									<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody><tr>
											<td width=\"15\" class=\"w40\"></td>
											<td width=\"135\" style=\"text-align: center;\">
												<a href=\"https://www.facebook.com/ucmasnorge/\" style=\"text-decoration: none;\" target=\"_blank\">
													<img src=\"http://ucmas.no/assets/images/color-facebook-48.png\" alt=\"\" border=\"0\" width=\"30\" height=\"auto\" style=\"width: 30px; height: auto;\">
													<label style=\"vertical-align: top;line-height: 30px;font-size: 14px;\">Facebook Page</label>
												</a>
												
											</td>
											<td width=\"8\" class=\"w40\"></td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
						
						<table width=\"1\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\" height=\"10\">									
								</td>
							</tr>
						</tbody></table>
						
						<!-- Social Icons Right -->
						<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"icon\">
							<tbody><tr>
								<td width=\"100%\" style=\"text-align: center;\">
									<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody><tr>
											<td width=\"7\" class=\"w40\"></td>
											<td width=\"135\" style=\"text-align: center;\">
												<a href=\"http://ucmas.no\" style=\"text-decoration: none;\" target=\"_blank\">
													<img src=\"http://ucmas.no/assets/images/color-link-48.png\" alt=\"\" border=\"0\" width=\"30\" height=\"auto\" style=\"width: 30px; height: auto;\">
													<label style=\"vertical-align: top;line-height: 30px;font-size: 14px;\">ucmas.no</label>
												</a>
												
											</td>
											<td width=\"15\" class=\"w40\"></td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
						
						<table width=\"100\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"right\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\" height=\"1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table><!-- End Social Icons -->
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"12\">									
					</td>
				</tr>
			</tbody></table>
			
		</td>
	</tr>
</table>

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<!-- Start Footer Wrapper -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Copyright -->
						<table width=\"180\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"fullCenter\">
							<tbody><tr>
								<td height=\"60\" width=\"100%\" style=\"font-size: 12px; color: #777777; text-align: left; font-family: Helvetica, Arial, sans-serif, 'Open Sans'; line-height: 24px; vertical-align: middle; font-weight: 400;\" class=\"textCenter\">	
									Copyright © 2017
								</td>
							</tr>
						</tbody></table>
						
						<table width=\"370\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"right\" style=\"text-align: right; font-family: Helvetica, Arial, sans-serif, 'Open Sans'; font-size: 12px; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"fullCenter\">	
							<tbody><tr>
								<td width=\"25\" class=\"erase\"></td>
								<td height=\"60\" valign=\"middle\" style=\"\"></td>
								<td width=\"25\" class=\"erase\"></td>
								<td height=\"60\" valign=\"middle\" style=\"\"></td>
								<td height=\"60\" valign=\"middle\" style=\"color: #777777; font-weight: 400;\">
									info@ucmas.no
								</td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table><!-- End Footer -->
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\">									
					</td>
				</tr>
				<tr>
					<td width=\"100%\" height=\"1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
				</tr>
			</tbody></table>
			
		</td>
	</tr>
</tbody></table>
</body>
</html>";
            }else{  // language norway





                if($is_register == "1"){
                    $gender = "";
                    if($cgender == '1'){
                        $gender = 'Gutt';
                    }if($cgender == '2'){
                        $gender = 'Jenta';
                    }

                    $message .= "

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#f9f9f9\">
	<tbody><tr>
		<td align=\"center\" style=\"background-size: cover; background-position: center center;\">
			<div>		
			<!-- Start Header -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Headline + Text -->
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"headerScale\">
							<tbody><tr>
								<td height=\"80\" valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #333333;font-size: 26px; line-height: 34px; font-weight: 400;text-align:left;\" class=\"font20\">
									UCMAS Registreringsbekreftelse
								</td>
							</tr>
							<tr>
								<td width=\"100%\" style=\"text-align: left;\">
									<p>Takk for at du registrerte deg for UCMAS.</p>
									<p>Vi kommer snart tilbake med ytterligere informasjon om kurset.</p>
									<p>Hvis du har flere spørsmål, vennligst kontakt oss ved å svare på denne e-postadressen.</p>
									<br/>
									<p>UCMAS Norge</p>
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"20\"></td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table>
			
			</div>
        
		</td>
	</tr>
</table>";
                }else{
                    $message .= "

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#f9f9f9\">
	<tbody><tr>
		<td align=\"center\" style=\"background-size: cover; background-position: center center;\">
			<div>		
			<!-- Start Header -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Headline + Text -->
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"headerScale\">
							<tbody><tr>
								<td height=\"80\" valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #333333;font-size: 26px; line-height: 34px; font-weight: 400;text-align:left;\" class=\"font20\">
									Takk for at du kom i kontakt!
								</td>
							</tr>
							<tr>
								<td width=\"100%\" style=\"text-align: left;\">
									<p>Vi setter pris på at du kontakter oss. En av våre kolleger kommer snart tilbake til deg.</p>
									<p>Ha en flott dag!</p>
									<br/>
									<p>UCMAS Norge</p>
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"20\"></td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table>
			
			</div>
        
		</td>
	</tr>
</table>";
                }

                $message .= "
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
			</tbody></table>
		
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\">
			
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#f9f9f9\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; background-color: #f9f9f9;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\">
									
									<!-- Headline Voucher -->
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
										<tr>
											<td valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #777777;font-size: 22px; line-height: 36px; font-weight: 700;\" class=\"fullCenter\">
												Klassesammendrag
											</td>
										</tr>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>Nivå :</b></td>
														<td>$c_level</td></tr>
													<tr>
														<td>
														   <b>Plass :</b>
														</td>
														<td>
														   <p>$c_address</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Startdato :</b>
														</td>
														<td>
														   <p>$c_date_start</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Sluttdato : </b>
														</td>
														<td>
														   <p>$c_date_end</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Dag : </b>
														</td>
														<td>
														   <p>$c_course_day</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Tid : </b>
														</td>
														<td>
														   <p>$c_time_duration</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Pris : </b>
														</td>
														<td>
														   <p>$course_fee</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"40\"></td>
							</tr>
						</tbody></table>
																	
					</td>
				</tr>
			</tbody></table><!-- End Voucher -->
			
		</td>
	</tr>
</table>";
                $message .= "
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\">
		
			<!-- Divider -->
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
				<tr>
					<td width=\"100%\" height=\"1\" bgcolor=\"#f1f1f1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
				</tr>
				<tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
			</tbody></table><!-- End Divider -->
			
		</td>
	</tr>
</tbody></table>


<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\">
			
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#f9f9f9\" style=\"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; background-color: #f9f9f9;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\">
									
									<!-- Headline Voucher -->
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
										<tr>
											<td valign=\"middle\" width=\"100%\" style=\"text-align: center; color: #777777;font-size: 22px; line-height: 36px; font-weight: 700;\" class=\"fullCenter\">
												Detaljinformasjon
											</td>
										</tr>
										<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>Fullt Navn</b></td>
														<td>$first_name</td></tr>
													<tr>
														<td>
														   <b>Adresse</b>
														</td>
														<td>
														   <p>$address</p>
														   <p>$post_code</p>
														   <p>$city</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Mobilnummer</b>
														</td>
														<td>
														   <p>$phone</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>E-post</b>
														</td>
														<td>
														   <p>$email</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\">
												
												<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-width: 0px 1px 0px 1px; border-style: solid; border-color: #f1f1f1;\" class=\"full\">
													<tbody><tr>
														<td width=\"100%\" valign=\"top\" style=\"font-size: 14px; color: #777777; text-align: center;line-height: 50px; vertical-align: top; padding-left: 20px; padding-right: 20px;  font-weight: 700;\" class=\"voucher1\">	
															Barns informasjon
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>Barnets fulde navn</b></td>
														<td>$cfirst_name</td></tr>
													<tr>
														<td>
														   <b>Kjønn</b>
														</td>
														<td>
														   <p>$gender</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Fødselsdato</b>
														</td>
														<td>
														   <p>$str_dob</p>
														</td>
													</tr>
													<tr>
														<td>
														   <b>Skole / Barnehage</b>
														</td>
														<td>
														   <p>$cschool</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
									<table width=\"512\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-width: 1px;border-top-width: 0px; border-style: solid; border-color: #f1f1f1;\" class=\"fullCenter\">
										<tbody><tr>
											<td width=\"100%\" class=\"full\">
												<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 14px; color: #777777; text-align: left; line-height: 24px; vertical-align: top; padding-left: 20px; padding-right: 20px; line-height: 20px; font-weight: 400;\" class=\"voucher1\">
													<tbody>
													<tr><td width=\"40%\" height=\"20\"></td><td></td></tr>
													<tr>
														<td><b>Hvordan lærte du om oss?</b></td>
														<td>$sel_hear</td></tr>
													<tr>
														<td>
														   <b>Kommentarer</b>
														</td>
														<td>
														   <p>$comments</p>
														</td>
													</tr>
													<tr>
														<td height=\"20\"></td><td></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
									
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"40\"></td>
							</tr>
						</tbody></table>
																	
					</td>
				</tr>
			</tbody></table>
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"60\">							
					</td>
				</tr>
			</tbody></table>
		
		</td>
	</tr>
</table>

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#f9f9f9\" style=\"background-color: #f9f9f9;\" class=\"full\">
	<tbody><tr>
		<td width=\"100%\" height=\"1\" bgcolor=\"#f1f1f1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
	</tr>
	<tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<!-- Start Subscribe Wrapper -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tbody><tr>
					<td width=\"100%\" height=\"50\"></td>
				</tr>
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Footer Logo + Text -->
						<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"fullCenter\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\">
							<tbody><tr>
								<td valign=\"middle\" width=\"100%\" style=\"text-align: center;\" class=\"fullCenter\">
									<img src=\"http://ucmas.no/assets/images/dev1/logo-white.png\" width=\"280\" height=\"auto\" style=\"width: 280px; height: auto;\" alt=\"\" border=\"0\">
								</td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"5\"></td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"40\">									
								</td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table>
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"1\" bgcolor=\"#ffffff\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
				</tr>
			</tbody></table><!-- End Divider -->
			
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tbody><tr>
					<td width=\"100%\" height=\"12\"></td>
				</tr>
				<tr>
					<td width=\"100%\">
					
						<table width=\"135\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\" height=\"1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
							</tr>
						</tbody></table>
						
						<!-- Social Icons Left -->
						<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"icon\">
							<tbody><tr>
								<td width=\"100%\" style=\"text-align: center;\">
									<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody><tr>
											<td width=\"15\" class=\"w40\"></td>
											<td width=\"135\" style=\"text-align: center;\">
												<a href=\"https://www.facebook.com/ucmasnorge/\" style=\"text-decoration: none;\" target=\"_blank\">
													<img src=\"http://ucmas.no/assets/images/color-facebook-48.png\" alt=\"\" border=\"0\" width=\"30\" height=\"auto\" style=\"width: 30px; height: auto;\">
													<label style=\"vertical-align: top;line-height: 30px;font-size: 14px;\">Facebook-side</label>
												</a>
												
											</td>
											<td width=\"8\" class=\"w40\"></td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
						
						<table width=\"1\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\" height=\"10\">									
								</td>
							</tr>
						</tbody></table>
						
						<!-- Social Icons Right -->
						<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"icon\">
							<tbody><tr>
								<td width=\"100%\" style=\"text-align: center;\">
									<table width=\"174\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
										<tbody><tr>
											<td width=\"7\" class=\"w40\"></td>
											<td width=\"135\" style=\"text-align: center;\">
												<a href=\"http://ucmas.no\" style=\"text-decoration: none;\" target=\"_blank\">
													<img src=\"http://ucmas.no/assets/images/color-link-48.png\" alt=\"\" border=\"0\" width=\"30\" height=\"auto\" style=\"width: 30px; height: auto;\">
													<label style=\"vertical-align: top;line-height: 30px;font-size: 14px;\">ucmas.no</label>
												</a>
												
											</td>
											<td width=\"15\" class=\"w40\"></td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
						
						<table width=\"100\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"right\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"full\">
							<tbody><tr>
								<td width=\"100%\" height=\"1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>
			</tbody></table><!-- End Social Icons -->
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"12\">									
					</td>
				</tr>
			</tbody></table>
			
		</td>
	</tr>
</table>

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\" bgcolor=\"#ffffff\">
	<tbody><tr>
		<td width=\"100%\" valign=\"top\" align=\"center\">
		
			<!-- Start Footer Wrapper -->
			<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"mobile\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\"></td>
				</tr>
				<tr>
					<td width=\"100%\" align=\"center\">
						
						<!-- Copyright -->
						<table width=\"180\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"fullCenter\">
							<tbody><tr>
								<td height=\"60\" width=\"100%\" style=\"font-size: 12px; color: #777777; text-align: left; font-family: Helvetica, Arial, sans-serif, 'Open Sans'; line-height: 24px; vertical-align: middle; font-weight: 400;\" class=\"textCenter\">	
									2017 © UCMAS
								</td>
							</tr>
						</tbody></table>
						
						<table width=\"370\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"right\" style=\"text-align: right; font-family: Helvetica, Arial, sans-serif, 'Open Sans'; font-size: 12px; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"fullCenter\">	
							<tbody><tr>
								<td width=\"25\" class=\"erase\"></td>
								<td height=\"60\" valign=\"middle\" style=\"\"></td>
								<td width=\"25\" class=\"erase\"></td>
								<td height=\"60\" valign=\"middle\" style=\"\"></td>
								<td height=\"60\" valign=\"middle\" style=\"color: #777777; font-weight: 400;\">
									info@ucmas.no
								</td>
							</tr>
						</tbody></table>
														
					</td>
				</tr>   
			</tbody></table><!-- End Footer -->
			
			<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" class=\"full\">
				<tbody><tr>
					<td width=\"100%\" height=\"30\">									
					</td>
				</tr>
				<tr>
					<td width=\"100%\" height=\"1\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>
				</tr>
			</tbody></table>
			
		</td>
	</tr>
</tbody></table>
</body>
</html>";

            }

//            echo $message;exit;

           	
            $config = Array(
                'protocol' => EMAIL_PROTOCOL,
                'smtp_host' => EMAIL_SMTP_HOST,
                'smtp_port' => EMAIL_SMTP_PORT,
                'smtp_user' => EMAIL_SMTP_USER,
                'smtp_pass' => EMAIL_SMTP_PASS,
                'charset'   => EMAIL_CHARSET,
                'wordwrap'=> EMAIL_WORDWRAP,
                'mailtype' => EMAIL_MAILTYPE
            );

            $config['newline']    = "\r\n";
            $this->CI->load->library('email', $config);

            $this->CI->email->to($email); // joseph.rouhana@ucmas.no
            $this->CI->email->bcc('info@ucmas.no,joseph.rouhana@ucmas.no');
            $this->CI->email->from(EMAIL_SERVER_FROM, "UCMAS Norge");
            $this->CI->email->subject($subject);
            $this->CI->email->message($message);

            if($this->CI->email->send())
            {
                return true;
            }
            else
            {
                return false; //show_error($this->email->print_debugger());
			}
			
			/*
			 // Always set content-type when sending HTML email
			 $headers = "MIME-Version: 1.0" . "\r\n";
			 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			 $headers .= "From: <".EMAIL_SERVER_FROM.">";
			 $headers .= "Cc: ".EMAIL_SERVER_FROM."\r\n";
			 $headers .= "Reply-To: info@ucmas.no\r\n";
			 $headers .= "Bcc: info@ucmas.no\r\n";

            $message = "$message";

            if(mail($to, $subject, $message, $headers)){
                return true;
            }else{
                return false;
			}
			*/
            

    }

}