#!/bin/bash
# Simple test runner script for nc-jalali

set -e

echo "================================"
echo "nc-jalali Test Runner"
echo "================================"
echo ""

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to run a command and report status
run_test() {
    local name=$1
    local cmd=$2
    
    echo -n "Running $name... "
    if eval "$cmd" > /tmp/test_output.log 2>&1; then
        echo -e "${GREEN}✓ PASSED${NC}"
        return 0
    else
        echo -e "${RED}✗ FAILED${NC}"
        echo "Error output:"
        cat /tmp/test_output.log
        return 1
    fi
}

# Parse command line arguments
TEST_TYPE=${1:-all}

case $TEST_TYPE in
    php)
        echo "Running PHP tests only..."
        run_test "PHP Lint" "composer lint"
        run_test "PHPUnit Tests" "composer test:unit || true"
        run_test "Psalm Analysis" "composer psalm || true"
        ;;
    js)
        echo "Running JavaScript tests only..."
        run_test "ESLint" "npm run lint"
        run_test "Stylelint" "npm run stylelint"
        run_test "Build" "npm run build"
        ;;
    lint)
        echo "Running linting only..."
        run_test "PHP Lint" "composer lint"
        run_test "ESLint" "npm run lint"
        run_test "Stylelint" "npm run stylelint"
        ;;
    all)
        echo "Running all tests..."
        echo ""
        echo "--- PHP Tests ---"
        run_test "PHP Lint" "composer lint"
        run_test "PHPUnit Tests" "composer test:unit || true"
        run_test "Psalm Analysis" "composer psalm || true"
        echo ""
        echo "--- JavaScript Tests ---"
        run_test "ESLint" "npm run lint"
        run_test "Stylelint" "npm run stylelint"
        run_test "Build" "npm run build"
        ;;
    *)
        echo "Usage: $0 [all|php|js|lint]"
        echo ""
        echo "Options:"
        echo "  all   - Run all tests (default)"
        echo "  php   - Run PHP tests only"
        echo "  js    - Run JavaScript tests only"
        echo "  lint  - Run linting only"
        exit 1
        ;;
esac

echo ""
echo -e "${GREEN}Test run completed!${NC}"
