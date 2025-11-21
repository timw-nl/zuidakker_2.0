#!/bin/bash

# Zuidakker Testing Setup Script
# Sets up automated testing environment

echo "🧪 Setting up Zuidakker Testing Environment..."
echo ""

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed"
    echo "Please install Node.js 18+ from https://nodejs.org/"
    exit 1
fi

echo "✅ Node.js $(node --version) found"
echo ""

# Install dependencies
echo "📦 Installing dependencies..."
npm install

# Install Playwright browsers
echo "🌐 Installing Playwright browsers..."
npx playwright install

echo ""
echo "✅ Setup complete!"
echo ""
echo "📝 Next steps:"
echo "  1. Start Docker: docker-compose up -d"
echo "  2. Run tests: npm test"
echo "  3. View UI: npm run test:ui"
echo ""
echo "📚 See docs/TESTING.md for full documentation"
