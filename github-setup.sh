#!/bin/bash
# GitHub Setup Script for Regina's Kitchen CMS

echo "🔗 Setting up GitHub repository connection..."

# Replace with your actual GitHub repository URL
GITHUB_URL="https://github.com/YOUR_USERNAME/cms-mie-ikan-laut-pedas.git"

echo "📝 Please follow these steps:"
echo ""
echo "1️⃣ Create a new repository on GitHub with name: cms-mie-ikan-laut-pedas"
echo "2️⃣ Copy the repository URL (HTTPS or SSH)"
echo "3️⃣ Run: git remote add origin YOUR_REPO_URL"
echo "4️⃣ Run: git push -u origin main"
echo ""
echo "Example:"
echo "git remote add origin https://github.com/YOUR_USERNAME/cms-mie-ikan-laut-pedas.git"
echo "git push -u origin main"
echo ""
echo "🚀 After pushing to GitHub, you can deploy to Railway!"
echo "Railway will automatically detect the repository and deploy it."
