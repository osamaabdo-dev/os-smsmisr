<?php
class OS_SmsMisr {
	/**
	 * The username for the SMS Misr account.
	 *
	 * @var string
	 */
	private $username;

	/**
	 * The password for the SMS Misr account.
	 *
	 * @var string
	 */
	private $password;

	/**
	 * The sender ID for the SMS Misr account.
	 *
	 * @var string
	 */

	private $senderId;

	/**
	 * The environment => 1 For Live , 2 For Test
	 *
	 * @var string
	 */
	private $environment;

	/**
	 * The language => 1 for English, 2 for Arabic
	 *
	 * @var string
	 */
	private $language;

	/**
	 * Initializes the SmsMisr class.
	 *
	 * @param string $username The username for the SMS Misr account.
	 * @param string $password The password for the SMS Misr account.
	 * @param string $senderId The sender ID for the SMS Misr account.
	 */
	public function __construct($username, $password, $senderId, $environment, $language) {
		$this->username    = $username;
		$this->password    = $password;
		$this->senderId    = $senderId;
		$this->environment = $environment;
		$this->language    = $language;
	}

	/**
	 * Sends an SMS to the specified recipient with the given message.
	 *
	 * @param string $recipient The recipient's phone number.
	 * @param string $message The message to be sent.
	 *
	 * @return bool True if the SMS is sent successfully, False otherwise.
	 */
	public function send_sms($recipient, $message) {
		// Implement the logic to send the SMS here
		// For example, using the curl library to send a POST request
		$url = "https://smsmisr.com/api/SMS/";
		$data = array(
			"username"    => $this->username,
			"password"    => $this->password,
			"sender"   => $this->senderId,
			"mobile"      => $recipient,
			"message"     => $message,
			'environment' => $this->environment,
			'language'    => $this->language,
		);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

		$response = curl_exec($ch);
		if ( curl_errno( $ch ) ) {
			curl_close( $ch );
			return false;
		}
		curl_close($ch);

		$response_data = json_decode( $response, true );
		if ( isset( $response_data['code'] ) && $response_data['code'] == 1901 ) {
			return true;
		}else{
			return $response_data['Message'];
		}

	}
}
