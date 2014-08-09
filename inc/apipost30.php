<?php

define("BLOCK_SIZE",8192);
define("API_URL","https://smsgateapi.sluzba.cz/apipost30/sms");
define("AUTH_MSG_LENGTH",31);

class ApiPost30{
  private $recipient, $text, $login, $password, $smsgateapi_url, $params, $encoding;

  public function ApiPost30($login, $password, $encoding="UTF-8") {
    $this->login = $login;
    $this->password = $password;
    $this->encoding = $encoding;
    $this->params = Array();
  }

  public function send() {
    $handle = fopen($this->get_url(),'rb',false,$this->get_params());
    $contents = '';
    if (!$handle)
      return false;
    while (!feof($handle)) {
      $contents .= fread($handle, BLOCK_SIZE);
    }
    fclose($handle);
    echo $contents;
  }

  public function set_recipient($recipient) { $this->recipient = $recipient; }
  public function set_text($text) { $this->text = $text; }

  private function get_url() { return API_URL; }

  private function get_params() {
    $data = array ('login' => $this->login, 'act' => 'send', 'msisdn' => $this->recipient, 'msg'=>$this->text, 'auth'=>$this->get_auth());
    $data = http_build_query($data);
    $params = array('http' => array(
      'method' => 'POST',
      'content' => $data
    ));
    return stream_context_create($params);
  }

  private function get_auth() { return md5(md5($this->password).$this->login.'send'.substr($this->text,0,AUTH_MSG_LENGTH)); } 

}
?>
