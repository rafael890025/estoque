<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 28/05/2020
 */

//VERIFICA USUARIO LOGADO WINDOWS
 $cpd = array(
 'jonath189695',
 'cpd',
 'teste2',
 'teste3'
);
 

$headers = apache_request_headers();

if (!isset($headers['Authorization'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: NTLM');
    exit;
}

$auth = $headers['Authorization'];
if (substr($auth, 0, 5) == 'NTLM ') {
    $msg = base64_decode(substr($auth, 5));
    if (substr($msg, 0, 8) != "NTLMSSP\x00")
        die('erro header nao reconhecido');

    if ($msg[8] == "\x01") {
        $msg2 = "NTLMSSP\x00\x02" . "\x00\x00\x00\x00" . // target name len/alloc
            "\x00\x00\x00\x00" . // target name offset
            "\x01\x02\x81\x01" . // flags
            "\x00\x00\x00\x00\x00\x00\x00\x00" . // challenge
            "\x00\x00\x00\x00\x00\x00\x00\x00" . // context
            "\x00\x00\x00\x00\x30\x00\x00\x00"; // target info len/alloc/offset

        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: NTLM ' . trim(base64_encode($msg2)));
        exit;
    } else if ($msg[8] == "\x03") {
        function get_msg_str($msg, $start, $unicode = true)
        {
            $len = (ord($msg[$start + 1]) * 256) + ord($msg[$start]);
            $off = (ord($msg[$start + 5]) * 256) + ord($msg[$start + 4]);
            if ($unicode)
                return str_replace("\0", '', substr($msg, $off, $len));
            else
                return substr($msg, $off, $len);
        }

        $usuario = get_msg_str($msg, 36);
    }
}
?>