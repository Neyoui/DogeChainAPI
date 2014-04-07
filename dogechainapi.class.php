<?php

/*
 * @ Class: DogeChainAPI
 * @ Description: A PHP Class for dogechain.info developer API
 * @ Last change: 07.04.2014
 *
 * @ Version: 1.0.0
 * @ Copyright: 2014 www.mr-anderson.org
 * @ License: http://creativecommons.org/licenses/by-sa/4.0/
 * @ Author: Markus Tressel <support@mr-anderson.org>
 *
 * @ Requirements: PHP 5.3 and greater
 *
 * @ Info: If you need some help, just contact me @ support@mr-anderson.org
 *
 * @ Updates: You can find updates under the following website: https://github.com/Neyoui/DogeChainAPI/
 * @ Feedback & Bugreport: If you want to give me feedback or you find a Bug, than just contact me via mail.
 *
 * @ Donate: Feel free to donate something.
 * @ Donate Address: D72cQfgoY5ToQqGwziLCtE984PvJ7RdXns (Dogecoin)
 * @ Donate Address: 1LfJiAkZnAc6gkRTaHSitm7xvkg1hMaNpZ (Bitcoin)
 * @ Donate Address: N6M1qUcVNaowiqdUArtxWjdjfTkHFBhNe4 (Namecoin)
 *
 */

/*
 * @ Documentation
 *
 * @ Installation:
 *
 *      1) Create a new DogeChainAPI Object.
 *          $DogeChainAPI = new DogeChainAPI();
 *
 * @ Useable functions:
 *
 *      $DogeChainAPI->get_transactions();
 *          Description: Returns the amount transactions of the last blocks.
 *          Require Args: none
 *          Optional Args: none
 *          Response: <array>
 *
 *      $DogeChainAPI->get_address_balance(dogecoin_address);
 *          Description: Returns amount ever received minus amount ever sent by a given address.
 *          Require Args: dogecoin_address
 *          Optional Args: none
 *          Response: <numeric>
 *          Example response: 284.98780993
 *
 *      $DogeChainAPI->address_to_hash(dogecoin_address);
 *          Description: Returns the public key hash encoded in an address.
 *          Require Args: dogecoin_address
 *          Optional Args: none
 *          Response: <string>
 *          Example response: C88429CD65CCFD625A469306EB13411E350EB5E5
 *
 *      $DogeChainAPI->check_address(dogecoin_address);
 *          Description: Checks an address for validity.
 *          Require Args: dogecoin_address
 *          Optional Args: none
 *          Response: <string>
 *          Example response: 1E (valid)
 *          Example response: CK (invalid)
 *
 *      $DogeChainAPI->decode_address(dogecoin_address);
 *          Description: Returns the version prefix and hash encoded in an address.
 *          Require Args: dogecoin_address
 *          Optional Args: none
 *          Response: <string>
 *          Example response: 1e:C88429CD65CCFD625A469306EB13411E350EB5E5
 *          Example response: INVALID(00:c88429cd65ccfd625a469306eb13411e350eb5e5)
 *
 *      $DogeChainAPI->get_block_count();
 *          Description: Returns the current block number.
 *          Require Args: none
 *          Optional Args: none
 *          Response: <numeric>
 *          Example response: 172309
 *
 *      $DogeChainAPI->get_difficulty();
 *          Description: Returns the last solved block's difficulty.
 *          Require Args: none
 *          Optional Args: none
 *          Response: <numeric>
 *          Example response: 1182.537
 *
 *      $DogeChainAPI->get_received_by_address(dogecoin_address);
 *          Description: Returns the amount ever received by a given address.
 *          Require Args: dogecoin_address
 *          Optional Args: none
 *          Response: <numeric>
 *          Example response: 59.05106473
 *
 *      $DogeChainAPI->get_sent_by_address(dogecoin_address);
 *          Description: Returns the amount ever sent from a given address.
 *          Require Args: dogecoin_address
 *          Optional Args: none
 *          Response: <numeric>
 *          Example response: 5.05106473
 *
 *      $DogeChainAPI->get_total_bc();
 *          Description: Returns the amount of currency ever mined.
 *          Require Args: none
 *          Optional Args: none
 *          Response: <numeric>
 *          Example response: 68004792422.68265533
 *
 *      $DogeChainAPI->hash_to_address(hash);
 *          Description: Returns the address with the given version prefix and hash.
 *          Require Args: dogecoin_address
 *          Optional Args: none
 *          Response: <string>
 *          Example response: DTnt7VZqR5ofHhAxZuDy4m3PhSjKFXpw3e
 *
 *      $DogeChainAPI->get_nethash(interval, start, stop);
 *          Description: Returns statistics about difficulty and network power.
 *          Require Args: none
 *          Optional Args: interval, start, stop
 *          Default Optional Args (if not set): INTERVAL=144, START=0, STOP=infinity
 *          Response: <array>
 *          Example response:
 *
 *          Array
 *             (
 *                 [0] => Array
 *                     (
 *                         [0] => 500 - blockNumber: height of last block in interval + 1
 *                         [1] => 1386475886 - time: block time in seconds since 0h00 1 Jan 1970 UTC
 *                         [2] => 6.9016410344989E+69 - target: decimal target at blockNumber
 *                         [3] => 6.9016706544111E+70 - avgTargetSinceLast: harmonic mean of target over interval
 *                         [4] => 0.003 - difficulty: difficulty at blockNumber
 *                         [5] => 16777472  - hashesToWin: expected number of hashes needed to solve a block at this difficulty
 *                         [6] => 301 - avgIntervalSinceLast: interval seconds divided by blocks
 *                         [7] => 5579 - netHashPerSecond: estimated network hash rate over interval
 *                     )
 *
 *                 [342] => Array
 *                     (
 *                         [0] => 171500
 *                         [1] => 1396828878
 *                         [2] => 2.6050505755502E+64
 *                         [3] => 2.3892007453603E+64
 *                         [4] => 1034.91
 *                         [5] => 4444907531703
 *                         [6] => 69
 *                         [7] => 70330547538
 *                    )
 *
 *                 [343] => Array
 *                    (
 *                         [0] => 172000
 *                         [1] => 1396861061
 *                         [2] => 2.045354682445E+64
 *                         [3] => 2.4010196574708E+64
 *                         [4] => 1318.106
 *                         [5] => 5661222976686
 *                         [6] => 65
 *                         [7] => 74924983050
 *                    )
 *              )
 *
 */

class DogeChainAPI {

    /* settings - do not touch them! */
    protected $SETTINGS_API_HOST    = "https://dogechain.info/";
    protected $SETTINGS_API_PATH    = "chain/Dogecoin/q/";


    /* server_request */
    private function server_request($request, $json = false) {

        $response = file_get_contents($this->SETTINGS_API_HOST.$this->SETTINGS_API_PATH.$request);

        if($json == true) {
            return json_decode($response, true);
        }

        return $response;

    }

    /* debug */
    private function debug($response, $pre = false) {
        if($pre == true) { echo "<pre>"; }
        print_r($response);
        if($pre == true) { echo "</pre>"; }
    }


    /* API */
    public function get_transactions() {

        $response = $this->server_request("transactions", true);
        return $response;

    }

    public function get_address_balance($dogecoin_address) {

        $response = $this->server_request("addressbalance/".$dogecoin_address);
        return $response;

    }

    public function address_to_hash($dogecoin_address) {

        $response = $this->server_request("addresstohash/".$dogecoin_address);
        return $response;

    }

    public function check_address($dogecoin_address) {

        $response = $this->server_request("checkaddress/".$dogecoin_address);
        return $response;

    }

    public function decode_address($dogecoin_address) {

        $response = $this->server_request("decode_address/".$dogecoin_address);
        return $response;

    }

    public function get_block_count() {

        $response = $this->server_request("getblockcount");
        return $response;

    }

    public function get_difficulty() {

        $response = $this->server_request("getdifficulty");
        return $response;

    }

    public function get_received_by_address($dogecoin_address) {

        $response = $this->server_request("getreceivedbyaddress/".$dogecoin_address);
        return $response;

    }

    public function get_sent_by_address($dogecoin_address) {

        $response = $this->server_request("getsentbyaddress/".$dogecoin_address);
        return $response;

    }

    public function get_total_bc() {

        $response = $this->server_request("totalbc");
        return $response;

    }

    public function hash_to_address($hash) {

        $response = $this->server_request("hashtoaddress/".$hash);
        return $response;

    }

    public function get_nethash($interval = 144, $start = 0, $stop = NULL) {

        $request_build = "nethash/".$interval."/".$start."/";

        if($stop != NULL) {
            $request_build .= "/".$stop;
        }

        $request_build .= "?format=json";

        $response = $this->server_request($request_build, true);
        return $response;

    }

}

?>
