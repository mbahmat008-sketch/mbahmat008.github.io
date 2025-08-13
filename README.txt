REAL-ESTATE PHP BACKEND

1) Requirements
- PHP 7.4+ (or 8.x)
- MySQL 5.7+ / MariaDB 10+
- Apache/Nginx with PHP enabled

2) Setup
- Create a database and import db.sql:
  mysql -u root -p < db.sql
- Edit config.php with your database credentials.
- Copy all PHP files to your web root together with your existing assets/ and vendor/ folders from the template.
- Visit index.php in your browser.

3) Routes
- index.php           : homepage with latest properties
- properties.php      : listing + pagination, filter by category (ex: ?category=Apartment)
- property-details.php: detail page by id or slug (ex: ?id=1 or ?slug=miami-18-new-st)
- contact.php         : contact form (saves to 'inquiries' table)

4) Notes
- Uses Bootstrap/JS/CSS from your template; be sure the folder structure matches (assets/, vendor/).
- To change phone/email shown, edit partials/header.php and contact.php.
- This starter is safe by default (prepared statements, HTML escaping).
