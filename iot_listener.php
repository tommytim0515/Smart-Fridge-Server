<?php
    $host = "45.76.101.197";
    $port = 4000;
    $temp = 0;
    set_time_limit(0);

    $sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket.\n");
    $result = socket_bind($sock, $host, $port) or die("Could not bind to socket.\n");

    $result = socket_listen($sock, 3) or die("Could not set up socket listener.\n");
    echo "Listening for connections\n";

    class communication_test
    {
        function readline()
        {
            return rtrim(fgets(STDIN));
        }
    }

    $accept = socket_accept($sock) or die("Could not accept incoming connection.\n");
    do
    {   
        // $accept = socket_accept($sock) or die("Could not accept incoming connection.\n");
        $msg = socket_read($accept, 1024) or die("Could not read input\n");

        $msg = trim($msg);

        echo "Received message: \t".$msg."\n";

        preg_match_all('!\d+!', $msg, $matches);
        $temp = $matches[0][0];
        echo "$temp\n\n";

        $line = new communication_test();
        echo "Enter Reply:\t";
        $reply = $line->readline();

        socket_write($accept, $reply, strlen($reply)) or die ("Could not write output\n");
    } while(true);

    socket_close($accept, $sock); 
    echo "Socket closed\n";
?>