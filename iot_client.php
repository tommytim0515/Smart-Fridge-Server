<html>
    <body>
        <div align='center'>
            <form method='POST'>
                <table>
                    <tr>
                        <td><label>Enter Message</label>
                            <input type='text' name='txtMessage'> 
                            <input type='submit' name='btnSend' = value = "Send">
                        </td>
                    </tr>
                    <?php
                        $host = "localhost";
                        $port = 4000;

                        if (isset($_POST['btnSend'])) {
                            $send_msg = $_REQUEST['txtMessage'];
                            $sock = socket_create(AF_INET, SOCK_STREAM, 0);
                            socket_connect($sock, $host, $port);

                            $send_msg = "qwertyuiop";
                            socket_write($sock, $send_msg, strlen($send_msg));

                            $reply = socket_read($sock, 1024);
                            $reply = trim($reply);
                            $reply = "server sent:\t".$reply;
                        }
                    ?>
                    <tr>
                        <td>
                            <textarea rows = '10' col = '30'><?php echo @$reply; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>