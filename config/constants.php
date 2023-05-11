<?php

use App\Models\User;
use App\Models\Post;
use App\Models\SocialMedia;

//Global const
if (!defined('CONST_ENABLE')) define('CONST_ENABLE', 1);
if (!defined('CONST_DISABLE')) define('CONST_DISABLE', 0);
if (!defined('NOTIFICATION_SUCCESS')) define('NOTIFICATION_SUCCESS', 'success');
if (!defined('NOTIFICATION_ERROR')) define('NOTIFICATION_ERROR', 'error');

/**
 * SOCIAL MEDIA
 */
if (!defined('SOCIAL_MEDIAS')) define('SOCIAL_MEDIAS', SocialMedia::$socialMedias);
if (!defined('FACEBOOK')) define('FACEBOOK', SocialMedia::FACEBOOK);
if (!defined('INSTAGRAM')) define('INSTAGRAM', SocialMedia::INSTAGRAM);
if (!defined('TIKTOK')) define('TIKTOK', SocialMedia::TIKTOK);
if (!defined('YOUTUBE')) define('YOUTUBE', SocialMedia::YOUTUBE);
if (!defined('TWITTER')) define('TWITTER', SocialMedia::TWITTER);

/**
 * MEDIA COLLECTIONS
 */

// User collections
if (!defined('USER_AVATAR_COLLECTION')) define('USER_AVATAR_COLLECTION', User::AVATAR_COLLECTION);
if (!defined('USER_AVATAR_RESIZE_NAME')) define('USER_AVATAR_RESIZE_NAME', User::AVATAR_RESIZE_NAME);

// Post collections
if (!defined('POST_IMAGES_COLLECTION')) define('POST_IMAGES_COLLECTION', Post::POST_IMAGES_COLLECTION);
if (!defined('POST_VIDEOS_COLLECTION')) define('POST_VIDEOS_COLLECTION', Post::POST_VIDEOS_COLLECTION);
