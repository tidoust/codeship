# Testing Codeship.io

This short repository contains an example of a WebDriver test that runs in a running instance of Chrome on Codeship.io.

The test is in the `test` folder.


## How to run the test locally

To run the test locally:

1. Clone the repo in some local folder: `git clone https://github.com/tidoust/codeship.git`
2. Install Composer if needed: `curl -sS https://getcomposer.org/installer | php`
3. Install PHP dependencies: `composer install`
4. Download ChromeDriver `http://chromedriver.storage.googleapis.com/index.html?path=2.9/`
5. Run ChromeDriver in the background, the server should start listening on port 9515
6. Run the test: `vendor/bin/phpunit`

This should open up a Chrome instance that will load GitHub's home page and assert that the title is the right one.


## How to run the test on Codeship

Create a new project associated with your cloned repository.

In *Modify your Setup commands*, enter:

```bash
# Set php version through phpenv. 5.3, 5.4 and 5.5 available
phpenv local 5.4

# Install dependencies through Composer
composer install --prefer-source --no-interaction

# Run ChromeDriver
nohup bash -c "chromedriver 2>&1 &" && sleep 4; cat nohup.out
```

In *Modify yout Test commands*, enter:

```bash
vendor/bin/phpunit
```

That's it, Codeship will run the test accordingly.


## Additional notes

- If you prefer to plan another Web browser, you'll have to download and start the standalone WebDriver server instead
- It would be wise not to hardcode the URL of the ChromeDriver server in each and every test and use a constant instead
- Similarly, it might be better to keep the `webDriver` variable around instead of launching Chrome for each and every test
