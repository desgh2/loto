<?php
namespace App\Classes;
use Illuminate\Http\Request;

class Api {

	public function __construct($aff_id, $api_key) {
		$this->api_key = $api_key;
		$this->api_version = '2.3';
		$this->lang = 'en';
		$this->logging = 1;
		$this->api_url = 'https://api.partnerlottery.com/v'.$this->api_version;

		$this->aff_id = $aff_id;
		$this->auth_key = $this->CreateSign();
		$this->params = array();
	}

	/**
	 * Obtaining a List of Available Lotteries
	 * 
	 * Examples:
	 * $api->ListLotteries();
	 *
	 * @return JSON string
	 */
	public function ListLotteries()
	{
		$this->url = $this->api_url.'/lotteries';

		return $this->run();
	}

	/**
	 * Obtaining Information About a Particular Lottery
	 * 
	 * Examples:
	 * $api->GetLottery(array("id"=>$id));
	 *
	 * @return JSON string
	 */
	public function GetLottery($params)
	{
		$this->url = $this->api_url.'/lottery';

		$this->params = array_merge($this->params,$params);

		return $this->run();
	}

	/**
	 * Obtaining the Latest Draw Results of All Lotteries
	 * 
	 * Examples:
	 * $api->ListResults();
	 *
	 * @return JSON string
	 */
	public function ListResults()
	{
		$this->url = $this->api_url.'/results';

		return $this->run();
	}

	/**
	 * Obtaining the Latest Draw Results of a Particular Lottery
	 * 
	 * Examples:
	 * $api->GetLottery(array("id"=>$id));
	 *
	 * @return JSON string
	 */
	public function GetResult($params)
	{
		$this->url = $this->api_url.'/result';

		$this->params = array_merge($this->params,$params);

		return $this->run();
	}

	/**
	 * Obtaining the Archive of Draw Results of a Particular Lottery
	 * 
	 * Examples:
	 * $api->ArchiveResults(array("id"=>1,"from"=>"20160901","to"=>"20160030"));
	 *
	 * @return JSON string
	 */
	public function ArchiveResults($params)
	{
		$this->url = $this->api_url.'/archive';

		$this->params = array_merge($this->params,$params);

		return $this->run();
	}

	/**
	 * Checking the Results of a Particular Lottery for the Specific Dates
	 * 
	 * Examples:
	 * $api->CheckResults(array(
	 *	 "id"=>1,
	 *	 "from"=>"20160901",
	 *	 "to"=>"20160030",
	 *	 "numbers"=>array(
	 *		 "basic"=>array(1,2,3,4,5),
	 *		 "power"=>array(6)
	 *	  )
	 *	));
	 *
	 * @return JSON string
	 */
	public function CheckResults($params)
	{
		$this->url = $this->api_url.'/check';

		$this->params = array_merge($this->params,$params);

		return $this->run();
	}

	/**
	 * User Registration
	 * 
	 * Examples:
	 * $api->SignUp(array(
	 *		"first_name"=>"John",
	 *		"last_name"=>"Johnson",
	 *		"gender"=>1,
	 *		"dob"=>19701019,
	 *		"email"=>"john@johnson.com",
	 *		"phone' => "1234567890",
	 *		"password' => "qwerty",
	 *		"ip" => "123.123.123.123",
	 *		"tid1" => "test1",
	 *		"tid2" => "test2",
	 *		"tid3" => "test3",
	 *		"tid4" => "test4")
	 * );
	 *
	 * @return JSON string
	 */
	public function SignUp($params)
	{
		$this->url = $this->api_url.'/register';

		$this->params = array_merge($this->params,$params);

		return $this->run();
	}

	/**
	 * Obtaining a List of Available Offers for specifoc lottery
	 * 
	 * Examples:
	 * $api->ListOffers(array("id"=>$id));
	 *
	 * @return JSON string
	 */
	public function ListOffers($params)
	{
		$this->url = $this->api_url.'/offers';

		$this->params = array_merge($this->params,$params);

		return $this->run();
	}

	/**
	 * Obtaining a List of Restricted Countries
	 * 
	 * Examples:
	 * $api->RestrictedCountries();
	 *
	 * @return JSON string
	 */
	public function RestrictedCountries(){
		$this->url = $this->api_url.'/countries';

		return $this->run();
	}

	/**
	 * Obtaining a List of Available Syndicates
	 * 
	 * Examples:
	 * $api->ListSyndicates();
	 *
	 * @return JSON string
	 */
	public function ListSyndicates()
	{
		$this->url = $this->api_url.'/syndicates';

		return $this->run();
	}

	/**
	 * Obtaining a List of Tickets in the Specific Syndicates
	 * 
	 * Examples:
	 * $api->GetSyndicateTickets(array("id"=>$id));
	 *
	 * @return JSON string
	 */
	public function GetSyndicateTickets($params)
	{
		$this->url = $this->api_url.'/syndicate_tickets';

		$this->params = array_merge($this->params,$params);

		return $this->run();
	}

	public function SetLang($lang)
	{
		$this->lang = $lang;
	}

	private function CreateSign()
	{
		return sha1($this->aff_id.$this->api_version.$this->api_key);
	}

	private function run()
	{
		try {
			$result = $this->cURL_request($this->url,$this->params);
		} catch(Exception $e) {
			$result = json_encode(array('response'=>'error','code'=>$e->getCode(),'data'=>$e->getMessage()));
		}

		return $this->result = $result;
	}

	private function cURL_request($url,$params = array())
	{
		if(empty($url)) return;

		$headers = array(
			"X-API-AFF: ".$this->aff_id,
			"X-API-KEY: ".$this->auth_key
		);

		$params['lang'] = $this->lang;
		$params['logging'] = $this->logging;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0);
		/*curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);*/
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		if(sizeof($params) > 0) curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		if(!$result = curl_exec($ch)) throw new Exception(curl_error($ch),2);

		curl_close($ch);

		return $result;
	}
}

?>