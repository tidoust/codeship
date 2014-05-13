<?php
// An example of using php-webdriver.

require_once('vendor/facebook/webdriver/lib/__init__.php');

// Start Google Chrome
$host = 'http://127.0.0.1:9515'; // this is the default
$capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'chrome');
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

// navigate to 'http://docs.seleniumhq.org/'
$driver->get('http://docs.seleniumhq.org/');

// adding cookie
$driver->manage()->deleteAllCookies();
$driver->manage()->addCookie(array(
  'name' => 'cookie_name',
  'value' => 'cookie_value',
));
$cookies = $driver->manage()->getCookies();
print_r($cookies);

// click the link 'About'
$link = $driver->findElement(
  WebDriverBy::id('menu_about')
);
$link->click();

// print the title of the current page
echo "The title is " . $driver->getTitle() . "'\n";

// print the title of the current page
echo "The current URI is " . $driver->getCurrentURL() . "'\n";

// Search 'php' in the search box
$input = $driver->findElement(
  WebDriverBy::id('q')
);
$input->sendKeys('php')->submit();

// wait at most 10 seconds until at least one result is shown
$driver->wait(10)->until(
  WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
    WebDriverBy::className('gsc-result')
  )
);

// close the Firefox
$driver->quit();