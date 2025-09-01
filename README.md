# Laravel Tenancy Backend

A Laravel application with multi-tenancy support using stancl/tenancy package with single database approach using PostgreSQL schemas. Designed for React SaaS applications.

## Features

- Multi-tenancy with single database
- PostgreSQL schema-based tenant isolation
- API-only implementation with consistent responses
- Tenant management endpoints
- Domain-based tenant identification
- CORS enabled for React applications
- Proper error handling and validation

## Setup

1. Install dependencies:
```bash
composer install
```

2. Configure environment variables in `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

3. Run migrations:
```bash
php artisan migrate
```

4. Seed sample tenants:
```bash
php artisan db:seed
```

5. Start the server:
```bash
php artisan serve
```

## API Endpoints

### Central Domain (localhost:8000)

- `GET /api/tenants` - List all tenants
- `POST /api/tenants` - Create a new tenant
- `GET /api/tenants/{tenant}` - Get tenant details
- `PUT /api/tenants/{tenant}` - Update tenant
- `DELETE /api/tenants/{tenant}` - Delete tenant

### Tenant Domain (tenant1.localhost:8000)

- `GET /api/` - Tenant status
- `GET /api/profile` - Tenant profile
- `GET /api/tenants` - Tenant-specific data

## Response Format

All API responses follow a consistent structure:
```json
{
  "success": true,
  "message": "Success message",
  "data": {...}
}
```

## React Integration

The API is designed for React applications with:
- Consistent JSON responses
- CORS enabled
- Proper error handling
- Validation error messages
- RESTful endpoints

See `API_DOCUMENTATION.md` for detailed React usage examples.

## Architecture

- **Single Database**: All tenants share the same PostgreSQL database
- **Schema Isolation**: Each tenant gets its own schema for data isolation
- **Domain Routing**: Tenants are identified by domain/subdomain
- **API-First**: RESTful API endpoints for all operations
- **Scalable**: Designed for future growth and additional features

## Code Quality

- Clean, maintainable code following Laravel best practices
- Single responsibility principle for each component
- Proper separation of concerns
- No code duplication
- Minimal comments with only essential documentation
- Production-ready implementation
