Interactive Graphing Library
This project provides a dynamic web-based graphing library using HTML, CSS (Tailwind CSS & Bootstrap), and JavaScript (Chart.js). It demonstrates how to visualize data fetched from a backend API (simulated PHP API connected to MariaDB) and supports various chart types, including advanced ones.

Features
Dynamic Data Loading: Fetches data from a PHP API endpoint, simulating a real database connection.

Multiple Chart Types:

Line Graph

Bar Graph

Histogram

Pie Chart

Dot Plot

Scatter Plot

Area Chart

Box Plot (Advanced)

Candlestick Chart (Advanced)

URL Parameter Integration: Load specific charts directly via URL (e.g., index.html?graph=line).

Responsive Design: Utilizes Tailwind CSS for a modern, mobile-first, and responsive layout, complemented by Bootstrap for certain UI components.

Loading Indicators & Custom Alerts: Provides a smooth user experience with visual feedback during data fetching.

Project Structure
index.html (or your_page_name.html): The main front-end HTML file containing the charting interface and JavaScript logic.

api-endpoint.php: A sample PHP script that connects to your MariaDB database, fetches raw data, and serves it as a JSON API.

README.md: This file.

Setup and Installation
To run this project locally, you will need a web server environment that supports PHP and MariaDB (or MySQL). A common setup is LAMP (Linux, Apache, MariaDB/MySQL, PHP) or XAMPP/MAMP for cross-platform development.

1. Database Setup (MariaDB/MySQL)
First, create a database and the necessary tables.

Database Name: graph_data (or your preferred name)

Table 1: sales_transactions (for product/sales data)

CREATE TABLE sales_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_date DATE NOT NULL,
    product_category VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    customer_rating DECIMAL(2, 1),
    product_price DECIMAL(10, 2)
);

-- Sample Data for sales_transactions
INSERT INTO sales_transactions (transaction_date, product_category, amount, quantity, customer_rating, product_price) VALUES
('2023-01-01', 'Electronics', 120.50, 15, 4.2, 500.00),
('2023-01-08', 'Books', 80.25, 10, 3.8, 200.00),
('2023-01-15', 'Home Goods', 150.75, 20, 4.5, 300.00),
('2023-01-22', 'Electronics', 130.00, 16, 4.3, 550.00),
('2023-01-29', 'Books', 90.10, 11, 3.9, 220.00),
('2023-02-05', 'Home Goods', 160.30, 22, 4.6, 320.00),
('2023-02-12', 'Electronics', 140.80, 17, 4.4, 520.00),
('2023-02-19', 'Books', 85.50, 10, 3.7, 210.00),
('2023-02-26', 'Home Goods', 170.90, 23, 4.7, 330.00),
('2023-03-05', 'Electronics', 155.20, 18, 4.5, 580.00),
('2023-03-12', 'Books', 95.00, 12, 4.0, 230.00),
('2023-03-19', 'Home Goods', 180.60, 25, 4.8, 350.00),
('2023-03-26', 'Electronics', 165.40, 19, 4.6, 600.00),
('2023-04-02', 'Books', 100.00, 13, 4.1, 240.00),
('2023-04-09', 'Home Goods', 190.20, 26, 4.9, 360.00),
('2023-04-16', 'Electronics', 175.60, 20, 4.7, 620.00),
('2023-01-01', 'Electronics', 100.00, 12, 4.1, 510.00),
('2023-01-01', 'Electronics', 110.00, 13, 4.3, 530.00),
('2023-01-01', 'Electronics', 95.00, 11, 4.0, 490.00),
('2023-01-08', 'Books', 75.00, 9, 3.5, 195.00),
('2023-01-08', 'Books', 88.00, 11, 4.0, 215.00),
('2023-01-08', 'Books', 82.00, 10, 3.7, 205.00),
('2023-01-15', 'Home Goods', 155.00, 21, 4.6, 315.00),
('2023-01-15', 'Home Goods', 195.00, 27, 4.9, 340.00),
('2023-01-15', 'Home Goods', 145.00, 19, 4.4, 290.00),
('2023-01-22', 'Electronics', 135.00, 17, 4.5, 570.00),
('2023-01-29', 'Books', 92.00, 12, 3.9, 225.00),
('2023-02-05', 'Home Goods', 165.00, 23, 4.7, 335.00),
('2023-02-12', 'Electronics', 145.00, 18, 4.2, 540.00),
('2023-02-19', 'Books', 80.00, 9, 3.6, 185.00),
('2023-02-26', 'Home Goods', 175.00, 24, 4.8, 355.00),
('2023-03-05', 'Electronics', 160.00, 19, 4.3, 560.00),
('2023-03-12', 'Books', 98.00, 13, 3.8, 210.00),
('2023-03-19', 'Home Goods', 185.00, 26, 4.5, 305.00),
(NULL, NULL, NULL, NULL, NULL, 100.00), (NULL, NULL, NULL, NULL, NULL, 150.00), (NULL, NULL, NULL, NULL, NULL, 120.00), (NULL, NULL, NULL, NULL, NULL, 200.00), (NULL, NULL, NULL, NULL, NULL, 250.00),
(NULL, NULL, NULL, NULL, NULL, 180.00), (NULL, NULL, NULL, NULL, NULL, 300.00), (NULL, NULL, NULL, NULL, NULL, 350.00), (NULL, NULL, NULL, NULL, NULL, 280.00), (NULL, NULL, NULL, NULL, NULL, 400.00),
(NULL, NULL, NULL, NULL, NULL, 450.00), (NULL, NULL, NULL, NULL, NULL, 380.00), (NULL, NULL, NULL, NULL, NULL, 500.00), (NULL, NULL, NULL, NULL, NULL, 550.00), (NULL, NULL, NULL, NULL, NULL, 480.00),
(NULL, NULL, NULL, NULL, NULL, 600.00), (NULL, NULL, NULL, NULL, NULL, 650.00), (NULL, NULL, NULL, NULL, NULL, 580.00), (NULL, NULL, NULL, NULL, NULL, 700.00), (NULL, NULL, NULL, NULL, NULL, 750.00),
(NULL, NULL, NULL, NULL, NULL, 800.00), (NULL, NULL, NULL, NULL, NULL, 850.00), (NULL, NULL, NULL, NULL, NULL, 900.00), (NULL, NULL, NULL, NULL, NULL, 950.00), (NULL, NULL, NULL, NULL, NULL, 1000.00),
(NULL, NULL, NULL, NULL, NULL, 100.00), (NULL, NULL, NULL, NULL, NULL, 150.00), (NULL, NULL, NULL, NULL, NULL, 120.00), (NULL, NULL, NULL, NULL, NULL, 200.00), (NULL, NULL, NULL, NULL, NULL, 250.00),
(NULL, NULL, NULL, NULL, NULL, 180.00), (NULL, NULL, NULL, NULL, NULL, 300.00), (NULL, NULL, NULL, NULL, NULL, 350.00), (NULL, NULL, NULL, NULL, NULL, 280.00), (NULL, NULL, NULL, NULL, NULL, 400.00),
(NULL, NULL, NULL, NULL, NULL, 450.00), (NULL, NULL, NULL, NULL, NULL, 380.00), (NULL, NULL, NULL, NULL, NULL, 500.00), (NULL, NULL, NULL, NULL, NULL, 550.00), (NULL, NULL, NULL, NULL, NULL, 480.00),
(NULL, NULL, NULL, NULL, NULL, 600.00), (NULL, NULL, NULL, NULL, NULL, 650.00), (NULL, NULL, NULL, NULL, NULL, 580.00), (NULL, NULL, NULL, NULL, NULL, 700.00), (NULL, NULL, NULL, NULL, NULL, 750.00),
(NULL, NULL, NULL, NULL, NULL, 800.00), (NULL, NULL, NULL, NULL, NULL, 850.00), (NULL, NULL, NULL, NULL, NULL, 900.00), (NULL, NULL, NULL, NULL, NULL, 950.00), (NULL, NULL, NULL, NULL, NULL, 1000.00),
(NULL, NULL, NULL, NULL, NULL, 100.00), (NULL, NULL, NULL, NULL, NULL, 150.00), (NULL, NULL, NULL, NULL, NULL, 120.00), (NULL, NULL, NULL, NULL, NULL, 200.00), (NULL, NULL, NULL, NULL, NULL, 250.00),
(NULL, NULL, NULL, NULL, NULL, 180.00), (NULL, NULL, NULL, NULL, NULL, 300.00), (NULL, NULL, NULL, NULL, NULL, 350.00), (NULL, NULL, NULL, NULL, NULL, 280.00), (NULL, NULL, NULL, NULL, NULL, 400.00),
(NULL, NULL, NULL, NULL, NULL, 450.00), (NULL, NULL, NULL, NULL, NULL, 380.00), (NULL, NULL, NULL, NULL, NULL, 500.00), (NULL, NULL, NULL, NULL, NULL, 550.00), (NULL, NULL, NULL, NULL, NULL, 480.00),
(NULL, NULL, NULL, NULL, NULL, 600.00), (NULL, NULL, NULL, NULL, NULL, 650.00), (NULL, NULL, NULL, NULL, NULL, 580.00), (NULL, NULL, NULL, NULL, NULL, 700.00), (NULL, NULL, NULL, NULL, NULL, 750.00),
(NULL, NULL, NULL, NULL, NULL, 800.00), (NULL, NULL, NULL, NULL, NULL, 850.00), (NULL, NULL, NULL, NULL, NULL, 900.00), (NULL, NULL, NULL, NULL, NULL, 950.00), (NULL, NULL, NULL, NULL, NULL, 1000.00),
(NULL, NULL, NULL, NULL, NULL, 100.00), (NULL, NULL, NULL, NULL, NULL, 150.00), (NULL, NULL, NULL, NULL, NULL, 120.00), (NULL, NULL, NULL, NULL, NULL, 200.00), (NULL, NULL, NULL, NULL, NULL, 250.00),
(NULL, NULL, NULL, NULL, NULL, 180.00), (NULL, NULL, NULL, NULL, NULL, 300.00), (NULL, NULL, NULL, NULL, NULL, 350.00), (NULL, NULL, NULL, NULL, NULL, 280.00), (NULL, NULL, NULL, NULL, NULL, 400.00),
(NULL, NULL, NULL, NULL, NULL, 450.00), (NULL, NULL, NULL, NULL, NULL, 380.00), (NULL, NULL, NULL, NULL, NULL, 500.00), (NULL, NULL, NULL, NULL, NULL, 550.00), (NULL, NULL, NULL, NULL, NULL, 480.00),
(NULL, NULL, NULL, NULL, NULL, 600.00), (NULL, NULL, NULL, NULL, NULL, 650.00), (NULL, NULL, NULL, NULL, NULL, 580.00), (NULL, NULL, NULL, NULL, NULL, 700.00), (NULL, NULL, NULL, NULL, NULL, 750.00),
(NULL, NULL, NULL, NULL, NULL, 800.00), (NULL, NULL, NULL, NULL, NULL, 850.00), (NULL, NULL, NULL, NULL, NULL, 900.00), (NULL, NULL, NULL, NULL, NULL, 950.00), (NULL, NULL, NULL, NULL, NULL, 1000.00),
(NULL, NULL, NULL, NULL, NULL, 100.00), (NULL, NULL, NULL, NULL, NULL, 150.00), (NULL, NULL, NULL, NULL, NULL, 120.00), (NULL, NULL, NULL, NULL, NULL, 200.00), (NULL, NULL, NULL, NULL, NULL, 250.00),
(NULL, NULL, NULL, NULL, NULL, 180.00), (NULL, NULL, NULL, NULL, NULL, 300.00), (NULL, NULL, NULL, NULL, NULL, 350.00), (NULL, NULL, NULL, NULL, NULL, 280.00), (NULL, NULL, NULL, NULL, NULL, 400.00),
(NULL, NULL, NULL, NULL, NULL, 450.00), (NULL, NULL, NULL, NULL, NULL, 380.00), (NULL, NULL, NULL, NULL, NULL, 500.00), (NULL, NULL, NULL, NULL, NULL, 550.00), (NULL, NULL, NULL, NULL, NULL, 480.00),
(NULL, NULL, NULL, NULL, NULL, 600.00), (NULL, NULL, NULL, NULL, NULL, 650.00), (NULL, NULL, NULL, NULL, NULL, 580.00), (NULL, NULL, NULL, NULL, NULL, 700.00), (NULL, NULL, NULL, NULL, NULL, 750.00),
(NULL, NULL, NULL, NULL, NULL, 800.00), (NULL, NULL, NULL, NULL, NULL, 850.00), (NULL, NULL, NULL, NULL, NULL, 900.00), (NULL, NULL, NULL, NULL, NULL, 950.00), (NULL, NULL, NULL, NULL, NULL, 1000.00);


Table 2: financial_data (for candlestick chart data)

CREATE TABLE financial_data (
    date DATE PRIMARY KEY,
    open_price DECIMAL(10, 2) NOT NULL,
    high_price DECIMAL(10, 2) NOT NULL,
    low_price DECIMAL(10, 2) NOT NULL,
    close_price DECIMAL(10, 2) NOT NULL
);

-- Sample Data for financial_data
INSERT INTO financial_data (date, open_price, high_price, low_price, close_price) VALUES
('2023-01-01', 100, 105, 98, 103),
('2023-01-02', 103, 108, 101, 106),
('2023-01-03', 106, 107, 102, 104),
('2023-01-04', 104, 110, 103, 109),
('2023-01-05', 109, 112, 107, 111),
('2023-01-06', 111, 115, 109, 114),
('2023-01-07', 114, 116, 112, 113),
('2023-01-08', 113, 118, 112, 117),
('2023-01-09', 117, 120, 115, 119),
('2023-01-10', 119, 121, 116, 118),
('2023-01-11', 118, 125, 117, 124),
('2023-01-12', 124, 126, 120, 122),
('2023-01-13', 122, 123, 119, 121),
('2023-01-14', 121, 128, 120, 127),
('2023-01-15', 127, 130, 125, 129);

2. PHP API Endpoint Setup
Save the api-endpoint.php code into a file named api-endpoint.php in your web server's document root (e.g., /var/www/html/ for Apache on Linux, or your htdocs folder for XAMPP/MAMP).

Crucially, edit the database configuration at the top of api-endpoint.php with your MariaDB username, password, and database name.

$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "your_database_name";

Ensure your web server (Apache, Nginx) is configured to process PHP files.

3. Front-end HTML/JavaScript Setup
Save the graph-lib-app-v3 code into an HTML file (e.g., index.html or graphs.html) in the same directory as your api-endpoint.php file, or a subfolder accessible by your web server.

Update the PHP_API_URL constant in index.html's JavaScript to point to your api-endpoint.php file.

const PHP_API_URL = 'http://localhost/api-endpoint.php'; // Or 'http://yourdomain.com/api-endpoint.php'

4. Running the Application
Ensure your MariaDB server is running.

Ensure your web server (Apache) is running.

Open your web browser and navigate to the URL of your HTML file:

e.g., http://localhost/index.html

or http://localhost/graphs.html

5. Using URL Parameters to Select Graphs
You can now load specific graphs directly by adding a ?graph= parameter to your URL:

Line Graph: http://localhost/index.html?graph=line

Bar Graph: http://localhost/index.html?graph=bar

Histogram: http://localhost/index.html?graph=histogram

Pie Chart: http://localhost/index.html?graph=pie

Dot Plot: http://localhost/index.html?graph=dot

Scatter Plot: http://localhost/index.html?graph=scatter

Area Chart: http://localhost/index.html?graph=area

Box Plot: http://localhost/index.html?graph=box

Candlestick Chart: http://localhost/index.html?graph=candlestick

If no graph parameter is provided, the page will load with a prompt to select a chart type.

Data Formatting and Grid Structure
The PHP API (api-endpoint.php) is designed to fetch raw data from your MariaDB tables. The JavaScript then processes this raw data into the specific format required by Chart.js for each chart type.

sales_transactions Table (for most charts)
This table holds general sales and product-related data.

Column Name

Data Type

Description

Used By Charts

id

INT

Primary key, unique transaction ID.

Dot Plot (for labels)

transaction_date

DATE

Date of the transaction.

Line, Area, Candlestick (as X-axis)

product_category

VARCHAR(255)

Category of the product (e.g., 'Electronics').

Bar, Pie, Box Plot (as categories/labels)

amount

DECIMAL(10,2)

Sales amount for the transaction.

Line, Bar, Pie, Area (as Y-axis/values)

quantity

INT

Number of units sold in the transaction.

Dot Plot (as X-axis values)

customer_rating

DECIMAL(2,1)

Customer rating for the product (e.g., 4.2).

Box Plot (for distribution), Scatter Plot (Y-axis)

product_price

DECIMAL(10,2)

Individual price of the product.

Histogram, Scatter Plot (X-axis)

How data is processed for specific charts from sales_transactions:

Line/Area Graph: Aggregates amount by transaction_date.

Bar/Pie Chart: Aggregates amount by product_category.

Histogram: Uses product_price to create frequency bins.

Dot Plot: Uses quantity for individual data points.

Scatter Plot: Uses product_price for X-axis and customer_rating for Y-axis.

Box Plot: Groups customer_rating values by product_category to show distribution.

financial_data Table (for Candlestick Chart)
This table holds financial OHLC (Open, High, Low, Close) data.

Column Name

Data Type

Description

Used By Charts

date

DATE

Trading date.

Candlestick (X-axis)

open_price

DECIMAL(10,2)

Opening price for the day.

Candlestick (OHLC data)

high_price

DECIMAL(10,2)

Highest price for the day.

Candlestick (OHLC data)

low_price

DECIMAL(10,2)

Lowest price for the day.

Candlestick (OHLC data)

close_price

DECIMAL(10,2)

Closing price for the day.

Candlestick (OHLC data)

Note on PHP Data Types: PHP's mysqli::fetch_assoc() typically returns all values as strings. The api-endpoint.php includes a loop to explicitly cast numeric values to float to ensure Chart.js receives them as numbers, which is crucial for correct rendering.

Customization
Styling: Modify the <style> block in index.html or add external CSS files to further customize the appearance using Tailwind CSS and Bootstrap classes.

Chart Options: Explore the extensive Chart.js documentation for options to customize axes, tooltips, legends, animations, and more for each chart type.

New Charts: To add new chart types, you'll need to:

Add a new button in index.html.

Implement a new process[ChartType]Data function in JavaScript to transform your raw data into the required Chart.js format for that chart.

Add a new case in the renderChart function's switch statement to configure and render the new chart type.

If it's a specialized chart, you might need to include additional Chart.js plugins (check the Chart.js ecosystem).

API Logic: Extend api-endpoint.php to include more complex queries, filtering, or aggregation logic if your application requires it.
