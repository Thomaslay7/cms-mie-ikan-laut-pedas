# Copilot Instructions for Mie Ikan Laut Pedas CMS

<!-- Use this file to provide workspace-specific custom instructions to Copilot. For more details, visit https://code.visualstudio.com/docs/copilot/copilot-customization#_use-a-githubcopilotinstructionsmd-file -->

## Project Overview

This is a Laravel 11 + Filament v3 CMS backend for "Mie Ikan Laut Pedas" - a spicy fish noodle soup restaurant. The system provides:

-   Admin panel for content management
-   RESTful API for frontend consumption
-   Media management with image optimization
-   Analytics tracking
-   Multi-language ready architecture

## Development Guidelines

### Code Style

-   Follow Laravel coding standards and PSR-12
-   Use meaningful variable and method names in English
-   Add comprehensive docblocks for all classes and methods
-   Use type hints for all method parameters and return types

### Models

-   All models should extend the base Eloquent model
-   Use proper relationships (belongsTo, hasMany, etc.)
-   Implement slug generation using Spatie\Sluggable
-   Use soft deletes for important data
-   Add proper casts for JSON fields
-   Include fillable and hidden properties

### Filament Resources

-   Follow Filament v3 conventions
-   Use proper form fields with validation
-   Implement table columns with sorting and searching
-   Add appropriate filters for data filtering
-   Use bulk actions where applicable
-   Implement proper authorization if needed

### API Development

-   Use Laravel API Resources for response formatting
-   Implement proper error handling
-   Add rate limiting for API endpoints
-   Use Laravel Sanctum for authentication where needed
-   Follow RESTful conventions

### Database

-   Use descriptive migration names
-   Add proper indexes for performance
-   Use foreign key constraints
-   Include proper column types and nullable settings
-   Add seeders with realistic sample data

### Security

-   Validate all inputs using Form Request classes
-   Sanitize HTML content
-   Use proper authentication and authorization
-   Implement CORS correctly
-   Add rate limiting to prevent abuse

### Performance

-   Use eager loading to prevent N+1 queries
-   Implement caching where appropriate
-   Optimize images automatically
-   Use database indexes strategically
-   Consider pagination for large datasets

### Media Handling

-   Use Spatie MediaLibrary for file uploads
-   Implement automatic image resizing
-   Add proper file validation
-   Use storage links for public access
-   Implement CDN-ready file organization

## Key Packages Used

-   **Filament v4**: Admin panel framework
-   **Laravel Sanctum**: API authentication
-   **Spatie MediaLibrary**: File and media management
-   **Spatie Sluggable**: Automatic slug generation
-   **Intervention Image**: Image processing
-   **Maatwebsite Excel**: Import/export functionality

## Business Context

The restaurant specializes in spicy fish noodle soup with various spice levels and menu categories. The CMS should handle:

-   Menu items with categories, pricing, and spice levels
-   Customer testimonials and reviews
-   Chef information and restaurant details
-   Gallery images for food and restaurant
-   FAQ management
-   Promotional announcements
-   Business information and contact details
-   Analytics for tracking user engagement

When generating code, consider the Indonesian culinary context and ensure all content management features are user-friendly for restaurant staff.
