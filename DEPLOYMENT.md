# 🚀 Regina's Kitchen CMS - Deployment Guide

## Platform Options:

### 1. Vercel (Easiest)
```bash
chmod +x vercel-setup.sh
./vercel-setup.sh
```

### 2. Render (Best for Database)  
```bash
chmod +x render-setup.sh
./render-setup.sh
```

### 3. Heroku (Most Reliable)
```bash
chmod +x heroku-setup.sh  
./heroku-setup.sh
```

### 4. Netlify + PlanetScale
```bash
chmod +x netlify-setup.sh
./netlify-setup.sh
```

## Environment Variables Needed:
- APP_KEY (generate with: php artisan key:generate --show)
- DATABASE_URL 
- APP_ENV=production
- APP_DEBUG=false

## After Deploy:
1. Create admin user: php artisan make:filament-user  
2. Access: https://your-app/admin
3. Upload logo and content
