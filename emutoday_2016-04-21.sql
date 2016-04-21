# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.10)
# Database: emutoday
# Generation Time: 2016-04-21 20:21:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1),
	('2016_02_25_191921_create_pages_table',2),
	('2016_02_29_195732_alter_pages_add_template_column',3),
	('2016_02_29_210849_alter_pages_add_order_columns',4),
	('2016_02_29_214827_create_posts_table',5),
	('2016_03_01_215159_alter_users_add_last_login_at_column',6),
	('2016_03_02_213828_alter_pages_add_hidden_column',7),
	('2016_03_03_151526_alter_pages_add_hidden_column2',8),
	('2016_03_03_174426_create_storys_table',9),
	('2016_03_03_195813_rename_col_in_storys_table',10),
	('2016_03_04_175120_create_story_images_table',11),
	('2016_03_09_180146_remove_mobile_cols_from_story_images_table',12),
	('2016_03_09_203150_add_filename_col_to_story_images_table',13),
	('2016_03_15_175133_add_col_storytype_to_table',14),
	('2016_03_15_175551_rename_col_body_to_content_in_table',15),
	('2016_03_16_145107_add_col_story_image_type_to_table',16),
	('2016_03_21_150924_change_unique_id_story_images',17),
	('2016_03_30_202018_create_tags_table',17),
	('2016_03_30_205755_create_story_type_table',18),
	('2016_03_30_212803_rename_story_types_table',19),
	('2016_04_01_203751_change_storys_table_0401',20),
	('2016_04_01_204609_alter_story_image_table_to_cascade',21),
	('2016_04_06_200151_add_col_level_to_table_story_types',22),
	('2016_04_06_220418_make_some_cols_nullable_storys',23),
	('2016_04_06_220752_change_content_back_to_text_storys',24),
	('2016_04_08_210620_drop_old_pages_table',25),
	('2016_04_08_211136_create_pages_table',26),
	('2016_04_08_214224_create_pivot_table_page_story',27),
	('2016_04_12_222628_add_col_to_pages_table_user_id',28);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table page_story
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_story`;

CREATE TABLE `page_story` (
  `page_id` int(10) unsigned NOT NULL,
  `story_id` int(10) unsigned NOT NULL,
  `page_position` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `page_story_page_id_index` (`page_id`),
  KEY `page_story_story_id_index` (`story_id`),
  CONSTRAINT `page_story_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `page_story_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `storys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `page_story` WRITE;
/*!40000 ALTER TABLE `page_story` DISABLE KEYS */;

INSERT INTO `page_story` (`page_id`, `story_id`, `page_position`, `note`, `created_at`, `updated_at`)
VALUES
	(8,40,0,'some notes','2016-04-15 22:14:36','2016-04-15 22:15:20'),
	(8,41,1,'some notes','2016-04-15 22:14:36','2016-04-15 22:15:20'),
	(8,42,2,'some notes','2016-04-15 22:15:20','2016-04-15 22:15:20'),
	(8,43,3,'some notes','2016-04-15 22:15:20','2016-04-15 22:15:20'),
	(8,44,4,'some notes','2016-04-15 22:15:20','2016-04-15 22:15:20'),
	(10,39,0,'some notes','2016-04-18 19:13:24','2016-04-19 20:16:52'),
	(10,58,1,'some notes','2016-04-18 19:13:24','2016-04-19 20:16:52'),
	(10,61,2,'some notes','2016-04-18 19:13:24','2016-04-19 20:16:52'),
	(10,47,3,'some notes','2016-04-18 19:13:24','2016-04-19 20:16:52'),
	(10,44,4,'some notes','2016-04-18 19:13:24','2016-04-19 20:16:52');

/*!40000 ALTER TABLE `page_story` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `template`, `uri`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`, `user_id`)
VALUES
	(8,'EMU Today Home','f','2016-04-14 02:15:00','2016-04-21 01:15:00',1,'2016-04-14 21:52:23','2016-04-14 21:52:23',1),
	(9,'EMU Today Home','index','2016-04-15 10:15:00','2016-04-22 02:10:00',1,'2016-04-15 15:02:30','2016-04-15 15:02:30',1),
	(10,'EMU Today Home','index','2016-05-17 02:10:00','2016-06-01 00:00:00',1,'2016-04-18 19:13:08','2016-04-18 19:13:08',1);

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;

INSERT INTO `password_resets` (`email`, `token`, `created_at`)
VALUES
	('bill@sundaysim.app','863f39bd2c9785ef02adca2a9fd133f76cb5217e5213f20a765c1425cc06e0d9','2016-02-26 19:03:41');

/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8_unicode_ci NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `author_id`, `title`, `slug`, `body`, `excerpt`, `published_at`, `created_at`, `updated_at`)
VALUES
	(1,1,'Example Post 1','example-post-1','This is an example post.','','2016-02-29 21:57:01',NULL,NULL),
	(2,2,'Example Post 2','example-post-2','This is an example post.','Hi my name is','2016-03-14 21:57:01',NULL,'2016-03-01 21:30:47'),
	(3,1,'Example Post 3','example-post-3','This is an example post.','> some random quote.',NULL,NULL,'2016-03-01 21:08:08');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table story_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `story_images`;

CREATE TABLE `story_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `story_id` int(10) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teaser` text COLLATE utf8_unicode_ci NOT NULL,
  `moretext` text COLLATE utf8_unicode_ci NOT NULL,
  `image_extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `story_images_story_id_foreign` (`story_id`),
  CONSTRAINT `story_images_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `storys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `story_images` WRITE;
/*!40000 ALTER TABLE `story_images` DISABLE KEYS */;

INSERT INTO `story_images` (`id`, `story_id`, `is_active`, `image_name`, `image_path`, `caption`, `teaser`, `moretext`, `image_extension`, `created_at`, `updated_at`, `filename`, `image_type`)
VALUES
	(61,39,1,'img39_small','/imgs/story/','Story Promoted 0 small image caption','Story Promoted 0 Teaser small image ','READ MORE','jpg','2016-04-01 21:06:55','2016-04-01 21:10:53','img39_small.jpg','imagesmall'),
	(62,39,1,'img39_main','/imgs/story/','Story Promoted 0 large image caption','Story Promoted 0 large image teaser','More','jpg','2016-04-01 21:06:55','2016-04-01 21:11:41','img39_main.jpg','imagemain'),
	(63,40,1,'img40_small','/imgs/story/','Story Promoted 1 small image caption','Teaser for Story Promoted 1 small image','More','jpg','2016-04-01 21:13:11','2016-04-01 21:13:58','img40_small.jpg','imagesmall'),
	(64,40,1,'img40_main','/imgs/story/','Caption for story promoted 1 large asset','Teaser for story promoted 1 large asset','More','jpg','2016-04-01 21:13:11','2016-04-01 21:14:52','img40_main.jpg','imagemain'),
	(65,41,1,'img41_small','/imgs/story/','This is a Koala','This is a teaser for the small koala picture','More','jpg','2016-04-01 21:16:17','2016-04-01 21:17:00','img41_small.jpg','imagesmall'),
	(66,41,1,'img41_main','/imgs/story/','This is a caption for the large image of a koala','This is a teaser for the large koala picture','More','jpg','2016-04-01 21:16:17','2016-04-01 21:17:32','img41_main.jpg','imagemain'),
	(67,42,1,'img42_small','/imgs/story/','This is a caption for a small image of octopus','One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.','Read More','jpg','2016-04-01 21:18:47','2016-04-01 21:19:33','img42_small.jpg','imagesmall'),
	(68,42,1,'img42_main','/imgs/story/','Octopus large image caption','He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. ','More','jpg','2016-04-01 21:18:47','2016-04-01 21:20:07','img42_main.jpg','imagemain'),
	(69,43,1,'img43_small','/imgs/story/','Caption for the wolves small photo','Quick, Baz, get my woven flax jodhpurs! \"Now fax quiz Jack!\" my brave ghost pled.','MORE','jpg','2016-04-01 21:20:56','2016-04-01 21:21:30','img43_small.jpg','imagesmall'),
	(70,43,1,'img43_main','/imgs/story/','Caption for the wolves large photo','The jay, pig, fox, zebra, and my wolves quack! Blowzy red vixens fight for a quick jump. Joaquin Phoenix was gazed by MTV for luck','More','jpg','2016-04-01 21:20:56','2016-04-01 21:22:04','img43_main.jpg','imagemain'),
	(71,44,1,'img44_small','/imgs/story/','Caption for story student profile 0 small asset','Teaser for story student profile 0 small asset\r\n','More','jpg','2016-04-01 21:23:12','2016-04-01 21:24:32','img44_small.jpg','imagesmall'),
	(72,44,1,'img44_main','/imgs/story/','Caption for story student profile 0 large asset','Teaser for story student profile 0 large asset','More','jpg','2016-04-01 21:23:12','2016-04-01 21:24:58','img44_main.jpg','imagemain'),
	(73,45,1,'img45_small','/imgs/story/','Caption for story student profile 1 small asset','Teaser for story student profile 1 small asset\r\n','More','jpg','2016-04-01 21:26:40','2016-04-01 21:27:13','img45_small.jpg','imagesmall'),
	(74,45,1,'img45_main','/imgs/story/','Caption for story student profile 1 large asset','Teaser for story student profile 1 large asset','More','jpg','2016-04-01 21:26:40','2016-04-01 21:27:37','img45_main.jpg','imagemain'),
	(75,46,1,'img46_small','/imgs/story/','Caption for story student profile 2 small asset','Teaser for story student profile 2 small asset\r\n','More','jpg','2016-04-01 21:29:09','2016-04-01 21:29:37','img46_small.jpg','imagesmall'),
	(76,46,1,'img46_main','/imgs/story/','Caption for story student profile 2 large asset','Caption for story student profile 2 large asset\r\n','More','jpg','2016-04-01 21:29:09','2016-04-01 21:30:09','img46_main.jpg','imagemain'),
	(77,47,1,'img47_small','/imgs/story/','Caption for story student profile 3 small asset','Teaser for story student profile 3 small asset\r\n','More','jpg','2016-04-01 21:31:13','2016-04-01 21:31:38','img47_small.jpg','imagesmall'),
	(78,47,1,'img47_main','/imgs/story/','Caption for story student profile 3 large asset','Teaser for story student profile 3 large asset\r\n','MORE','jpg','2016-04-01 21:31:13','2016-04-01 21:32:04','img47_main.jpg','imagemain'),
	(79,48,1,'img48_small','/imgs/story/','Caption for story student profile 4 small asset','Teaser for story student profile 4 small asset\r\n','MORE','jpg','2016-04-01 21:33:01','2016-04-01 21:33:22','img48_small.jpg','imagesmall'),
	(80,48,1,'img48_main','/imgs/story/','Caption for story student profile 4 large asset','Teaser for story student profile 4 large asset','MORE','jpg','2016-04-01 21:33:01','2016-04-01 21:33:46','img48_main.jpg','imagemain'),
	(93,61,1,'img61_small','/imgs/story/','The athletic dept','text for teaser','More Sports','jpg','2016-04-07 18:06:36','2016-04-07 18:12:54','img61_small.jpg','imagesmall'),
	(94,39,1,'img39_hero','/imgs/story/','This is the hero or featured image for the emutoday home page','Tease is the way to give a small but attention grabbing statement, in order to get the reader to continue to the full article and read it.','Continue','jpg','2016-04-11 17:09:55','2016-04-11 17:12:02','img39_hero.jpg','imagehero'),
	(99,40,1,'img40_hero','/imgs/story/','The caption for the story promoted 1 hero ','The teaser for the story promoted 1 hero teaser','MORE','jpg','2016-04-11 19:25:12','2016-04-11 19:26:05','img40_hero.jpg','imagehero');

/*!40000 ALTER TABLE `story_images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table story_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `story_tag`;

CREATE TABLE `story_tag` (
  `story_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `story_tag_story_id_index` (`story_id`),
  KEY `story_tag_tag_id_index` (`tag_id`),
  CONSTRAINT `story_tag_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `storys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `story_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table story_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `story_types`;

CREATE TABLE `story_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `story_types` WRITE;
/*!40000 ALTER TABLE `story_types` DISABLE KEYS */;

INSERT INTO `story_types` (`id`, `name`, `shortname`, `created_at`, `updated_at`, `level`)
VALUES
	(1,'News Story','storybasic',NULL,NULL,0),
	(2,'Promoted Story','storypromoted',NULL,NULL,1),
	(3,'Student Profile','storystudent',NULL,NULL,1),
	(4,'Magazine Story','storymagazine',NULL,NULL,1),
	(5,'External Story','storyexternal',NULL,NULL,0);

/*!40000 ALTER TABLE `story_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table storys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `storys`;

CREATE TABLE `storys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teaser` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `story_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `is_live` tinyint(1) NOT NULL,
  `publish_start` datetime NOT NULL,
  `publish_end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `storys` WRITE;
/*!40000 ALTER TABLE `storys` DISABLE KEYS */;

INSERT INTO `storys` (`id`, `author_id`, `title`, `slug`, `subtitle`, `teaser`, `content`, `created_at`, `updated_at`, `story_type`, `is_featured`, `is_live`, `publish_start`, `publish_end`)
VALUES
	(39,1,'Title of Story Promoted 0','title-of-story-promoted-0','The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ','<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam</p>\r\n','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu','2016-04-01 21:06:55','2016-04-15 15:27:11','storypromoted',1,0,'0000-00-00 00:00:00',NULL),
	(40,1,'Title Story Promoted 1 Dance','title-story-promoted-1-dance','The quick, promoted fox jumps over a lazy story. DJs flock by when 1 ','<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was</p>\r\n','<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so ha','2016-04-01 21:13:11','2016-04-11 19:26:05','storypromoted',1,0,'0000-00-00 00:00:00',NULL),
	(41,1,'Story Promoted 2 About a Koala','story-promoted-2-about-a-koala','This is a subtitle for promoted story 2 about a koala','<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>\r\n','<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of se','2016-04-01 21:16:17','2016-04-11 17:47:42','storypromoted',0,0,'0000-00-00 00:00:00',NULL),
	(42,1,'This Octopus is Story Promoted 3','this-octopus-is-story-promoted-3','The subtitle for the octopus stpry','<p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, lito</p>\r\n','<p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos direct','2016-04-01 21:18:47','2016-04-01 21:20:07','storypromoted',0,0,'0000-00-00 00:00:00',NULL),
	(43,1,'The Wolves of Promoted Story 4','the-wolves-of-promoted-story-4','The subtitle for the wolves story','<p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps.</p>\r\n','<p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy ve','2016-04-01 21:20:56','2016-04-01 21:22:04','storypromoted',0,0,'0000-00-00 00:00:00',NULL),
	(44,1,'Student Profile Title 0 Dancer','student-profile-title-0-dancer','Subtitle for the story on the student dancer','<p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>\r\n','<p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra q','2016-04-01 21:23:12','2016-04-01 21:24:58','storystudent',0,0,'0000-00-00 00:00:00',NULL),
	(45,1,'Title Student Profile Female 1','title-student-profile-female-1','Subtitle Student is Female and first','<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee</p>\r\n','<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of huma','2016-04-01 21:26:40','2016-04-01 21:27:37','storystudent',0,0,'0000-00-00 00:00:00',NULL),
	(46,1,'This is the Title for Student Profile 2 male','this-is-the-title-for-student-profile-2-male','Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. ','<p>Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy f</p>\r\n','<p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy ve','2016-04-01 21:29:09','2016-04-01 21:30:09','storystudent',0,0,'0000-00-00 00:00:00',NULL),
	(47,1,'This is the Title for Student Profile 3 Female','this-is-the-title-for-student-profile-3-female','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. ','<p>Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>\r\n','<p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulpu','2016-04-01 21:31:13','2016-04-01 21:32:04','storystudent',0,0,'0000-00-00 00:00:00',NULL),
	(48,1,'Another Male Student Profile 4','another-male-student-profile-4','Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. ','<p>eparated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>\r\n','<p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lo','2016-04-01 21:33:01','2016-04-01 21:33:46','storystudent',0,0,'0000-00-00 00:00:00',NULL),
	(58,1,'This is an External Story','http://goole.com',NULL,NULL,NULL,'2016-04-07 17:38:51','2016-04-11 17:48:00','storyexternal',0,0,'0000-00-00 00:00:00',NULL),
	(61,1,'External 5','http://apple.com',NULL,NULL,NULL,'2016-04-07 18:06:36','2016-04-07 18:12:54','storyexternal',0,0,'0000-00-00 00:00:00',NULL),
	(66,1,'Bssssss','bssssss','ss','<p>s</p>','<p>dsssssssssss</p>','2016-04-07 19:33:37','2016-04-19 21:48:26','storybasic',0,0,'2016-04-19 00:00:00','2016-04-19 21:48:26'),
	(67,1,'Headline Story basic','headline-story-basic','Subtitle story basic headline 001','<p>teaser teaser</p>','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','2016-04-19 18:55:41','2016-04-19 21:48:02','storybasic',0,0,'2016-04-11 00:00:00','2016-04-18 00:00:00'),
	(68,1,'Basic Story 02 headline','basic-story-02-headline','subtitle','<p>teaser</p>','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>','2016-04-19 19:03:57','2016-04-19 21:47:40','storybasic',0,0,'2016-04-04 00:00:00','2016-04-11 00:00:00'),
	(69,1,'Headline 3 of Basic Story','headline-3-of-basic-story','subtitle','<p>teaser</p>','<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>','2016-04-19 19:04:31','2016-04-19 21:46:07','storybasic',0,0,'2016-04-19 05:25:00','2016-04-18 04:20:00'),
	(70,1,'Story about the Number 4','story-about-the-number-4','subtitle 4','<p>teaser 4</p>','<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>','2016-04-19 19:05:11','2016-04-19 21:46:47','storybasic',0,0,'2016-04-01 00:00:00','2016-05-01 00:00:00'),
	(71,1,'Newsheadline with start date but no end date','newsheadline-with-start-date-but-no-end-date','subtit','<p>teaser</p>','<p>In this example, we simply assign the&nbsp;name&nbsp;parameter from the incoming HTTP request to the&nbsp;nameattribute of the&nbsp;App\\Flight&nbsp;model instance. When we call the&nbsp;save&nbsp;method, a record will be inserted into the database. The&nbsp;created_at&nbsp;and&nbsp;updated_at&nbsp;timestamps will automatically be set when the&nbsp;save&nbsp;method is called, so there is no need to set them manually.</p>','2016-04-19 21:51:15','2016-04-19 21:51:15','storybasic',0,0,'2016-04-19 00:00:00','0000-00-00 00:00:00'),
	(72,1,'This is another Headline Story basic','this-is-another-headline-story-basic','no end date?','<p>no end date?</p>','<p>The Eloquent ORM included with Laravel provides a beautiful, simple ActiveRecord implementation for working with your database. Each database table has a corresponding &quot;Model&quot; which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.</p>','2016-04-19 21:55:59','2016-04-19 21:55:59','storybasic',0,0,'2016-04-19 00:00:00',NULL);

/*!40000 ALTER TABLE `storys` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'personal','2016-03-30 20:41:43','2016-03-30 20:41:43');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `last_login_at`)
VALUES
	(1,'u1','u1@emich.edu','$2y$10$KDvH3xHvdKpPth3lcW8fr.TQhb08VMa0ddVzDFFxZxsud2XLHX1T.','cfjFFxmpF3je19mFB6nQwm64z6UWmba9UGLQPUABkJqXgKuXStPwDRPJvYRF',NULL,'2016-04-21 15:31:40','2016-04-21 15:31:40'),
	(2,'User2','user2@emich.edu','$2y$10$g0jqylFGxk/XuvchwX0gT.WcYYjfHxiCHe6Rq//M9wKKMN1khvGGO','c4mUyv4RWhqyQ2E9BGDc7IaPsaqqv6DFxdnk21li9kx1JBPTPameZ6sq59Bb',NULL,'2016-03-17 14:24:13','2016-03-02 21:23:26');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
