# Customer & Order Management System

A simplified Laravel-based application for managing customers, products, and orders. This project demonstrates the implementation of core Eloquent relationships and admin access control.

## Eloquent Relationships
The project utilizes the following Laravel Eloquent relationships:

### 1. One-to-One
- **User to Profile**: Each **User** is linked to a unique **Profile** that contains their personal details like address and phone number. This ensures a separation between authentication data and personal information.

### 2. One-to-Many
- **Profile to Order**: One **Profile** can have multiple **Orders**. This allows a single customer to place many different orders over time, while each order belongs strictly to one customer.

### 3. Many-to-Many
- **Order to Product**: An **Order** can contain multiple **Products**, and a single **Product** can be part of many different orders. This is managed via a pivot table (`order_product`) which also tracks the quantity of each product in a specific order.

## Eloquent Relationships Diagram (ERD)
<img width="671" height="571" alt="ERD" src="https://github.com/user-attachments/assets/6ba1e1dd-342f-4fbd-bbb2-ec2baabe095e" />

