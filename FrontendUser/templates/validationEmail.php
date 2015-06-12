<html>
    <body>
        <p><?=$options['content']?></p>
        <!-- empty line and comment only lines works as a linebreak with plain emails -->
        <p>Website: <strong><?php echo wire('config')->httpHost; ?></strong></p>

        <p>Username: <strong><?=$options['username']?></strong><br />
        Email address: <strong><?=$options['email']?></strong></p>
        
        <p>Validation token: <strong><?=$options['token']?></strong></p>

        <p>Link to a pre-filled form:<br />
        <strong><?=$options['url']?></strong></p>
    </body>
</html>
