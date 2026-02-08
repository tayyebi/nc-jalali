# Jalali

A Nextcloud app that adds Jalali (Shamsi/Persian) calendar support to NextCloud.

Jalali is the most accurate solar calendar widely used in Iran and the middle east.

## Usage

- To get started easily use the [Appstore App generator](https://apps.nextcloud.com/developer/apps/generate) to
  dynamically generate an App based on this repository with all the constants prefilled.
- Alternatively you can use the "Use this template" button on the top of this page to create a new repository based on
  this repository. Afterwards adjust all the necessary constants like App ID, namespace, descriptions etc.

Once your app is ready follow the [instructions](https://nextcloudappstore.readthedocs.io/en/latest/developer.html) to
upload it to the Appstore.

## Development

### Installation

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Testing

This project includes automated tests that run via GitHub Actions on every push and pull request.

For detailed testing and contribution guidelines, see [CONTRIBUTING.md](CONTRIBUTING.md).

#### Quick Test Run

```bash
# Run all tests with the test runner script
./run-tests.sh

# Run specific test suites
./run-tests.sh php    # PHP tests only
./run-tests.sh js     # JavaScript tests only
./run-tests.sh lint   # Linting only
```

#### Run All Tests

```bash
# Run PHP unit tests
composer test:unit

# Run PHP linting
composer lint

# Run PHP static analysis
composer psalm

# Run code style check
composer cs:check

# Fix code style issues
composer cs:fix

# Run JavaScript linting
npm run lint

# Run CSS/SCSS linting
npm run stylelint
```

#### Run Individual Tests

```bash
# Run specific test file
./vendor-bin/phpunit/vendor/bin/phpunit tests/unit/Controller/ApiTest.php

# Run tests with coverage
composer test:unit -- --coverage-text
```

### Building

```bash
# Build for production
npm run build

# Build for development
npm run dev

# Watch for changes (development)
npm run watch
```

## Resources

### Documentation for developers:

- General documentation and tutorials: https://nextcloud.com/developer
- Technical documentation: https://docs.nextcloud.com/server/latest/developer_manual

### Help for developers:

- Official community chat: https://cloud.nextcloud.com/call/xs25tz5y
- Official community forum: https://help.nextcloud.com/c/dev/11
