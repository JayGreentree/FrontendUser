<html>
    <body>
        <p><?=$options['content']?></p>
        <!-- empty line and comment only lines works as a linebreak with plain emails -->
        <p>Website: <?php echo wire('config')->httpHost; ?></p>

        <p>Username: <?=$options['username']?><br />
        Email address: <?=$options['email']?></p>
        
        <p>Validation token: <?=$options['token']?></p>

        <p>Link to a pre-filled form:<br />
        <?=$options['url']?></p>
    </body>
</html>
