<?php
if (isset($_POST['database_host']) && isset($_POST['database_name']) && isset($_POST['database_username']) && isset($_POST['database_password'])){
  $admin_user = $_POST['admin_username'];
  $admin_pass = bcrypt($_POST['admin_password']);
  $site_name = $_POST['site_name'];
  $site_description = $_POST['site_description'];

  $env = fopen(".env", "w") or die("Unable to open file!");
  $option = "APP_ENV=local\n";
  fwrite($env, $option);

  $option = "APP_DEBUG=true\n";
  fwrite($env, $option);

  $option = "APP_KEY=base64:nyXPc7dauBTHb7nm7h3ZV3O/s0B/cu+OARUKH2ht1fE=\n";
  fwrite($env, $option);

  $option = "APP_URL=http://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] . "\n";
  fwrite($env, $option);

  $option = "TMDB_API=\n";
  fwrite($env, $option);

  $option = "TMDB_LANG=\n";
  fwrite($env, $option);

  $option = "\n" . "DB_CONNECTION=mysql\n";
  fwrite($env, $option);

  $option = "DB_HOST=" . $_POST['database_host'] . "\n";
  fwrite($env, $option);

  $option = "DB_PORT=3306\n";
  fwrite($env, $option);

  $option = "DB_DATABASE=" . $_POST['database_name'] . "\n";
  fwrite($env, $option);

  $option = "DB_USERNAME=" . $_POST['database_username'] . "\n";
  fwrite($env, $option);

  $option = "DB_PASSWORD=" . $_POST['database_password'] . "\n";
  fwrite($env, $option);

  $option = "\n" . "CACHE_DRIVER=file\n";
  fwrite($env, $option);

  $option = "SESSION_DRIVER=file\n";
  fwrite($env, $option);

  $option = "QUEUE_DRIVER=sync\n";
  fwrite($env, $option);

  $option = "\n" . "REDIS_HOST=127.0.0.1\n";
  fwrite($env, $option);

  $option = "REDIS_PASSWORD=null\n";
  fwrite($env, $option);

  $option = "REDIS_PORT=6379\n";
  fwrite($env, $option);

  $option = "\n" . "MAIL_DRIVER=smtp\n";
  fwrite($env, $option);

  $option = "MAIL_HOST=smtp.gmail.com\n";
  fwrite($env, $option);

  $option = "MAIL_PORT=587\n";
  fwrite($env, $option);

  $option = "MAIL_USERNAME=**********@gmail.com\n";
  fwrite($env, $option);

  $option = "MAIL_PASSWORD=**********\n";
  fwrite($env, $option);

  $option = "MAIL_ENCRYPTION=tls\n";
  fwrite($env, $option);

  fclose($env);

$q="CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(82) NOT NULL,
  `password` varchar(160) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `image` varchar(355) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `social_id` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `email`, `image`, `is_admin`, `social_id`, `updated_at`, `created_at`) VALUES
(1, '$admin_user', '$admin_pass', '', '', '/public/assets/images/avatar.png', 1, '0', '2016-10-08 20:30:34', '2016-06-06 06:52:01');

CREATE TABLE IF NOT EXISTS `backdrops` (
  `backdrop_id` int(11) NOT NULL AUTO_INCREMENT,
  `movies_id` int(11) NOT NULL,
  `image` varchar(355) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`backdrop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `casts` (
  `cast_id` int(11) NOT NULL AUTO_INCREMENT,
  `movies_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `character_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cast_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` enum('movies','tv','news') NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`like_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 NOT NULL,
  `genres` varchar(255) CHARACTER SET latin1 NOT NULL,
  `overview` text CHARACTER SET latin1 NOT NULL,
  `director` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `writers` varchar(255) NOT NULL,
  `poster` varchar(255) CHARACTER SET latin1 NOT NULL,
  `runtime` varchar(4) CHARACTER SET latin1 NOT NULL,
  `release_date` date NOT NULL,
  `language` varchar(40) CHARACTER SET latin1 NOT NULL,
  `budget` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `trailer` varchar(255) CHARACTER SET latin1 NOT NULL,
  `imdb_rating` varchar(4) NOT NULL,
  `tmdb_id` int(11) NOT NULL,
  `type` enum('movies','tv') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `navigation` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `menu` enum('block','footer') NOT NULL,
  `sort` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `navigation` (`menu_id`, `title`, `slug`, `menu`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'main page', 'home', 'block', 0, '2016-10-06 20:43:42', '2016-10-06 20:43:42'),
(2, 'movies', 'movies', 'block', 0, '2016-10-06 09:44:49', '2016-10-06 20:44:21'),
(3, 'tv shows', 'movies?type=tv', 'block', 0, '2016-10-06 10:55:14', '2016-10-06 21:52:57'),
(4, 'celebrities', 'celebs', 'block', 0, '2016-10-06 21:55:56', '2016-10-06 21:55:56'),
(5, 'news box', 'news', 'block', 0, '2016-10-06 23:35:41', '2016-10-06 23:35:41'),
(6, 'contact', 'contact', 'block', 0, '2016-10-07 01:23:03', '2016-10-07 01:23:03'),
(7, 'Privacy Policy', 'page/privacy-policy', 'footer', 0, '2016-10-06 18:30:59', '2016-10-07 05:29:25');

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(355) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `persons` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `biography` text,
  `birth_date` varchar(14) DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `tmdb` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rate` (
  `rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` enum('movies','tv') NOT NULL,
  `type_id` int(11) NOT NULL,
  `stars` varchar(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_description` varchar(255) NOT NULL,
  `footer_text` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `tmdb_key` varchar(255) NOT NULL,
  `tmdb_language` varchar(255) NOT NULL,
  `offline` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`id`, `site_name`, `site_description`, `footer_text`, `contact_email`, `tmdb_key`, `tmdb_language`, `offline`, `created_at`, `updated_at`) VALUES
(1, '$site_name', '$site_description', 'Copyright © Movieman 2016', '', '', 'en', 0, '2016-10-08 06:12:12', '2016-10-08 17:12:12');

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `image` varchar(355) NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

";


  $db =  'mysql:host='.$_POST['database_host'].';dbname='.$_POST['database_name'];
  try {
    $db = new PDO($db, $_POST['database_username'], $_POST['database_password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $db->exec($q);
    function removeDirectory($path) {
  $files = glob($path . '/*');
  foreach ($files as $file) {
    is_dir($file) ? removeDirectory($file) : unlink($file);
  }
  rmdir($path);
  return;
}
removeDirectory('install_files');


  } catch(PDOException $e) {
    echo '<div style="text-align:center; padding-top: 10px;">'.$e->getMessage().'</div>';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>MovieMan - Installation</title>
   <link rel="stylesheet" href="install_files/style.css">
</head>
<body>
  <?php 
    if (!isset($_POST['database_host']) && !isset($_POST['database_name']) && !isset($_POST['database_username']) && !isset($_POST['database_password'])){
  ?>
  <div class="content">
    <div class="header">
      <h1 class="logo">MovieMan</h1>
      <h3>Installation</h3>
    </div>

    <div class="row">
      <div class="forms">
        <form action="http://<?php echo $url ?>" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
        <h1>Database</h1>
        <div class="form-group fg-2">
          <input type="text" name="database_host" class="input" placeholder="Host" required>
        </div>

        <div class="form-group fg-2">
          <input type="text" name="database_name" class="input" placeholder="Database name" required>
        </div>

        <div class="form-group fg-2">
          <input type="text" name="database_username" class="input" placeholder="Database username" required>
        </div>

        <div class="form-group fg-2">
          <input type="password" name="database_password" class="input" placeholder="Database password" required>
        </div>

        <br clear="all">

        <h1>Site</h1>
        <div class="form-group fg-2">
          <input type="text" name="site_name" class="input" placeholder="Site name" required>
        </div>

        <div class="form-group fg-2">
          <input type="text" name="site_description" class="input" placeholder="Site description" required>
        </div>

        <br clear="all">

        <h1>Admin</h1>
        <div class="form-group fg-2">
          <input type="text" name="admin_username" class="input" placeholder="Admin username" required>
        </div>

        <div class="form-group fg-2">
          <input type="password" name="admin_password" class="input" placeholder="Admin password" required>
        </div>

        <button class="button mt-m">complete movieman INSTALLATION</button>
      </div>
    </div>
  </div>

  <?php
    } else {
  ?>
  <div class="content" style="height: 200px;">
    <div class="header">
      <h1 class="logo">MovieMan</h1>
      <h3>Installation</h3>
    </div>

    <div class="row">
      <div class="forms">
        <a href="home" class="button mt-m" style="display: inline-block; text-decoration: none;text-align:center;line-height: 60px;">Go to site</a>
      </div>
    </div>
  </div>
  <?php
}
  ?>
</body>
</html>