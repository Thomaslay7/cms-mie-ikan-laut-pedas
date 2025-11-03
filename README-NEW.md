# Mie Ikan Laut Pedas CMS Backend

A comprehensive Content Management System backend built with Laravel 11 and Filament v4 for "Mie Ikan Laut Pedas" - a spicy fish noodle soup restaurant.

## 🚀 Features

### 🎛️ Admin Panel (Filament v4)

-   **Dashboard** with analytics and statistics
-   **Menu Management** with categories, pricing, and spice levels
-   **Content Management** for business info, testimonials, gallery
-   **SEO Management** with meta tags and descriptions
-   **Media Library** with automatic image optimization
-   **Analytics Tracking** for user engagement

### 🔌 RESTful API

-   **Business Information** endpoint
-   **Menu & Categories** with filtering and search
-   **Testimonials** with ratings and reviews
-   **Gallery** with categorized images
-   **Chef Information** and restaurant details
-   **FAQs** and announcements
-   **Analytics Tracking** for frontend integration

### 🛡️ Security & Performance

-   Laravel Sanctum authentication
-   Rate limiting and CORS protection
-   Image optimization and CDN-ready
-   Database indexing and query optimization
-   Input validation and sanitization

## 🛠️ Tech Stack

-   **Backend**: Laravel 11
-   **Admin Panel**: Filament v4
-   **Database**: SQLite (development) / MySQL (production)
-   **Media**: Spatie MediaLibrary + Intervention Image
-   **API Auth**: Laravel Sanctum
-   **Other**: Spatie Sluggable, Maatwebsite Excel

## 📦 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM (for frontend assets)

### Setup Steps

1. **Install dependencies**

    ```bash
    composer install
    ```

2. **Environment configuration**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. **Database setup**

    ```bash
    php artisan migrate --seed
    ```

4. **Create storage symlink**

    ```bash
    php artisan storage:link
    ```

5. **Create admin user**

    ```bash
    php artisan make:filament-user
    ```

6. **Start development server**
    ```bash
    php artisan serve
    ```

## 📡 API Documentation

### Base URL

```
Local: http://localhost:8000/api/v1
Production: https://yourdomain.com/api/v1
```

### 🔓 Public Endpoints

#### Business Information

```http
GET /business-info
```

Returns complete business information including contact details, operating hours, and social media links.

#### Categories

```http
GET /categories
GET /categories/{slug}
```

Fetch all menu categories or specific category with menu items.

#### Menu Items

```http
GET /menu-items?category={slug}&featured=true&popular=true&page=1&limit=12
GET /menu-items/featured
GET /menu-items/popular
GET /menu-items/{slug}
```

Browse menu items with various filters and pagination.

#### Testimonials

```http
GET /testimonials?featured=true&rating=5&page=1&limit=10
GET /testimonials/featured
GET /testimonials/stats
```

Customer reviews and rating statistics.

#### Gallery

```http
GET /gallery?category=food&featured=true&limit=20
GET /gallery/categories
```

Restaurant and food images categorized.

#### Analytics

```http
POST /analytics/track
POST /analytics/batch-track
```

Track user interactions and page views.

## 🎛️ Admin Panel

Access the admin panel at: `http://localhost:8000/admin`

### Features Available:

1. **📊 Dashboard** - Overview statistics and analytics
2. **🗂️ Categories Management** - Menu categories with SEO
3. **🍜 Menu Items Management** - Comprehensive menu management
4. **⭐ Testimonials** - Customer review management
5. **🏪 Business Information** - Restaurant details and settings
6. **📸 Gallery Management** - Image organization
7. **👨‍🍳 Chef Information** - Chef profiles
8. **❓ FAQ Management** - Question categorization
9. **⚙️ Settings Management** - Site configuration

## 🗄️ Database Structure

The system includes 10 main tables:

-   `categories` - Menu categories
-   `menu_items` - Restaurant menu items
-   `testimonials` - Customer reviews
-   `business_info` - Restaurant information
-   `gallery` - Image management
-   `chef_info` - Chef profiles
-   `faqs` - Frequently asked questions
-   `announcements` - Promotional content
-   `analytics_events` - User tracking
-   `cms_settings` - System configuration

## 🍜 Business Context

**Mie Ikan Laut Pedas** specializes in spicy fish noodle soup with:

-   🌶️ 4 spice levels (mild, medium, hot, extra hot)
-   🐟 Fresh seafood ingredients
-   🇮🇩 Traditional Indonesian recipes
-   🚚 Multiple delivery platforms integration
-   👨‍👩‍👧‍👦 Family-friendly dining options

The CMS manages all aspects of the restaurant's digital presence while providing analytics and customer management tools.

## 📝 Development

### Sample Data Included:

-   ✅ 6 Menu categories (Mie Pedas, Mie Kuah, Mie Goreng, etc.)
-   ✅ 6 Menu items with complete details
-   ✅ 6 Customer testimonials with ratings
-   ✅ Complete business information
-   ✅ CMS settings configuration

### Key Models:

-   **Category** → hasMany MenuItems
-   **MenuItem** → belongsTo Category
-   **BusinessInfo** → Singleton model
-   All models implement media collections
-   Automatic slug generation
-   Comprehensive scopes and accessors

## 🚀 Quick Test

After setup, test these endpoints:

```bash
# Get business info
curl http://localhost:8000/api/v1/business-info

# Get all categories
curl http://localhost:8000/api/v1/categories

# Get menu items
curl http://localhost:8000/api/v1/menu-items

# Get testimonials
curl http://localhost:8000/api/v1/testimonials
```

## 🌐 Production Deployment

### Environment Variables

```env
APP_NAME="Mie Ikan Laut Pedas CMS"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

# Add your production settings
```

### Production Checklist

-   [ ] Update environment variables
-   [ ] Configure database connection
-   [ ] Set up file storage (S3/CDN)
-   [ ] Configure email settings
-   [ ] Set up SSL certificate
-   [ ] Configure caching (Redis/Memcached)
-   [ ] Set up queue workers
-   [ ] Configure backup system

## 🤝 Support

For support and questions:

-   📧 Email: info@mieikamlautpedas.com
-   📱 WhatsApp: +62 812-3456-7890

---

**Built with ❤️ using Laravel & Filament**

_Ready for production use with comprehensive features for restaurant content management._
