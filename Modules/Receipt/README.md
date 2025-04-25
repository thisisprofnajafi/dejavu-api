# Receipt Module

Receipt management module for DejaVu API.

## Features

- Receipt creation and management
- Receipt item management with product relationships
- Multiple payment methods support
- Commission calculation for visitors
- Receipt status tracking
- Billing and shipping address management
- Tax and discount support
- Visitor commission tracking
- Customer tracking for visitors
- Visitor earnings summaries

## Installation

This module is part of the DejaVu API. It is installed by default.

## Dependencies

This module depends on:
- User module (for user relationships)
- Visitor module (for visitor and commission relationships)

## API Documentation

### Receipts

`GET /api/receipts` - List all receipts
- Filterable by status, visitor_id, user_id, date range, search term
- Pagination supported
- Access controlled by user role

`POST /api/receipts` - Create a new receipt
- Required: user_id, payment_method, payment_status, currency, items
- Optional: visitor_id, notes, billing_address, shipping_address, payment_date, due_date, metadata
- Items require: name, quantity, unit_price
- Items optional: description, tax_rate, discount_amount, product_id, product_type, metadata

`GET /api/receipts/{receipt}` - Get a specific receipt

`PUT /api/receipts/{receipt}` - Update a receipt
- Only admin can update receipts
- Most fields can be updated except total calculations which are computed

`DELETE /api/receipts/{receipt}` - Delete a receipt
- Only admin can delete receipts

### Visitor-specific Routes

`GET /api/visitor/receipts` - Get receipts for the authenticated visitor
- Only accessible by visitors
- Shows only receipts referred by the authenticated visitor
- Filterable by status, date range
- Pagination supported

`GET /api/visitor/commissions` - Get commission summary for the authenticated visitor
- Only accessible by visitors
- Shows total paid receipts, total paid amount, total commission, customers referred, and commission rate

## Models

### Receipt
- Contains receipt header information (number, user, visitor, totals, payment details)
- Related to User and Visitor
- Has many ReceiptItems
- Provides commission calculation
- Handles receipt number generation

### ReceiptItem
- Contains line item details (name, description, quantity, pricing)
- Supports polymorphic relationships with products
- Handles calculations for subtotal, tax amount, and total

## Services

### ReceiptService
- Handles business logic for receipts
- Creates and updates receipts with their items
- Manages receipt calculations
- Provides utilities for PDF generation and email sending

## Permissions

This module uses the Spatie Permission package to manage permissions. The following permissions are defined:

- receipt.view
- receipt.create
- receipt.edit
- receipt.delete
- visitor.receipts.view
- visitor.commissions.view

## Development

To extend this module:
1. Add additional payment methods in the config/config.php file
2. Implement the PDF generation logic in the ReceiptService
3. Implement email sending functionality in the ReceiptService
4. Add additional status tracking as needed 