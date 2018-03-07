<?php
namespace Tools;

class Ftp
{
    private static $conn_id;

    public static function init($config)
    {
        $ftp_server     = $config['host'];
        $ftp_user       = $config['user'];
        $ftp_pass       = $config['pass'];
        self::$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");
        if (@ftp_login(self::$conn_id, $ftp_user, $ftp_pass)) {
            echo "Connected : $ftp_user@$ftp_server\n";
        } else {
            echo "unavailable  : $ftp_user\n";
        }
    }

    public static function get($localFile, $remoteFile = null)
    {
        return ftp_get(self::$conn_id, $localFile, $remoteFile, FTP_ASCII);
    }

    public static function put($localFile, $remoteFile = null)
    {

        return ftp_put(self::$conn_id, $remoteFile, $localFile, FTP_ASCII) ;
    }

    public static function listDir($path, $full = false)
    {
        return ftp_nlist(self::$conn_id, $path);
    }

    public static function close()
    {
        ftp_close(self::$conn_id);
    }
}
