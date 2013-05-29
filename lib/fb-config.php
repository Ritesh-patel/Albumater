<?php
require $path_app.'lib/facebook-php-sdk/src/facebook.php';   // include facebook.php file
$facebook = new Facebook(array(         // define an object of facebook class
    'appId'  => 'Your app ID',
    'secret' => 'Your app secret',
    'cookie' => true,
));
$user = $facebook->getUser();           //call to getUser() method to get userid
if($user) 
{
    try 
    {    
        $user_profile=$facebook->api('/me');    // get detail of the user
        $user_albums=$facebook->api('/me/albums');  // get all the albums of user
    } 
    catch(FacebookApiException $e) 
    {
        error_log($e);
        $user = null;
    }
}
if($user)
{    
    $logoutUrl = $facebook->getLogoutUrl();     // get logout url for logout
} 
else 
{
    $params = array("scope" => "user_photos");      // define scope of app
    $loginUrl = $facebook->getLoginUrl($params);    // get login url for login
}
?>
