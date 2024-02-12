<?php
    // path to text file
    $countFilePath = '/var/www/vhosts/furdle.us/httpdocs/game/php/player_count.txt';

    // open text file to read count
    $countFile  = fopen( $countFilePath, 'r' );
    $count = fgets( $countFile, 1000 );
    fclose( $countFile );

    // update count
    $count = abs( intval( $count ) ) + 1;

    // render count
    //echo $count;

    // open text file to write count
    $countFile = fopen( $countFilePath, 'w' );
    fwrite( $countFile, $count );

    // close updated text countFile
    fclose( $countFile );
    
?>