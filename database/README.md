# Cool Homes Database

This directory contains the comprehensive database structure for the Cool Homes real estate website.

## 📁 Files

- `coolhomes.sql` - Complete database schema with sample data
- `README.md` - This documentation file

## 🗄️ Database Structure

### Core Tables

#### Users Management
- `users` - User accounts (admin, agents, buyers, sellers)
- `newsletter_subscribers` - Newsletter subscription management

#### Properties
- `properties` - Property listings with detailed information
- `property_images` - Property image gallery
- `property_views` - Property view tracking
- `favorites` - User favorite properties

#### Content Management
- `blog_posts` - Blog articles and news
- `blog_comments` - Blog post comments
- `contact_messages` - Contact form submissions

#### Business Operations
- `inquiries` - Property inquiries and leads
- `appointments` - Property viewing appointments
- `system_settings` - Website configuration

### Advanced Features

#### Views
- `featured_properties` - Featured property listings
- `recent_blog_posts` - Recent blog posts with author info
- `property_stats` - Property statistics and analytics

#### Stored Procedures
- `GetPropertyDetails(property_id)` - Get property with images
- `SearchProperties(...)` - Advanced property search

#### Triggers
- Auto-update property view counts
- Auto-update blog view counts

## 🚀 Setup Instructions

### Option 1: Automatic Setup (Recommended)
The database will be automatically created and populated when you first access the website. The PHP application will:
1. Create the database if it doesn't exist
2. Import the SQL file automatically
3. Set up all tables, views, and procedures

### Option 2: Manual Setup
If you prefer manual setup:

1. **Create Database:**
   ```sql
   CREATE DATABASE coolhomes_db;
   USE coolhomes_db;
   ```

2. **Import SQL File:**
   ```bash
   mysql -u root -p coolhomes_db < coolhomes.sql
   ```

3. **Verify Setup:**
   ```sql
   SHOW TABLES;
   SELECT COUNT(*) FROM properties;
   SELECT COUNT(*) FROM users;
   ```

## 📊 Sample Data Included

### Users
- **Admin:** admin@coolhomes.co.ke (password: admin123)
- **Agent 1:** sarah@coolhomes.co.ke (password: password)
- **Agent 2:** michael@coolhomes.co.ke (password: password)

### Properties
- 4 sample properties with images
- Mix of residential and commercial
- Featured properties configured

### Blog Posts
- 3 sample blog posts
- Different categories and tags
- SEO optimized content

### System Settings
- Website configuration
- Contact information
- Display preferences

## 🔧 Database Features

### Performance Optimizations
- **Indexes** on frequently queried columns
- **Composite indexes** for complex queries
- **Views** for common data access patterns

### Data Integrity
- **Foreign key constraints** for data consistency
- **Unique constraints** where appropriate
- **Check constraints** for data validation

### Security
- **Prepared statements** support
- **SQL injection** prevention
- **Data sanitization** built-in

## 📈 Analytics & Reporting

### Built-in Analytics
- Property view tracking
- Blog post analytics
- User engagement metrics

### Custom Queries
```sql
-- Get property performance
SELECT p.title, p.views_count, p.price
FROM properties p
ORDER BY p.views_count DESC;

-- Get monthly inquiries
SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as inquiries
FROM inquiries
GROUP BY month
ORDER BY month DESC;

-- Get agent performance
SELECT u.name, COUNT(p.id) as properties, AVG(p.price) as avg_price
FROM users u
LEFT JOIN properties p ON u.id = p.agent_id
WHERE u.role = 'agent'
GROUP BY u.id;
```

## 🛠️ Maintenance

### Regular Tasks
- **Backup database** regularly
- **Monitor performance** with slow query log
- **Update statistics** for optimal performance
- **Clean up old data** (views, logs)

### Backup Commands
```bash
# Full database backup
mysqldump -u root -p coolhomes_db > backup_$(date +%Y%m%d).sql

# Structure only
mysqldump -u root -p --no-data coolhomes_db > structure.sql

# Data only
mysqldump -u root -p --no-create-info coolhomes_db > data.sql
```

## 🔍 Troubleshooting

### Common Issues

1. **Connection Failed**
   - Check MySQL service is running
   - Verify credentials in `config/database.php`
   - Ensure database exists

2. **Import Errors**
   - Check SQL syntax
   - Verify file permissions
   - Review MySQL error logs

3. **Performance Issues**
   - Check indexes are created
   - Monitor slow queries
   - Optimize queries

### Support
For database-related issues, check:
- MySQL error logs
- PHP error logs
- Application logs

## 📝 Version History

- **v1.0** - Initial database structure
- **v1.1** - Added analytics and reporting
- **v1.2** - Performance optimizations
- **v1.3** - Advanced features and procedures

---

**Note:** This database is designed for the Cool Homes real estate website and includes all necessary tables, relationships, and sample data for immediate use.
